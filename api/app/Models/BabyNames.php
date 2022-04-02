<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BabyNames extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_baby_names';
    protected $fillable = [
        'user_id',
        'date',
        'time',
        'gender',
        'nickname',
        'city',
        'father_name',
        'mother_name',
        'baby_name',
        'created_at',
        'updated_at'
    ];

}
