<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriorityBansos extends Model
{
    protected $fillable = ['label', 'score_min'];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
