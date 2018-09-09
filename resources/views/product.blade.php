@extends('master')

@section('content')


<div class="container-fluid margin-top-25">
	
{{-- 	<div class="row">
 --}}		
		<div class="col-md-6">

			<h2> Описание товара </h2>
			
			<table class="table table-responsive table-bordered table-striped col-md-12">

				@php

				$product_arr = $product->toArray();

				$field_names = ['id' => 'Артикул',
								'shop_id' => 'Магазин',
								'url' => 'Ссылка',
								'price' => 'Цена',
								'baseprice' => 'Начальная цена',
								'name' => 'Название',
								'vendor' => 'Производитель',
								'description' => 'Описание',
								'currencyId' => 'Валюта',
								'available' => 'Наличие',
								'group_id' => 'Группа товаров',
								'delivery' => 'Доставка',
								'age' => 'Ограничения по возрасту',
								'barcode' => 'Штрихкод',
								'store' => 'Магазин',
								'pickup' => 'Самовывоз',
								'local_delivery_cost' => 'Стоимость доставки',
								'typePrefix' => 'Префикс',
								'model' => 'Модель',
								'sales_notes' => 'Дополнительные сведения',
								'manufacturer_warranty' => 'Гарантия производителя'
							];
				@endphp

{{-- 				@foreach(array_keys($product_arr) as $key)

				{{$key}}<br>

				@endforeach --}}

				@foreach($product_arr as $key => $feature)


				@if(array_key_exists($key, $field_names) && !is_null($feature))

				<tr>
					@if(in_array($feature, ['true', 'false'])) 

						@php 

						$feature = ($feature == 'true') ? 'Да' : 'Нет';							
						
						@endphp

					@endif

					<td>{{$field_names[$key]}}</td>
					<td>@if($key == 'url') <a href="{{$feature}}">{{$feature}}</a> @else {{$feature}} @endif</td>

				</tr>
				
				@endif	

				@endforeach

				</table>



				@if($product->parameters->isNotEmpty())

				<table class="table table-responsive table-bordered table-striped col-md-12">

				<h2> Дополнительные параметры </h2>

					@foreach($product->parameters as $parameter)

					<tr>
						<td>{{$parameter->name}}</td>
						<td>{{$parameter->value}}</td>
					</tr>

					@endforeach

				</table>

				@endif



			<h2> Категории </h2>

			<table class="table table-responsive table-bordered table-striped col-md-12">

			<tr>
				<td>
				
				@foreach($product->categories as $category)

					{{$category->value}}&nbsp;&nbsp;&nbsp;  

				@endforeach

				</td>

			</tr>

			</table>

		</div>
	

		<div class="col-md-6">

			<h2> Фотографии ({{$product->pictures->count()}}) </h2>

			<div class="col-md-12">

					
				@foreach($product->pictures as $picture)


					<div style="text-align: left">
					 
						<img src="{{$picture->link}}" style="max-width: 700px; max-height: 700px; width: auto; height: auto; margin-right: auto; margin-left: auto; margin-top: 10px">

					</div>


				@endforeach


		</div>

{{-- 	</div>
 --}}
</div>


@endsection