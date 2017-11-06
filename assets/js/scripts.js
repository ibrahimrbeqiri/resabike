$( document ).ready(function() {
	//scripts in here:

	//Init form elements
	$(".button-collapse").sideNav();

	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15, // Creates a dropdown of 15 years to control year,
		today: 'Today',
		clear: 'Clear',
		close: 'Ok',
		closeOnSelect: false, // Close upon selecting a date,
		format: 'dd.mm.yyyy',
	});

	$('.timepicker').pickatime({
		default: 'now', // Set default time: 'now', '1:30AM', '16:30'
		fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
		twelvehour: false, // Use AM/PM or 24-hour format
		donetext: 'OK', // text for done-button
		cleartext: 'Clear', // text for clear-button
		canceltext: 'Cancel', // Text for cancel-button
		autoclose: false, // automatic close timepicker
		ampmclickable: true, // make AM PM clickable
		aftershow: function(){} //Function for after opening timepicker
	});


	$('select').material_select();
	$('.modal').modal();

	$( ".form-bikes" ).change(function() {
		if ($(this).val() == "10+") {
			$('#bike-modal').modal('open');
		}
	});


		$(document).on('click', '#regional-stations-list .delete-row', function() {
			if(confirm("Are you sure you want to delete this station?")){
			$(this).closest("tr").remove();
		}
		else{
			return false;
		}
		});

		$(document).on('click', '#reservations-list .delete-row', function() {
			if(confirm("Are you sure you want to delete this reservation?")){
			$(this).closest("tr").remove();
		}
		else{
			return false;
		}
		});


});
$(document).on('change', '.dateSelection', function() {
    $('#busdriver-submit').trigger('click');

});
