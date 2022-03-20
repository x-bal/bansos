<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Rfid;
use App\Models\SecretKey;
use App\Models\User;
use App\Models\WaktuOperasional;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role =  Role::create(['name' => 'Super Admin']);

        $admin = User::create([
            'username' => 'tzuyu',
            'name' => 'Muhammad Iqbal',
            'password' => bcrypt('secret')
        ]);

        WaktuOperasional::create([
            'start' => '08:00',
            'end' => '15:00',
        ]);

        $admin->assignRole($role);

        SecretKey::create(['key' => 'bansos2022']);

        Device::create(['name' => 'Device Bansos']);

        Rfid::create(['device_id' => 1, 'rfid' => '85728']);
    }
}
