/*
 * form_validation.js
 *
 * Demo JavaScript used on Validation-pages.
 */

"use strict";

$(document).ready(function(){

	//===== Validation =====//
	// @see: for default options, see assets/js/plugins.form-components.js (initValidation())

	$.extend( $.validator.defaults, {
		invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1
				? 'You missed 1 field. It has been highlighted.'
				: 'You missed ' + errors + ' fields. They have been highlighted.';
				noty({
					text: message,
					type: 'error',
					timeout: 2000
				});
			}
		},
		errorPlacement: function(error, element) {
			 if (element.attr('type') === "file" && element.data('style') === "fileinput"){
				 error.appendTo(element.closest("div.fileinput-holder").parent('div'));
			 } else {
				 error.insertAfter(element)
			 }
		}
	});


	/*
	ovde smo dodali u /stranice/dodajartikal
	 * <input type="file" multiple="multiple" maxlength="10" class="multi with-preview max-3 accept-gif|jpg|png fileIgnorisi" />
	 * http://jqueryvalidation.org/validate/
	  * */
	$("#validate-1").validate({
		ignore: ".fileIgnorisi"
	});

	$("#validate-2").validate();
	$("#validate-3").validate();
	$("#validate-4").validate();

});