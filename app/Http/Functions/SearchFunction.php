<?php

namespace App\Http\Functions;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\SearchValidate;
use Validator;



use App\Shop;
use App\Category;
use App\Product;
use App\Picture;
use App\Param;
// DB::enableQueryLog();


class SearchFunction

{

    public static function search(Request $request) {



    	$id = null;
    	$name = null;
    	$description = null;
    	$shop_id  = null;
  		$model = null;

    	// foreach (['id', 'name', 'description', 'shop_id'] as $field_name) {


    	// 	if(!is_null($request->$field_name)) {

    	// 		$comparator = 'like';
    	// 		$likes = '%';

		   //  		if($field_name == 'shop_id') {

					// 	$comparator = '=';
					// 	$likes = '';		    			
		   //  		}

		   //  		if($field_name == 'name') {

		   //  			$model = [['model', $comparator, $likes.$request->$field_name.$likes]];
		   //  		}

    	// 		$$field_name = [[$field_name, $comparator, $likes.$request->$field_name.$likes]];
    	// 	}



    	// 	$filters = array_merge($filters, $$field_name, $model);

    	// }


    	foreach (['id', 'name', 'description', 'shop_id'] as $field_name) {


    		if(!is_null($request->$field_name)) {



		    		if($field_name == 'name') {

		    			$model = $request->$field_name;
		    		}

    			$$field_name = $request->$field_name;
    		}


    	}

		$result = Product::when(!is_null($shop_id), function ($query) use ($shop_id) {

			$query->where('shop_id', $shop_id);

		})

		->when(!is_null($description), function($query) use ($description) {

			$query->orWhere('description', 'like', '%'.$description.'%');

		})

		->when(!is_null($name), function($query) use ($name) {

			$query->orWhere('name', 'like', '%'.$name.'%')

			->orWhere('model', 'like', '%'.$name.'%');

		})

		->when(!is_null($id), function($query) use ($id) {

			$query->orWhere('id', '=', $id);
		
		})

		->get();

		if($result->isEmpty()) {

			return 'Ничего не найдено!';

		}

		return $result->toArray();



		// dd(DB::getQueryLog());



    }

 }

