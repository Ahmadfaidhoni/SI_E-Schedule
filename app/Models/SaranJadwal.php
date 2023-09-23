<?php

namespace App\Models;

use App\Models\Kegiatan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaranJadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
