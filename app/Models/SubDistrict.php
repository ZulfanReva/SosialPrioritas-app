<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    protected $fillable = ['name', 'district_id'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
