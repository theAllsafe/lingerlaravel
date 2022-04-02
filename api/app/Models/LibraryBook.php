<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_library_book';
    protected $fillable = [
        'uid',
        'book_name',
        'book_arabic_name',
        'book_image',
        'created_at',
        'updated_at'
    ];

}
