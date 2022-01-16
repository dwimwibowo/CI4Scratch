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
            'img'           => 'dwimwibowo.jpg',
            'password'      => password_hash('123', PASSWORD_BCRYPT),
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
                    'created_at'    => Time::createFromTimestamp($faker->unixTime()) //Time::now()
                ]
            );
        }
    }
}
