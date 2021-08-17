<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
