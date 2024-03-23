<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'Administrator']);
        Role::create(['name'=>'Pengarah']);
        Role::create(['name'=>'Pegawai Pengabstrakan Air']);
        Role::create(['name'=>'Pegawai Badan Perairan']);
        Role::create(['name'=>'Pegawai Pelepasan Efluen']);
        Role::create(['name'=>'User']);
    }
}
