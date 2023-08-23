<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
       'name',
       'isbn',
       'cover_url',
       'pages',
       'category',
       'description',
       'author_id',
    ];

    //book author relationship
    public function author(){

        return $this->belongsTo(Author::class,'author_id');
        
    }
}
