<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_season';
    protected $fillable = [
        'season_name',
        'season_date',
        'season_week',
        'season_ques',
        'season_time',
        'season_day',
        'created_at',
        'updated_at'
    ];

}
