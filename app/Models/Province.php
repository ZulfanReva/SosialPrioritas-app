<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
