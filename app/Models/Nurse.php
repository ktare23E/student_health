<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\VersionUpdater\Checker;

class Nurse extends Model
{
    use HasFactory;
    const TYPE_SCHOOL = 'school';
    const TYPE_DISTRICT = 'district';
    const TYPE_DIVISION = 'division';

    
    public function entity(){
        switch($this->type){
            case self::TYPE_SCHOOL:
                return $this->belongsTo(School::class,'entity_id');
            case self::TYPE_DISTRICT:
                return $this->belongsTo(District::class,'entity_id');
            case self::TYPE_DIVISION:
                return $this->belongsTo(Division::class,'entity_id');
            default:
                throw new \Exception("Unknown nurse type");
        }
    }

    public function checkups()
    {
        return $this->hasMany(Checkup::class);
    }
}
