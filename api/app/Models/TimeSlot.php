<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_time_slot';
    protected $fillable = [
        'start_time',
        'end_time',
        'status',
        'created_at',
        'updated_at'
    ];

}
