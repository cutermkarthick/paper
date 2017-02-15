$(document).ready(function () 
{
    var currentLangCode = 'en';

   
    // build the language selector's options
    $.each($.fullCalendar.langs, function (langCode) 
	{	
        $('#lang-selector').append(
                $('<option/>')
                .attr('value', langCode)
                .prop('selected', langCode == currentLangCode)
                .text(langCode)
                );
    });
    // rerender the calendar when the selected option changes
    $('#lang-selector').on('change', function () {
		
        if (this.value) {
            currentLangCode = this.value;
            $('#calendar').fullCalendar('destroy');
            renderCalendar();
        }
    });

    function renderCalendar() {
        var thisday = new Date();
       var dd = thisday.getDate();
       var mm = thisday.getMonth()+1; //January is 0!
       var yyyy = thisday.getFullYear();

       if(dd<10) {
           dd='0'+dd
       } 

       if(mm<10) {
          mm='0'+mm
       } 

       thisday = yyyy+'-'+mm+'-'+dd;		
    }
    renderCalendar();
    //$('.date').datepicker({ dateFormat: "yyyy-mm-dd" });
});

if (top.location != location) 
{
    top.location.href = document.location.href;
}
$(function() 
{
    window.prettyPrint && prettyPrint();
var thisday = new Date();
       var dd = thisday.getDate();
       var mm = thisday.getMonth()+1; //January is 0!
       var yyyy = thisday.getFullYear();
var thisday = yyyy+'-'+mm+'-'+dd;
$('#dp4').attr( 'data-date', thisday);
$('#dp4').datepicker().on('changeDate', dateChanged2);

});

$(function () {
    window.prettyPrint && prettyPrint();
var thisday = new Date();
       var dd = thisday.getDate();
       var mm = thisday.getMonth()+1; //January is 0!
       var yyyy = thisday.getFullYear();
var thisday = yyyy+'-'+mm+'-'+dd;
$('#dp5').attr( 'data-date', thisday);
$('#dp5').datepicker().on('changeDate', dateChanged3);
});
$(function () 
{
    window.prettyPrint && prettyPrint();
var thisday = new Date();
       var dd = thisday.getDate();
       var mm = thisday.getMonth()+1; //January is 0!
       var yyyy = thisday.getFullYear();
var thisday = yyyy+'-'+mm+'-'+dd;
$('#dp6').attr( 'data-date', thisday);
	$('#dp6').datepicker().on('changeDate', dateChanged4);	
});
$(function () {
    window.prettyPrint && prettyPrint();
var thisday = new Date();
       var dd = thisday.getDate();
       var mm = thisday.getMonth()+1; //January is 0!
       var yyyy = thisday.getFullYear();
var thisday = yyyy+'-'+mm+'-'+dd;
$('#dp7').attr( 'data-date', thisday);
$('#dp7').datepicker().on('changeDate', dateChanged5);
});

$(function () {
    window.prettyPrint && prettyPrint();
var thisday = new Date();
       var dd = thisday.getDate();
       var mm = thisday.getMonth()+1; //January is 0!
       var yyyy = thisday.getFullYear();
var thisday = yyyy+'-'+mm+'-'+dd;
    $('#dp3').datepicker()
});


function dateChanged(ev) 
{
    $(this).datepicker('hide');
    if ($('#startdate').val() != '' && $('#enddate').val() != '') {
        $('#period').text(diffInDays() + ' d.');
    } else {
        $('#period').text("-");
    }
}
function  dateChanged2(ev) 
{
   $('#dp4').datepicker('hide');
}
function  dateChanged3(ev) 
{
   $('#dp5').datepicker('hide');
}
function  dateChanged4(ev) 
{
   $('#dp6').datepicker('hide');
}
function  dateChanged5(ev) 
{
   $('#dp7').datepicker('hide');
}

