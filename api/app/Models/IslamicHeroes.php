<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslamicHeroes extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_islamic_heroes';
    protected $fillable = [
        'aid',
        'title',
        'image',
        'created_at',
        'updated_at'
    ];

}
