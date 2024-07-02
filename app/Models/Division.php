<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = ['division_name'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class)->where('type',Nurse::TYPE_DIVISION);
    }
}
