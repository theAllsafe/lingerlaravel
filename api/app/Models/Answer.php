<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_answer';
    protected $fillable = [
        'question_id',
        'answer',
        'time',
        'timeslot',
        'language',
        'created_at',
        'updated_at'
    ];

}
