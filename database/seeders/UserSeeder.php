<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // for ($i = 1; $i < 10; $i++) {
        //     DB::table('users')->insert([
        //         'name' => 'Nguyen Van ' . $i,
        //         'email' => $i . '@gmail.zz',
        //         'password' => bcrypt(12345678),
        //     ]);
        // }die;

        $timeStart = microtime(true); // tính thời gian chạy

        $bcrypt = bcrypt(12345678);
        $data = [];
        for ($i = 1; $i < 1000001; $i++) {

            $data[] = [
                'name' => 'Nguyen Van ' . $i,
                'email' => $i . '@gmail.zz',
                'password' => $bcrypt,
            ];

            if ($i % 2000 == 0) {
                echo $i . PHP_EOL;
                DB::table('users')->insert($data);
                $data = [];
            }
        }

        echo microtime(true) - $timeStart;
    }
}
