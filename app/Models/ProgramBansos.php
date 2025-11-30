<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramBansos extends Model
{
    protected $fillable = ['name', 'description'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }
}
