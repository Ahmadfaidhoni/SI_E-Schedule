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
                $pegawai = User::where('id', $user)->first()->name;
            } else {
                $pegawai = User::all();
            }
            if ($tipe_jadwal == '1') {
                $tipe_jadwal = 'Mengajar';
            } else if ($tipe_jadwal == '2') {
                $tipe_jadwal = 'Perjalanan Dinas';
            } else {
                $tipe_jadwal = 'Semua Kegiatan';
            }

            $sheet->setCellValue('A1', 'Pegawai :');
            $sheet->setCellValue('A2', 'Tipe Jadwal :');
            $sheet->setCellValue('A3', 'Tanggal :');

            $sheet->setCellValue('B1', $pegawai->count() > 1 ? $pegawai[0]->name : 'Semua');
            $sheet->setCellValue('B2', $tipe_jadwal);
            $sheet->setCellValue('B3', $awal . ' - ' . $akhir);

            $colIndex = 6;
            $number = 1;

            $keuangan = Keuangan::join('jadwals', 'keuangans.jadwal_id', '=', 'jadwals.id')
                ->leftJoin('kegiatans', 'jadwals.kegiatan_id', '=', 'kegiatans.id')
                // ->where('jadwals.user_id', $pegawai->count() > 1 ? $pegawai[0]->
                ->get();

            // foreach ($keuangan as $key => $detail) {
            //     $sheet->setCellValue("A{$colIndex}", $number);
            //     $sheet->setCellValue("B{$colIndex}", $detail->id);

            //     $number++;
            //     $colIndex++;
            // }

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
