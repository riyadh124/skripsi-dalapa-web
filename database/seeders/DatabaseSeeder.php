<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Material;
use App\Models\Workorder;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       

         Material::create([
            'nama' => "Network Combat",
            'harga' => 150000
         ]);

         Material::create([
            'nama' => "Kabel Fiber",
            'harga' => 250000
         ]);

         Material::create([
            'nama' => "RJ45",
            'harga' => 25000
         ]);

         Material::create([
            'nama' => "Modem",
            'harga' => 100000
         ]);

         User::factory()->create([
         'name' => 'Admin',
         'email' => 'admin@gmail.com',
         'role' => 'Admin',
         ]);
   
         User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Riyadh Asjad Mulyadi',
            'email' => 'riyadh@gmail.com',
        ]);
        
        // Workorder::factory(2)->create();

    //     DB::table('notifications')->insert([
    //        [
    //            'workorder_id' => 1,
    //            'created_at' => now(),
    //            'status' => 'pending',
    //            'isi_notifikasi' => 'Notifikasi pertama untuk workorder 1',
    //            'created_at' => now(),
    //            'updated_at' => now()
    //        ],
    //        [
    //            'workorder_id' => 2,
    //            'created_at' => now(),
    //            'status' => 'completed',
    //            'isi_notifikasi' => 'Notifikasi kedua untuk workorder 2',
    //            'created_at' => now(),
    //            'updated_at' => now()
    //        ],
    //    ]);

        User::factory()->create([
            'name' => 'Agus Ackerman',
            'email' => 'agus@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'Rahmat Kanaeru',
            'email' => 'rahmat@gmail.com',
        ]);

        // Workorder::create([
        //     'nomor_tiket' => 'TCKT-12345',
        //     'tipe_segmen' => 'Seeder',
        //     'lokasi_gangguan_masal' => 'Alamat Gangguan',
        //     'deskripsi_gangguan' => 'Deskripsi Gangguan',
        //     'instruksi_pekerjaan' => 'Instruksi Pekerjaan',
        //     'status' => 'Menunggu',
        // ]);
    }
}
