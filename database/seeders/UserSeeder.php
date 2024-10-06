<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserTutam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $supervisor = Role::firstOrCreate(['name' => 'Supervisor']);
        $sekretaris = Role::firstOrCreate(['name' => 'Sekretaris']);
        $pengelolaKeuangan = Role::firstOrCreate(['name' => 'Pengelola Keuangan']);
        $pengadministrasiPersuratan = Role::firstOrCreate(['name' => 'Pengadministrasi Persuratan']);

        // create permissions
        $permissionRevisi = Permission::firstOrCreate(['name' => 'revisi']);
        $permissionBuatRapat = Permission::firstOrCreate(['name' => 'buat rapat']);
        $permissionBuatSppd = Permission::firstOrCreate(['name' => 'buat sppd']);
        $permissionBuatSurat = Permission::firstOrCreate(['name' => 'buat surat']);

        // assign permissions to roles
        $supervisor->givePermissionTo($permissionRevisi);
        $sekretaris->givePermissionTo($permissionBuatRapat);
        $pengelolaKeuangan->givePermissionTo($permissionBuatSppd);
        $pengadministrasiPersuratan->givePermissionTo($permissionBuatSurat);

        User::create([
            'nama' => 'Supervisor Akademik dan Kemahasiswaan',
            'email' => 'supervisorak@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($supervisor);

        User::create([
            'nama' => 'Supervisor Sumberdaya',
            'email' => 'supervisorsdm@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($supervisor);

        $data = json_decode(file_get_contents(database_path('seeders/data/user.json')), true);
        foreach ($data as $user) {
            User::create([
                'nama' => $user['nama'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
            ]);
        }

        User::create([
            'nama' => 'Sekretaris',
            'email' => 'sekretaris@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($sekretaris);

        User::create([
            'nama' => 'Pengelola Keuangan',
            'email' => 'pengelolakeuangan@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($pengelolaKeuangan);

        User::create([
            'nama' => 'Pengadministrasi Persuratan',
            'email' => 'pengadministrasipersuratan@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($pengadministrasiPersuratan);
    }
}
