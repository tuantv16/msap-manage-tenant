<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantService extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_id',
        'service_id',
        'service_db_name',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

}
