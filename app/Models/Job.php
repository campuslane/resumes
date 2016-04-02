<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $guarded = ['id'];

    public function resume()
    {
    	return $this->belongsTo('App\Models\Resume');
    }
}
