<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslamicFestivals extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_islamic_festivals';
    protected $fillable = [
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

}
