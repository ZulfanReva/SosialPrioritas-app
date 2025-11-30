<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodBansos extends Model
{
    protected $fillable = ['name'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function distributions()
    {
        return $this->hasMany(distribution::class);
    }
}
