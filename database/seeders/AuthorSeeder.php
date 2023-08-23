<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'firstname' => 'Jane',
                'lastname'=>'Author',
                'email' => 'author1@example.com',
                'type'=> "fiction\fantasy",
                'image_url'=>'https://i.dailymail.co.uk/i/pix/2016/05/23/22/348B850600000578-3605456-image-m-32_1464040491071.jpg',
                'write_up'=>'I have been writing for the past 10 years and it is my hobby', 


            ],
            [
                'firstname' => 'Lawrence',
                'lastname'=>'Ivan',
                'email' => 'author2@example.com',
                'type'=> 'fiction\fantasy\romance',
                'image_url'=>'https://www.rri.res.in/sites/default/files/2022-09/Abhisek%20Tamang.jpg',
                'write_up'=>'I have been writing for the past 10 years and it is my hobby',
            ],

            [
                'firstname' => 'Mark',
                'lastname'=>'Zurich',
                'email' => 'author1@example.com',
                'type'=> 'romance\traditional\fiction',
                'image_url'=>'https://i.pinimg.com/736x/7a/d0/5d/7ad05d8738230983c3c5dbdc1b362be8.jpg',
                'write_up'=>'I have been writing for the past 10 years and it is my hobby',
            ],
            // Add more authors as needed
        ];

        foreach ($authors as $authorData) {
            Author::create($authorData);
        }
    }

}
