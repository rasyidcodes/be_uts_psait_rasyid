<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matakuliah')->insert([
            [
                'kode_mk' => 'svpl_001',
                'nama_mk' => 'database',
                'sks' => 2,
            ],
            [
                'kode_mk' => 'svpl_002',
                'nama_mk' => 'kecerdasanartifisial',
                'sks' => 2,
            ],
            [
                'kode_mk' => 'svpl_003',
                'nama_mk' => 'interoperabilitas',
                'sks' => 2,
            ],
        ]);
    }
}
