<?php

namespace App\Http\Functions;

use App\Shop;
use App\Category;
use App\Product;
use App\Picture;
use App\Param;

use Artisan;

class ImportFunction

{


    public static function import() {


		$links = ['http://static.ozone.ru/multimedia/yml/facet/div_soft.xml', 
		'http://www.trenazhery.ru/market2.xml',
		'http://www.radio-liga.ru/yml.php',
		'http://armprodukt.ru/bitrix/catalog_export/yandex.php'];


		foreach ($links as $link) {


		// $filename = basename($link);
		// file_put_contents($filename, file_get_contents($link));


			$parser = new \YMLParser\YMLParser(new \YMLParser\Driver\SimpleXML);
			$parser->open($link);

			// foreach ($parser->getOffers() as $offer) {

			// 	if(count($offer['picture']) > 1)
			// 	return ($offer); 
			// }


			$shop_info = $parser->getShopInfo();

			$shop = Shop::updateOrCreate(['name' => $shop_info['name']], $shop_info);

			$shop_id = $shop->id;


			foreach($parser->getCategories() as $category):

				$category_info = iterator_to_array($category);

				Category::updateOrCreate(['shop_id' => $shop_id, 'id' => $category_info['id']], $category_info);

			endforeach;


			foreach ($parser->getOffers() as $offer):

				$array_elems = ['params', 'picture', 'categoryid', 'orderingtime'];

				$offer = iterator_to_array($offer);

				$offer_clean = array_diff_key($offer, array_flip($array_elems));

				$product = Product::updateOrCreate(['id' => $offer_clean['id'], 'shop_id' => $shop_id], $offer_clean);

				$product_id = $product->primary_id;

				
				$pic_insterted_ids = [];

				foreach ($offer['picture'] as $pic_link) {

					$picture = Picture::firstOrCreate(['product_id'=> $product_id, 'link' => $pic_link]);

					$pic_insterted_ids[] = $picture->id;

				}

				self::delete_unexisting('App\Picture', $pic_insterted_ids, $product_id);


				$param_insterted_ids = [];

				foreach ($offer['params'] as $param) {

					$param = Param::firstOrCreate(array_merge(['product_id' => $product_id], $param));

					$param_insterted_ids[] = $param->id;

				}

				self::delete_unexisting('App\Param', $param_insterted_ids, $product_id);


				$cat_inserted_ids = [];

				foreach ($offer['categoryid'] as $key => $category) {
					
					$cat_inserted_ids[] = Category::where('id', $category)->first()->primary_id;
				}

				$product->categories()->sync($cat_inserted_ids);

			endforeach;


		}

		return 'success';

  }

  public static function delete_unexisting($model_name, $insterted_ids, $product_id)

  {

	$all_ids = $model_name::where('product_id', $product_id)->get()->pluck('id')->toArray();

	$to_delete_ids = array_diff($all_ids, $insterted_ids);

	if(!is_null($to_delete_ids)) {

		$model_name::destroy($to_delete_ids);

	}

  }

  public function refresh_db () {

  	Artisan::call("migrate:refresh", ["--force"=> true ]);

  	return 'База почищена!';

  }

}