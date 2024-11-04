<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'book';
    protected $guarded = [];

    public function author(){
        return $this->belongsTo(author::class, 'author_id');
    } 

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    } 
}
