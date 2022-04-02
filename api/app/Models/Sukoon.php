<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sukoon extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_sukoon';
    protected $fillable = [
        'user_id',
        'image',
        'audio',
        'title',
        'created_at',
        'updated_at'
    ];

}
