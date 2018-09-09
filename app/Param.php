<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Param extends Model
{

    public function products()
    
    {
    	return $this->belongsTo('App\Product', 'product_id', 'primary_id');

    }

    protected $guarded = [];

}
