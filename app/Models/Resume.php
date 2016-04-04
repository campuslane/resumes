<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';

    protected $guarded = ['id'];

    public function items()
    {
    	return $this->hasMany('App\Models\Item');
    }
}
