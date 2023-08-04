<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class KeuanganController extends Controller
{
    public function index()
    {
        $active_menu = 'keuangan';
        return view('keuangan.data-pegawai-keuangan', compact('active_menu'), [
            "pegawai" => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function show(User $user)
    {
        $active_menu = 'keuangan';
        $keuangan = Keuangan::join('jadwals', 'keuangans.jadwal_id', '=', 'jadwals.id')
            ->leftJoin('kegiatans', 'jadwals.kegiatan_id', '=', 'kegiatans.id')
            ->where('jadwals.user_id', $user->id)
            ->get();
        return view('keuangan.show-pegawai-keuangan', compact('active_menu'), [
            "user" => $user,
            "keuangan" => $keuangan
        ]);
    }

    public function export_excel($awal, $akhir, $user, $tipe_jadwal)
    {
        // dd($awal, $akhir, $user, $tipe_jadwal);
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        $dt = date('Ymd');

        try {

            $spreadSheet = new Spreadsheet();

            $spreadSheet->getProperties()
                ->setCreator('keuangan' . " | e-schecule")
                ->setTitle("e-schecule")
                ->setSubject("e-schecule")
                ->setDescription("e-schecule")
                ->setCategory("e-schecule Export List");

            $sheet = $spreadSheet->getActiveSheet();

            $sheet->getDefaultColumnDimension()->setWidth(20);

            if ($user != 'all') {
                $pegawai = User::where('id', $user)->first()->name ?? '';
            } else {
                $pegawai = 'Semua Pegawai';
            }
            if ($tipe_jadwal == '1') {
                $tj = 'Mengajar';
            } else if ($tipe_jadwal == '2') {
                $tj = 'Perjalanan Dinas';
            } else {
                $tj = 'Semua Kegiatan';
            }

            $sheet->setCellValue('A1', 'Pegawai :');
            $sheet->setCellValue('A2', 'Tipe Jadwal :');
            $sheet->setCellValue('A3', 'Tanggal :');

            $sheet->setCellValue('B1', $pegawai);
            $sheet->setCellValue('B2', $tj);
            $sheet->setCellValue('B3', $awal . ' - ' . $akhir);

            $sheet->setCellValue('A5', '#');
            $sheet->setCellValue('B5', 'Kegiatan');
            $sheet->setCellValue('C5', 'Pegawai');
            $sheet->setCellValue('D5', 'Tanggal Kegiatan');
            $sheet->setCellValue('E5', 'Jam');
            $sheet->setCellValue('F5', 'JP');
            $sheet->setCellValue('G5', 'Biaya');

            $highestColumn = $sheet->getHighestColumn();
            $highestRow = $sheet->getHighestRow();
            $range = 'A5:' . $highestColumn . $highestRow;

            // Add borders to all the data cells
            $styleArray_border = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ];
            $sheet->getStyle($range)->applyFromArray($styleArray_border);


            $colIndex = 6;
            $number = 1;

            $keuangan = Keuangan::join('jadwals', 'keuangans.jadwal_id', '=', 'jadwals.id')
                ->leftJoin('kegiatans', 'jadwals.kegiatan_id', '=', 'kegiatans.id')
                ->leftJoin('users', 'jadwals.user_id', '=', 'users.id')
                ->whereRaw("(
                (waktu_mulai < '$awal' AND waktu_selesai > '$awal') OR
                (waktu_mulai < '$akhir' AND waktu_selesai > '$akhir') OR 
                (waktu_mulai >= '$awal' AND waktu_selesai <= '$akhir')
            )");

            if ($user != 'all') {
                $keuangan = $keuangan->where('jadwals.user_id', $user);
            }

            if ($tipe_jadwal != 'all') {
                $keuangan = $keuangan->where('jadwals.tipe_jadwal', $tipe_jadwal);
            }

            $keuangan = $keuangan->get();

            // return $keuangan;

            $total_mengajar = 0;
            $total_perjalanan_dinas = 0;
            foreach ($keuangan as $key => $detail) {
                $sheet->setCellValue("A{$colIndex}", $number);
                $sheet->setCellValue("B{$colIndex}", $detail->nama_kegiatan ?? 'Perjalanan Dinas');
                $sheet->setCellValue("C{$colIndex}", $detail->name ?? '-');
                $sheet->setCellValue("E{$colIndex}", date('H:i:s', strtotime($detail->waktu_mulai)) ?? '-');
                $sheet->setCellValue("F{$colIndex}", $detail->jp ?? '-');
                $sheet->setCellValue("G{$colIndex}", $detail->biaya ?? '-');

                if ($detail->tipe_jadwal == '1') {
                    $total_mengajar += $detail->biaya;
                    $sheet->setCellValue("D{$colIndex}", date('Y-m-d', strtotime($detail->waktu_mulai)) ?? '-');
                } else if ($detail->tipe_jadwal == '2') {
                    $total_perjalanan_dinas += $detail->biaya;
                    $sheet->setCellValue("D{$colIndex}", (date('Y-m-d', strtotime($detail->waktu_mulai)) ?? '-') . '-' . (date('Y-m-d', strtotime($detail->waktu_selesai)) ?? '-'));
                }

                $number++;
                $colIndex++;
            }


            $sheet->setCellValue("A{$colIndex}", 'Total Pendapatan mengajar');
            $sheet->setCellValue("G{$colIndex}", $total_mengajar);
            // $sheet->mergeCells('A9:F9');
            $sheet->mergeCells("A{$colIndex}" . ":" . "F{$colIndex}");
            $styleArray = [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle("A{$colIndex}" . ":" . "F{$colIndex}")->applyFromArray($styleArray);
            $ujung_kiri = $colIndex;
            $colIndex++;
            $sheet->mergeCells("A{$colIndex}" . ":" . "F{$colIndex}");
            $sheet->getStyle("A{$colIndex}" . ":" . "F{$colIndex}")->applyFromArray($styleArray);
            $sheet->setCellValue("A{$colIndex}", 'Total Pendapatan perjalanan dinas');
            $sheet->setCellValue("G{$colIndex}", $total_perjalanan_dinas);

            // $range = 'A5:' . $highestColumn . $highestRow;
            $range_footer = 'A' . $ujung_kiri . ':' . 'G' . $colIndex;
            $sheet->getStyle($range_footer)->applyFromArray($styleArray_border);




            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Keuangan_' . $dt . '.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {

            return;
        }
    }
}
