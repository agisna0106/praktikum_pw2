<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable =[
        'title',
        'author',
        'year',
        'publisher',
        'city',
        'cover',
        'bookshelf_id',
    ];

    public static function getBooks()
    {
        $books = Book::all();

        $books_filtered = [];
        $no = 1;
        for ($i=0; $i < $books->count() ; $i++) { 
            $books_filtered[$i]['no'] = $no++;
            $books_filtered[$i]['title'] = $books[$i]->title;
            $books_filtered[$i]['author'] = $books[$i]->author;
            $books_filtered[$i]['year'] = $books[$i]->year;
            $books_filtered[$i]['publisher'] = $books[$i]->publisher;
            $books_filtered[$i]['city'] = $books[$i]->city;
        }

        return $books_filtered;
    }

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class, 'bookshelf_id', 'id');
    }
}
