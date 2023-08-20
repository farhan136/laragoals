<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $arr = [
            [
                'name'=>"Susanto",
                "email"=>"suto@gmail.com",
                "is_admin"=>0,
                "password"=>Hash::make("password")
            ],[
                'name'=>"Bambang",
                "email"=>"bambang@gmail.com",
                "is_admin"=>0,
                "password"=>Hash::make("password")
            ],[
                'name'=>"Putri",
                "email"=>"putri@gmail.com",
                "is_admin"=>0,
                "password"=>Hash::make("password")
            ],[
                'name'=>"Putra",
                "email"=>"putra@gmail.com",
                "is_admin"=>0,
                "password"=>Hash::make("password")
            ],
        ];
        // foreach($arr as $row){
        //     User::create($row);
        // }
    }
}
