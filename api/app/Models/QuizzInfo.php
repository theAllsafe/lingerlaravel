<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzInfo extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_quizz_info';
    protected $fillable = [
        'type',
        'english',
        'hindi',
        'roman',
        'urdu',
        'created_at',
        'updated_at'
    ];

}
