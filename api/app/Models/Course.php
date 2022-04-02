<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_course';
    protected $fillable = [
        'aid',
        'title',
        'description',
        'image',
        'vedio',
        'price',
        'created_at',
        'updated_at'
    ];

}
