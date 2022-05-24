<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'uid_status' => Str::uuid(),
                'type' => "BLOQUEADO",
                'description' => 'Usuario bloqueado'
            ],
            [
                'uid_status' => Str::uuid(),
                'type' => "ATIVO",
                'description' => 'Usuario ativo.'
            ],
            [
                'uid_status' => Str::uuid(),
                'type' => "VENCIDO",
                'description' => 'Usuario com mensalidade vencida.'
            ],
            [
                'uid_status' => Str::uuid(),
                'type' => "PENDENTE",
                'description' => 'Usuario com cadastrado mas ainda não logou.'
            ],
            [
                'uid_status' => Str::uuid(),
                'type' => "PENDENTE",
                'description' => 'Usuario com cadastrado mas ainda não logou.'
            ],
        ]);
    }
}
