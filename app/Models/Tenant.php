<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'email', 'database_name', 'status', 'domain', 'deleted_at'];


    public function service()
    {
        return $this->hasOne(TenantService::class, 'tenant_id');
    }

}
