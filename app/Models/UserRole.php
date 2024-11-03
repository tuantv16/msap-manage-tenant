<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    protected $fillable = [
        'user_id',
        'role_id',
    ];
    public $timestamps = false;
}
