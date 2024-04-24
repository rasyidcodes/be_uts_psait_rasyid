<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerkuliahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perkuliahan')->insert([
            ['nim' => 'sv_001', 'kode_mk' => 'svpl_001', 'nilai' => 90],
            ['nim' => 'sv_001', 'kode_mk' => 'svpl_003', 'nilai' => 87],
            ['nim' => 'sv_001', 'kode_mk' => 'svpl_002', 'nilai' => 88],
            ['nim' => 'sv_002', 'kode_mk' => 'svpl_001', 'nilai' => 98],
            ['nim' => 'sv_002', 'kode_mk' => 'svpl_002', 'nilai' => 77],
        ]);
    }
}
