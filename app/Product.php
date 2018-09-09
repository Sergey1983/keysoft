<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $guarded = [];

        protected $primaryKey = 'primary_id';


        public function categories()
        
        {
        	return $this->belongsToMany('App\Category', 'category_product', 'product_id', 'category_id');

        }

        public function pictures()
        
        {
        	return $this->hasMany('App\Picture', 'product_id');

        }

        public function parameters()
        
        {
                return $this->hasMany('App\Param', 'product_id');

        }

}
