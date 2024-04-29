<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuit extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function pilots() {
        return $this->belongsToMany(Pilot::class);
    }
}