/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () 
{ 
	 $('#myTab').on('click','li ',function() {   

		if($('a',this).attr('href') == '#profile')	 
		 document.getElementById('mail_details').style.visibility='hidden';		 
		else
		document.getElementById('mail_details').style.visibility='visible';

	});
 })
function getpatient_name(obj)
{
document.getElementById('d_name').value =$("#patient_name option:selected").text();
}
function getpatient_name4doc(obj)
{
document.getElementById('p_name').value =$("#patient_name option:selected").text();
}
function check_req_fields4patientemail()
{
    var errmsg = '';

    if(document.getElementById('patient_name').value == 'select')
    {
	errmsg += "Please Select the Doctor \n";
    }
    if(document.getElementById('subject').value == '')
    {
	errmsg += "Please Enter the Subject\n";
    }
    if(document.getElementById('message').value == '')
    {
	errmsg += "Please Enter the Message\n";
    }
    if (errmsg == '')
    {
        document.forms['form-horizontal'].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}
function check_req_fields4email()
{
    var errmsg = '';

    if(document.getElementById('patient_name').value == 'select')
    {
	errmsg += "Please Select the Patient \n";
    }
    if(document.getElementById('subject').value == '')
    {
	errmsg += "Please Enter the Subject\n";
    }
    if(document.getElementById('message').value == '')
    {
	errmsg += "Please Enter the Message\n";
    }
    if (errmsg == '')
    {
        document.forms['form-horizontal'].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}
function getsent_value()
{
	var index=document.getElementById('sent_index').value;
	var i=1;
        if($("#sent_chk").is(':checked'))
	{
	    while(i < index)
	    {
                $('#chk_sent'+i).attr('checked', true);
                document.getElementById('chk_sent'+i).value=i;
		i++;
	    }
	}
	else
	{
	 while(i < index)
	 {
               $('#chk_sent'+i).attr('checked', false);
                document.getElementById('chk_sent'+i).value='';
		i++;
	 }
      }
}
function geteach_sentval(val)
{
   document.getElementById('chk_sent'+val).value=val;
}
function getinb_value()
{
	var index=document.getElementById('sent_index').value;
	var i=1;
        if($("#inb_chk").is(':checked'))
	{
	    while(i < index)
	    {
                $('#chk_inb'+i).attr('checked', true);
                document.getElementById('chk_inb'+i).value=i;
		i++;
	    }
	}
	else
	{
	 while(i < index)
	 {
               $('#chk_inb'+i).attr('checked', false);
                document.getElementById('chk_inb'+i).value='';
		i++;
	 }
      }
}
function geteach_inbval(val)
{
   document.getElementById('chk_inb'+val).value=val;
}
function search_inbox()
{
	document.getElementById('check_search').value=1;
	document.forms['form-horizontal_4'].submit();
}
function search_sent()
{
	document.getElementById('check_sent').value=1;
	document.forms['form-horizontal_5'].submit();
}
function messages_from_patient(name)
{
	var result = confirm("Are you sure you want to delete?");
	if (result==true) {
	    document.forms[name].submit();
       }
	else
	return false;
}

function HandleBrowseClick()
{
    var fileinput = document.getElementById("browse");
    fileinput.click();
}

function Handlechange()
{
    var fileinput = document.getElementById("browse");
    var textinput = document.getElementById("filename");
    textinput.value = fileinput.value;
}
