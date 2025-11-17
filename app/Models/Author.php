<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'books_author';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_book_authors', 'author_id', 'book_id');
    }
}
