

		<div class="col-md-12" id="container">


			<div class="row">
				
				<div class="col-md-8">

					<h1>Поиск товара</h1>

				</div>

				<div class="col-md-4">

					<a href="/imports" class="btn btn-primary" style="margin-top:20px; margin-bottom:10px">Импорт баз</a>

				</div>
			
			</div>				

			{!! Form::open(['id' => 'search', 'class'=>'form'] ) !!}


				<div class = "row">
				

			 		<div class="col-md-4">

			 			<div class="control-label">

							<medium>По названию:</medium>		 			
						
						</div>

							{!! Form::text ('name', null , [ 'class'=>"form-control"])!!}


					</div>


				</div>

				<div class = "row">
				

			 		<div class="col-md-4">


			 			<div class="control-label">

							<medium>По описанию:</medium>		 			
						
						</div>						

							{!! Form::text ('description', null , [ 'class'=>"form-control"])!!}


					</div>


				</div>


				<div class = "row">
					

			 		<div class="col-md-4">

			 			<div class="control-label">

							<medium>По артиклу:</medium>		 			
						
						</div>

							{!! Form::text ('id', null , [ 'class'=>"form-control"])!!}

					</div>


				</div>


				<div class = "row">
				
			 		<div class="col-md-4">

			 			<div class="control-label">

							<medium>По магазину:</medium>		 			
						
						</div>

							{!! Form::select ('shop_id', [1 => 'OZON.ru',  2 => 'Тренажеры.Ру', 3 => 'Radio-Liga', 4 => 'Армянские Продукты'], null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}

					</div>


				</div>



				<div class="row padding-top-10 no-padding-left">
				

					<div class="col-md-3">


							{!! Form::button( 'Искать!', ['id'=>'search_button', 'class' => 'inline btn btn-success']) !!}


					</div>

				</div>

				{!! Form::close()!!}

				<span id="results"><span>



			</div>



