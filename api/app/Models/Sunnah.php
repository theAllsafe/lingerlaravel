<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunnah extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_sunnah';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'icon',
        'image',
        'created_at',
        'updated_at'
    ];

}
