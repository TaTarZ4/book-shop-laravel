<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','image','description'
    ];

    public function category_book()
    {
        return $this->belongsToMany(category::class , 'category_books');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class , 'book_id' , 'id');
    }
}
