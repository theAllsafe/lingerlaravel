<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuaWazifa extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_dua_wazifa';
    protected $fillable = [
        'image',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

}
