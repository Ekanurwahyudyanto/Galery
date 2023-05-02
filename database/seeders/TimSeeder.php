<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            DB::table('roles')->insert([
                'name'      => 'Superadmin',
            ]);

            Role::create(['name' => 'member']);
        }catch (\Throwable $th){
            echo "error : {$th}";
            DB::rollBack();
        }
        DB::commit();
    }
}
