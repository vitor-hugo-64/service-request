((function ( w, d) {
	'use strict';

	d.querySelector("[data-js='input']").focus();

	var $form = d.querySelector("[data-js='form']");

	// EVENTO DE SUBMIT //
	if ($form) {
		$form.addEventListener( 'submit', function (e) {

			var $input = d.querySelectorAll("[data-js='input']");

			for (var i = 0; i < $input.length; i++) {
				if (!$input[i].value) {
					e.preventDefault();
					w.alert('O campo "' + $input[i].dataset.information + '" não pode ser nulo');
					$input[i].focus();
					break;
				}
			}


		}, false);
	}


})( window, document));