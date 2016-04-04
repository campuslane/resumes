<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $guarded = ['id'];

    public function resume()
    {
    	return $this->belongsTo('App\Models\Resume');
    }
}
