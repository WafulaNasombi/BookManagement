<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'firstname',
        'lastname',
        'type',
        'email',
        'write_up',
    ];

    //author book relationship
    public function books(){
        return $this->hasMany(Book::class);
    }
}
