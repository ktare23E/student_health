<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\VersionUpdater\Checker;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Nurse extends Authenticatable
{
    use HasFactory;

    protected $table = 'nurses';
    protected $fillable = ['first_name','middle_name','last_name','gender','address','email','password','status','type','entity_id'];
    protected $hidden = ['password','remember_token'];
    const TYPE_SCHOOL = 'school';
    const TYPE_DISTRICT = 'district';
    const TYPE_DIVISION = 'division';

    public function entity()
    {
        return $this->morphToEntity();
    }

    public function morphToEntity()
    {
        switch ($this->type) {
            case self::TYPE_SCHOOL:
                return $this->belongsTo(School::class, 'entity_id');
            case self::TYPE_DISTRICT:
                return $this->belongsTo(District::class, 'entity_id');
            case self::TYPE_DIVISION:
                return $this->belongsTo(Division::class, 'entity_id');
            default:
                throw new \Exception("Unknown nurse type: " . $this->type);
        }
    }


    public function checkups()
    {
        return $this->hasMany(Checkup::class);
    }
}
