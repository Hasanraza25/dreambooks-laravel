<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'author';
    protected $guarded = [];

    public function author_books(){
        return $this->hasMany(Book::class, 'author_id');
    }
}
