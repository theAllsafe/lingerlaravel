<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryChapter extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_library_chapter';
    protected $fillable = [
        'uid',
        'book_id',
        'chapter_name',
        'description',
        'created_at',
        'updated_at'
    ];

}
