$(document).ready(function() 
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

document.getElementById('light').style.display='block';
document.getElementById('fade').style.display='block';

                   
    },
            eventLimit: true, // allow "more" link when too many events
            events: window.location.origin + '/paperless/doctor_ctrl/cal_events'
        });		
    }

    renderCalendar();
    $('.date').datepicker({ dateFormat: "yyyy-mm-dd" });




});

if (top.location != location) {
    top.location.href = document.location.href;
}
$(function () {
    window.prettyPrint && prettyPrint();
    var startDate = new Date(2014, 10, 10);
    var endDate = new Date(2014, 12, 12);
$('#dp4').datepicker({ 
    startDate: new Date() 
}).on('changeDate', dateChanged2);
});

$(function () 
{
    window.prettyPrint && prettyPrint();
	    $('#dp3').datepicker().on('changeDate', dateChanged1);
});


function dateChanged(ev) {
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

//added by udaya on July 21st 
function getdateval(valk)
{
	var apptime = valk.value;
	var waittime = document.getElementById('waittime').value  ;
	if (waittime.indexOf(',') > -1)
	{
		var waitt = waittime.split(',')  ;
		if(waittime.indexOf(apptime) > - 1)
		{
		document.getElementById('selectstatus').value = 'Waitlist' ;
		document.getElementById('selectstatus').disabled = true ;
		}
		else
		{
		document.getElementById('selectstatus').disabled = false ;
		document.getElementById('selectstatus').value = 'Pending'	
		}
	}
	else if(apptime == waittime)
	{
		document.getElementById('selectstatus').value = 'Waitlist' ;
		document.getElementById('selectstatus').disabled = true ;
	}
	else
	{
	document.getElementById('selectstatus').value = 'Pending' ;	
	}	

}

function dateChanged1(ev) 
{
    var $dte = $('#appt_date').attr('value');
	if(document.getElementById('loc').value == '0')
	{
		alert("Please Select the Clinic");
		document.getElementById('appt_date').value ='';
		$('#dp3').datepicker('hide');
	    return false;
	}
	if(document.getElementById('myform_patient') == null ||
		document.getElementById('myform_patient') =='' )
	{
			if(document.getElementById('operatory').value == 'sel_op' || 
				document.getElementById('operatory').value == '0')
			{
				alert("Please Select the Operatory");
				document.getElementById('appt_date').value ='';
				$('#dp3').datepicker('hide');
				return false;
			}
			$.ajax({
				url: 'getlocdetails/' + document.getElementById('loc').value+'/'+
					$('#appt_date').attr('value')+'/'+document.getElementById('operatory').value,
					dataType: 'json',
					type: 'GET',					
					success: function (data) {
						
				   calender_slots = data;
				   var $select = $("#select_time");
				   $select.removeAttr("disabled");
				   $select.find('option').remove();
					var waitarr = [] ;
					var $select_val = $("#selected_time");
					$.each(calender_slots, function (key, value) 
					{
						var res=key.split(".");
						var val=res[0]+':'+res[1]+':00';
						
						if(value == '0')		
						{
							waitarr.push(val) ;
							document.getElementById('waittime').value = waitarr ;
							$('<option enabled="disabled" style="background-color:#DFDFDF">').val(val).text(key).appendTo($select);
							$('<option>').val(key).text(value).appendTo($select_val);
						}
						else
						{
							$('<option>').val(val).text(key).appendTo($select);
							$('<option>').val(key).text(value).appendTo($select_val);
						}
					})
						},
				error: function (jqXHR, textStatus, errorThrown) {
					alert("Error : " + errorThrown);
				}
			})
				$('#dp3').datepicker('hide');
	}
	else
	{
		$.ajax({
			url: 'getlocdetails/' + document.getElementById('loc').value+'/'+
		    $('#appt_date').attr('value'),
			dataType: 'json',
			type: 'GET',				
			success: function (data) {
			   calender_slots = data;
			   var $select = $("#select_time");
			   $select.removeAttr("disabled");
			   $select.find('option').remove();
				var waitarr1 = [] ;
				var $select_val = $("#selected_time");
				$.each(calender_slots, function (key, value) 
				{
					var res=key.split(".");
					var val=res[0]+':'+res[1]+':00';
					if(value == '0')		
					{
						waitarr1.push(val) ;
						document.getElementById('waittime').value =waitarr1 ;
							
						$('<option disabled="disabled" style="background-color:#DFDFDF">').val(val).text(key).appendTo($select);
						$('<option>').val(key).text(value).appendTo($select_val);
					}
					else
					{
						$('<option>').val(val).text(key).appendTo($select);
						$('<option>').val(key).text(value).appendTo($select_val);
					}
				})
					},
			error: function (jqXHR, textStatus, errorThrown) {
				alert("Error : " + errorThrown);
			}
		})
			$('#dp3').datepicker('hide');
 }
}


$(function () {
    $('#country').change(function () {
        $.ajax({
            url: '/ajax/state',
            dataType: 'json',
            type: 'GET',
            // This is query string i.e. country_id=123
            data: {country_id: $('#country').val()},
            success: function (data) {
                $('#state').empty(); // clear the current elements in select box
                for (row in data) {
                    $('#state').append($('<option></option>').attr('value', data[row].stateId).text(data[row].stateName));
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(errorThrown);
            }
        });
    });
});
function check_req_fields4newappt()
{
    var errmsg = ''; 
	 if(document.getElementById('loc').value == 0)
    {
	errmsg += "Please select the Location \n";
    }
 if(document.forms[0].dct_name.value == '')
    {
	errmsg += "Please Enter the Doctor Name\n";
    }
 if(document.forms[0].patient_name.value == '')
    {
	errmsg += "Please Enter the Patient Name\n";
    }
 if(document.forms[0].operatory.value == 'sel_op' || document.forms[0].operatory.value == 0)
    {
	errmsg += "Please Select the Operatory\n";
    }
 if(document.forms[0].appt_date.value == '')
    {
	errmsg += "Please Select the Appointment Date\n";
    }
if(document.forms[0].appt_time.value == 'sel_date')
    {
	errmsg += "Please Select the Appointment Time\n";
    }
if(document.forms[0].appt_duration.value == '')
    {
	errmsg += "Please Select the Appointment Duration\n";
    }
	
	var apptime = document.getElementById('select_time').value ;
	var waittime = document.getElementById('waittime').value  ;
	var duration = document.getElementById('select_duration').value ;	
	var count = parseInt(duration/30) ;	

	for(var i=0;i<count;i++)
	{
	var artime = apptime.split(":") ;	
	var arhour = artime[0] ;
	var armin  = artime[1] ;
	var t = (arhour * 60)+ Number(armin) ;
	var addur =  t + 30  ;
	var endhour = parseInt(addur/60) ;
	var endmin  = parseInt(addur%60) ;

	if(endmin == '0')
	{
		endmin = '00' ;
	}
	var tottime = endhour +":"+ endmin +":00" ;
	if (waittime.indexOf(',') > -1)
		{
		var waitt = waittime.split(',')  ;
		if(waittime.indexOf(apptime) > - 1)
			{
			document.getElementById('selectstatus').value = 'Waitlist' ;
			}
		}
	else if(apptime == waittime)
		{
		document.getElementById('selectstatus').value = 'Waitlist' ;
		}
	else
		{
		document.getElementById('selectstatus').value = 'Pending' ;	
		}	
	
	apptime = tottime ;

	}
	
   if(errmsg == '')
    {
	document.getElementById('selectstatus').disabled = false ;
    document.forms[0].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}

var message="Sorry, right-click has been disabled!";

    function clickIE4(){
    if (event.button==2){
        alert(message);
        return false;
        }
    }

    function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
            if (e.which==2||e.which==3){
                alert(message);
                return false;
                }
            }
        }
        if (document.layers){
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown=clickNS4;
            }
        else if (document.all&&!document.getElementById){
            document.onmousedown=clickIE4;
        }
        document.oncontextmenu=new Function("alert(message);return false");
