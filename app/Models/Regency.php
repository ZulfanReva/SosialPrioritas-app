<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    protected $fillable = ['name', 'province_id'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
