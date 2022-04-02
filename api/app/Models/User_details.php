<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_details extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='tbl_user_details';
    protected $fillable = [
        'user_id',
        'total_like',
        'total_followers',
        'total_following',
        'fecebook_account_link',
        'instagram_account_link',
        'twitter_account_link',
        'created_at',
        'updated_at'
    ];

}
