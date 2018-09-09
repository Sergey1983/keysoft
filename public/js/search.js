$(document).ready(function() {

console.log('search.js started');

	$('#search_button').on('click', function (event) {

		event.preventDefault();

		disable_button_for_2_secs($('#search_button'));

		$('#results').empty();

		var fields = ['id', 'name', 'description'];

		var total_length = 0;

		for (var i = 0; i < fields.length; i++) {


			total_length = total_length + $('input[name="'+fields[i]+'"]').val().length;

		}

		total_length = total_length + $('select[name="shop_id"]').val().length;

		if(total_length == 0) {


			$('#results').append('Хотя бы одно поле должно быть заполнено!');
		}

		else {




				var search = $('#search').serialize();

				$.ajax({
					type: 'get',
					url: '/search',
					data: search
				}) 

				.done(
						function(data){

							data = JSON.parse(data);
							console.log(data);

							if(data == 'Ничего не найдено!') {

								$('#results').append('Ничего не найдено');

							} else {

							var shops = ['ОЗОН.РУ','Тренажеры.РУ','Радио','Армянск. Продукты'];

							$('#results').append('<table id="results" class="table table-responsive table-bordered table-striped col-md-12">'+

								'<thead><tr><th>Магазин</th><th>Артикул</th><th>Название</th><th>Модель</th><th><Просмотр></th></tr></thead><tbody id="tbody"></tbody></table>'

								);

								$.each(data, function(index, values){





									$('#tbody').append('<tr>'+

										'<td class="padding-left-10">'+shops[values.shop_id - 1]  +'</td>'+										
										'<td class="padding-left-10">'+values.id+'</td>'+
										'<td class="padding-left-10">'+ (values.name == null ? '' : values.name) +'</td>'+
										'<td class="padding-left-10">'+values.model+'</td>'+
										'<td class="padding-left-10"><a href="/'+values.primary_id+'">Смотреть</td>'+



										'<tr>');
								});


							}

						}
					)
				.fail(function (data) {


					console.log(data);

					$('#results').append('Неизвестная ошибка при поиске! Обратитесь к администратору');

					});

		}

	});

	function disable_button_for_2_secs (button) {

				var btn = button;

			    btn.prop('disabled', true);

			    setTimeout(function(){

			        btn.prop('disabled', false);

			    }, 3000);

}


});
