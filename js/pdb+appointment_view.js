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

    function renderCalendar() 
{
var base_url=document.getElementById('base_url').value;

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

alert(window.location.origin + '/paperless/doctor_ctrl/cal_events');
       thisday = yyyy+'-'+mm+'-'+dd;
	  $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: thisday,
            lang: currentLangCode,
            buttonIcons: true, // show the prev/next text
            weekNumbers: true,
            editable: true,
            selectable: true,
           // select: function (start, end, jsEvent, view) {
         //    alert("origin : " + window.location.origin + " href : " + window.location.href + " document.URL: " + document.URL);
          //  },
		   select: function (date, jsEvent, view) {


           //alert('Clicked on: ' + date.format());
			  // alert("origin : document.URL: " + document.URL);

				/*window.open("http://localhost/paperless/doctor_ctrl/getappts4date/"+date.format(),+
				  'targetWindow','toolbar=no,location=no, status=no,'+
				  'menubar=no,scrollbars=yes, top=100, left=300,resizable=yes,'+
				  'width=400, height=400');*/


$("#appointment4dateloader").load(base_url+"doctor_ctrl/getappts4date/"+date.format());

	document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';

                   
    },
            eventLimit: true, // allow "more" link when too many events
            events: window.location.origin + '/paperless/doctor_ctrl/cal_events'
        });
		
    }

    renderCalendar();
    $('.date').datepicker({ dateFormat: "yyyy-mm-dd" });




});
