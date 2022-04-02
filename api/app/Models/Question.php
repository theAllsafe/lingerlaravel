<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_questios';
    protected $fillable = [
        'season_id',
        'hindi',
        'hindi_a',
        'hindi_b',
        'hindi_c',
        'hindi_d',
        'hindi_ans',
        'english',
        'english_a',
        'english_b',
        'english_c',
        'english_d',
        'english_ans',
        'roman',
        'roman_a',
        'roman_b',
        'roman_c',
        'roman_d',
        'roman_ans',
        'urdu',
        'urdu_a',
        'urdu_b',
        'urdu_c',
        'urdu_d',
        'urdu_ans',
        'created_at',
        'updated_at'
    ];

}
