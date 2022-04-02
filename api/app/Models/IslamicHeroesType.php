<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslamicHeroesType extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_islamic_heroes_type';
    protected $fillable = [
        'islamic_heroes_id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

}
