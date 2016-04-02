<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';

    protected $guarded = ['id'];

    public function jobs()
    {
    	return $this->hasMany('App\Models\Job');
    }
}
