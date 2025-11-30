<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $table = 'citizens';
    protected $fillable = [
        'NIK', 'name', 'place_birth', 'date_birth', 'gender', 'address',
        'province_id', 'regency_id', 'district_id', 'sub_district_id',
        'education', 'work_id', 'income_id', 'relationship_id', 'priority_bansos_id'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function income()
    {
        return $this->belongsTo(Income::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }

    public function priorityBansos()
    {
        return $this->belongsTo(PriorityBansos::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($citizen) {
            if (is_null($citizen->priority_bansos_id) || $citizen->isDirty(['work_id', 'income_id', 'relationship_id'])) {
                $citizen->priority_bansos_id = $citizen->calculatePriority();
            }
        });
    }

    public function calculatePriority()
    {
        $workScore = $this->work->score_work ?? 0;
        $incomeScore = $this->income->score_income ?? 0;
        $relationshipScore = $this->relationship->score_relationship ?? 0;

        $totalScore = $workScore + $incomeScore + $relationshipScore;

        if ($totalScore >= 80) {
            return 1; // Tinggi
        } elseif ($totalScore >= 60) {
            return 2; // Sedang
        } else {
            return 3; // Rendah
        }
    }
}
