<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{

	protected $guarded = [];    //

	public function product()

	{

		return $this->belongsTo('App\Product');

	}

	protected $dates = ['deleted_at'];
}
