@extends('master')


@section('content')

	<div class="container-fluid">

		<div class="col-md-12">

			<button type="button" class="btn btn-primary" id="import_btn" style="margin-top: 20px;margin-bottom:10px;">Запустить импорт?</button>

		</div>




		<div class="col-md-12">

			<button type="button" class="btn btn-success" id="refresh_btn" style="margin-top: 20px;margin-bottom:10px;">Очистить базу?</button>

		</div>


		<div id="loading" style="display:none;padding-left:50px">
			<!-- You can add gif image here 
			for this demo we are just using text -->
			Loading...
		</div>

	</div>

<script type="text/javascript" src="{{ URL::asset('js/import.js') }}"></script>

@endsection