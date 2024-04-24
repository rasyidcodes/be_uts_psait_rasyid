<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkuliahan extends Model
{
    use HasFactory;

    protected $table = 'perkuliahan';
    protected $primaryKey = 'id_perkuliahan';
    public $timestamps = false;

    protected $fillable = [
        'id_perkuliahan',
        'nim',
        'kode_mk',
        'nilai'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }
}
