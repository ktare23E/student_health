<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name','address'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class,'entity_id')->where('type',Nurse::TYPE_DIVISION);
    }
}
