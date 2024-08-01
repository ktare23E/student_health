<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name','division_id','address','district_head'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class,'entity_id')->where('type',Nurse::TYPE_DISTRICT);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
