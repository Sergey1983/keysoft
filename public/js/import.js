$(document).ready(function() {

console.log('import.js started');

	$('#import_btn').on('click', function (event) {

		event.preventDefault();


		$.ajax({
			type: 'GET',
			url: '/get_import'
		})

		.done(
				function(data){

					alert('БАЗА ЗАГРУЖЕНА!');

				}
			)
		.fail(


			)

	});


	$('#refresh_btn').on('click', function (event) {

		event.preventDefault();


		$.ajax({
			type: 'GET',
			url: '/refresh'
		})

		.done(
				function(data){

					alert('БАЗА ПОЧИЩЕНА!');
				
				}
			)
		.fail(


			)

	});




});

$(document).ajaxStart(function() {
  $("#loading").show();
}).ajaxStop(function() {
  $("#loading").hide();
});
