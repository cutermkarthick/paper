/* ------------------------------------------------------------------	
 * Function to show and hide a div
 * 	divId 	- the actual id of the div to hide
 * 	show 	- boolean, if true the div is shown else its hidden
 * ------------------------------------------------------------------
 */
function showHideDiv(divId, show) {
	var div = '#' + divId;
	if (show) {
		$(div).removeClass("hidden");
		$(div).addClass("show");
		$(div).css('display', 'block !important');
	} else {
		$(div).removeClass("show");
		$(div).addClass("hidden");
		$(div).css('display', 'none !important');
	}
}
/* ------------------------------------------------------------------	
 * Utility function to layout the UI of the file upload modal dialog 
 * 	modalId 		- div of the upload image modal 
 * 	progressBarId 	- the progress bar inside the modal
 * 	booleanShowProgressBar - boolean, true means show the prog bar else show the 'click to upload' label
 * ------------------------------------------------------------------
 */
function showFileUploadProgressBar(modalId, progressBarId, booleanShowProgressBar){
	console.log("modalId=" + modalId + " progressBarId="+progressBarId + " booleanShowProgressBar=" + booleanShowProgressBar);
	//If modal is being shown and user has just started upload of files
	var modalDivId = '#'+ modalId;
	var progBar = '#'+ progressBarId;
	if(booleanShowProgressBar){
		//hide the 'click to upload' div 
		$(modalDivId).removeClass("show");
		$(modalDivId).addClass("hidden");
		$(modalDivId).css('display', 'none !important');
		//show the progress bar
		$(progBar).removeClass("hidden");
		$(progBar).addClass("show");
		$(progBar).css('display', 'block !important');
	} else {
		//file upload has completed, so show the 'click to upload' div
		$(modalDivId).removeClass("hidden");
		$(modalDivId).addClass("show");
		$(modalDivId).css('display', 'block !important');
		$(modalDivId).html("Click to Upload");
		//hide the progress bar
		$(progBar).removeClass("show");
		$(progBar).addClass("hidden");
		$(progBar).css('display', 'none !important');
	}
}

/* ------------------------------------------------------------------	
 * Utility function to show the remaining chars that can be typed in a textarea  
 * 	textareaId 		- id of the textarea input widget
 * 	feedbackDivId 	- id of the div where the remaining chars feedback will be shown
 * 	maxChars 		- maximum characters allowed
 * ------------------------------------------------------------------
 */
function showRemainingChars(textareaId, feedbackDivId, maxChars) {
	var msg = ' characters remaining';
	var textMaxChars = maxChars;
	var textLength = $('#' + textareaId).val().length;
	var textRemaining = textMaxChars - textLength;
	$('#' + feedbackDivId).html(textRemaining + msg);
	$('#' + textareaId).on('keyup', function() {
		var textLength = $('#' + textareaId).val().length;
		var textRemaining = textMaxChars - textLength;
		$('#' + feedbackDivId).html(textRemaining + msg);
	});
}


// function defineMedicalOnChange() {
//	linkInputAndRadio("currently_physician", "current_treatment");
//	linkInputAndRadio("currently_physician", "physician_name");
//
//	linkInputAndRadio("illness", "health_problem");
//	linkInputAndRadio("illness", "health_problem_dateInput");
//
//	linkInputAndRadio("blood_transfusion", "transfusion_circumstances");
//	linkInputAndRadio("tumor", "tumor_dateInput");
//
//	linkInputAndRadio("medication", "medication_list");
//
//	linkInputAndRadio("adverse_reaction_dental", "adverse_explain_dental");
//	linkInputAndRadio("adverse_reaction_medical", "adverse_explain_medical");
//
//	linkInputAndRadio("other_illness", "other_illness_explain");
//	linkInputAndRadio("biophosphonates", "biophosphonates_explain");
//}
