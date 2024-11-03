<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model {
    
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'infor', 'description', 'status', 'created_id', 'updated_id'];

    protected $casts = ['infor' => 'json',];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;
}
