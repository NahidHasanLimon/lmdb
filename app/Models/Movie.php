<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
     public function industry()
    {
        return $this->belongsTo('App\Models\Industry');
    }
    public function o_t_t_provider()
    {
        return $this->belongsTo('App\Models\OTTProvider');
        // return $this->belongsTo('App\Models\OTTProvider', 'o_t_t_provider_id', 'id');
    }
}
