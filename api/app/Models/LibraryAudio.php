<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryAudio extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_library_audio';
    protected $fillable = [
        'uid',
        'title',
        'icon',
        'image',
        'audio',
        'created_at',
        'updated_at'
    ];

}
