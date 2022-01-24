<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Method 1
        $data = [
            'first_name'    => 'Dwi',
            'last_name'     => 'Wibowo',
            'email'         => 'dwimwibowo@gmail.com',
            'img'           => 'https://avatars.githubusercontent.com/u/13568817?v=4',
            'password'      => password_hash('123', PASSWORD_BCRYPT),
            'role_id'       => 0,
            'created_at'    => date('Y-m-d')
        ];

        $this->db->table('users')->insert($data);

        // Method 2
        $user = new UserModel;
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 300; $i++) {
            $user->save(
                [
                    'first_name'    => $faker->firstName,
                    'last_name'     => $faker->lastName,
                    'email'         => $faker->email,
                    'img'           => \Faker\Provider\Image::imageUrl(800, 400),
                    'password'      => password_hash($faker->password, PASSWORD_DEFAULT),
                    'role_id'       => rand(1,3),
                    'created_at'    => Time::createFromTimestamp($faker->unixTime()) //Time::now()
                ]
            );
        }
    }
}
