<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_subscription';
    protected $fillable = [
        'type',
        'title',
        'price',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];

}
