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
}
