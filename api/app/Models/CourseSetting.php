<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSetting extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_course_setting';
    protected $fillable = [
        'uid',
        'type',
        'value',
        'created_at',
        'updated_at'
    ];

}
