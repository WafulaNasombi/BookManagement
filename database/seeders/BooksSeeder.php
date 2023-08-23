<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'name' => 'Book 1',
                'isbn' => '1234567890',
                'cover_url' => 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/contemporary-fiction-night-time-book-cover-design-template-1be47835c3058eb42211574e0c4ed8bf_screen.jpg?ts=1637012564',
                'pages'=>'325',
                'category' => 'fiction',
                'description'=>'Embark on a whimsical journey through the Enchanted Forest with Princess Cimorene.
                 Join her as she defies traditional princess roles, befriends dragons, and navigates magical adventures. This delightful series combines humor, fantasy, and a strong-willed heroine who challenges conventions to shape her own destiny.',
                'authors_id' => 1,
            ],
            [
                'name' => 'Book 2',
                'isbn' => '9876543210',
                'cover_url' => 'https://www.creativindie.com/wp-content/uploads/2017/04/New-WOrld-299x449.jpg',
                'pages'=>'564',
                'category' => 'novela',
                'description'=>'Immerse yourself in the mysterious world of a magical competition held within the confines of a mesmerizing black-and-white circus. With enchanting descriptions and vivid imagery, 
                             "The Night Circus" weaves together a tale of star-crossed lovers, bound by their connection to the circus and the high-stakes game they are destined to play.',
                'authors_id' => 2,
            ],

            [
                'name' => 'Book 3',
                'isbn' => '987654675',
                'cover_url' => 'https://thebookcoverdesigner.com/wp-content/uploads/2019/11/between1.jpg',
                'pages'=>'400',
                'category' => 'fantasy',
                'description'=>'Set in the 1930s South, "To Kill a Mockingbird" explores themes of racial injustice, morality, and childhood innocence.
                                Follow Scout Finch is journey as she navigates her small town prejudices and learns valuable life lessons from her father, Atticus, a lawyer defending an innocent black man accused of rape.',
                'authors_id' => 3,
            ],

            [
                'name' => 'Book 4',
                'isbn' => '9876543447',
                'cover_url' => 'https://thebookcoverdesigner.com/wp-content/uploads/2021/09/Secrets-at-the-lake-texts.jpg',
                'pages'=>'400',
                'category' => 'fiction',
                'description'=>'Set in the 1930s South, "To Kill a Mockingbird" explores themes of racial injustice, morality, and childhood innocence.
                                Follow Scout Finch is journey as she navigates her small town prejudices and learns valuable life lessons from her father, Atticus, a lawyer defending an innocent black man accused of rape.',
                'authors_id' => 1,
            ],

            [
                'name' => 'Book 5',
                'isbn' => '987654333',
                'cover_url' => 'https://i.pinimg.com/474x/8c/01/42/8c0142ed733f9325d74856d8951a1216--book-marks-calendar.jpg',
                'pages'=>'250',
                'category' => 'romance',
                'description'=>'Set in the 1930s South, "To Kill a Mockingbird" explores themes of racial injustice, morality, and childhood innocence.
                                Follow Scout Finch is journey as she navigates her small town prejudices and learns valuable life lessons from her father, Atticus, a lawyer defending an innocent black man accused of rape.',
                'authors_id' => 2,
            ],
        ];

        foreach ($books as $bookData) {
            Book::create($bookData);
        }

    }
}
