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
		$('input.form-autocomplete').autocomplete({
    		data: {
    			"Niouc, Les Saints Innocents": null,
    			"Niouc, village": null,
    			"Sierre, Sentier de Chippis": null,
    			"Sierre, Bois-de-Finges": null,
    			"Sierre, Parc de Finges": null,
    			"Sierre, Glarey": null,
    			"Sierre, Borsuat": null,
    			"Sierre, poste gare": null,
    			"Les Pontis": null,
    			"Vissoie, poste": null,
    			"Grimentz, poste": null,
    			"Grimentz, Carovilla": null,
    			"Grimentz, Roua": null,
    			"Grimentz, les Aires": null,
    			"Grimentz, Les Fioz": null,
    			"St-Jean VS, village": null,
    			"Vissoie, Mayoux-village": null,
    			"Zinal, poste": null,
    			"Zinal, Le Bouillet": null,
    			"Zinal, Pralong": null,
    			"Mottec": null,
    			"Ayer, Les Morasses": null,
    			"Ayer, Les Grands Praz": null,
    			"Ayer, anc. poste": null,
    			"Ayer, Prarrayer": null,
    			"Ayer, Blanche Pierre": null
    		},
    		limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
    		onAutocomplete: function(val) {
    			// Callback function when value is autcompleted.
    		},
    		minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    	});



		$('#add-table-row').click(function() {
			$('#regional-stations-list tbody').append('<tr>\
				<td><input type="text" name="id" value=""></td>\
				<td><input type="text" name="name" value=""></td>\
				<td><a class="btn-floating delete-row"><i class="material-icons">delete</i></a></td>\
			    </tr>\
				');
		});






});

$(document).on('click', '#regional-stations-list .delete-row', function() {
	if(confirm("Are you sure you want to delete this station?")){
	$(this).closest("tr").remove();
}
else{
	return false;
}
});
