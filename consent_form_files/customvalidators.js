/**
 * CUSTOM VALIDATOR METHODS FOR THE JQUERYVALITION.ORG FORM VALIDATION PLUGIN
 */

/**
 * Custom date validation for Studio Dental using existing jquery.validate.js
 * library The requirement was to allow for mm/dd/yyy format or a string of 8
 * digits
 */

jQuery.validator.addMethod("customdatevalidator", function(value, element) {
	// regex to validate a mm/dd/yyyy date and for 8 numbers only
	var mmddyyyyRegex = /^(0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])[/](19|20)\d\d$/;
	var only8numbersRegex = /^[\d]{8}$/;
	return (mmddyyyyRegex.test(value) || only8numbersRegex.test(value));
}, "Enter a valid date in mm/dd/yyyy format");

jQuery.validator.addMethod("pastdatevalidator", function(value, element) {
	// regex to validate a mm/dd/yyyy date and for 8 numbers only
	var mmddyyyyRegex = /^(0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])[/](19|20)\d\d$/;
	var only8numbersRegex = /^[\d]{8}$/;
	is_valid_date = (mmddyyyyRegex.test(value) || only8numbersRegex.test(value));
	if (!is_valid_date){
		return false;
	}
	return new Date() > Date.parse(value)
}, "Future dates not allowed");


jQuery.validator.addMethod("futuredatevalidator", function(value, element) {
	// regex to validate a mm/dd/yyyy date and for 8 numbers only
	var mmddyyyyRegex = /^(0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])[/](19|20)\d\d$/;
	var only8numbersRegex = /^[\d]{8}$/;
	is_valid_date = (mmddyyyyRegex.test(value) || only8numbersRegex.test(value));
	if (!is_valid_date){
		return false;
	}
	return new Date() < Date.parse(value)
}, "Past dates not allowed");

/**
 * Custom alphanumeric validation for Studio Dental using existing
 * jquery.validate.js library The requirement was to allow for any alphabet
 * (upper and lowe case), dash, underscore and any digits
 */
jQuery.validator.addMethod("customalphanumericvalidator", function(value, element) {
	// regex to validate an alphanumeric string
	var alphaNumericRegex = /^[a-zA-Z_0-9\s-]+$/;
	return alphaNumericRegex.test(value);
}, "Only alphabets, numbers, dashes, underscores allowed.");
