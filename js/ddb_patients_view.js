$(document).ready(function($)
{
    $(".clickableRow").click(function() 
    {
            window.document.location = $(this).attr("href");
    });
});
function check_session()
{
   document.getElementById('check_search').value=1;
   document.forms['form-horizontal_4'].submit();
}
function check_session4family()
{
document.getElementById('check_search').value=1;
document.forms['form-horizontal_4'].value.value='familymember';
   document.forms['form-horizontal_4'].submit();
}
function getattachment_details()
{
  var attach=document.getElementById('attach').value;
  var base_url=document.getElementById('base_url').value;

/*win1 = window.open(base_url+"application/attachments/"+attach,param, +
	"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
	",width=" + winWidth + ",height=" + winHeight +
	",top="+winTop+",left="+winLeft);*/
	//$( "body" ).load( "viewattachment.html" );

	$("#attachmentloader").load(base_url+"application/views/viewattachment.php?attach="+attach+"&base="+base_url);

document.getElementById('light').style.display='block';
document.getElementById('fade').style.display='block';
}


function check_req_fields4newfamilymem()
{
    var errmsg = ''; 
    if(document.forms[0].email.value == '')
    {
	errmsg += "Please Enter the Email Id\n";
    }
    var emailField=document.forms[0].email.value;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(emailField) == false) 
    {
           errmsg += "Invalid Email Address \n";          
    }
    if(document.forms[0].fname.value == '')
    {
	errmsg += "Please Enter the First Name\n";
    }
    if(document.forms[0].year.value == '')
    {
	errmsg += "Please enter the Year in Date Of Birth\n";
    }
    if(document.forms[0].referred_by.value == '')
    {
	errmsg += "Please Enter Reference Name \n";
    }
    var emer_email=document.forms[0].emer_email.value;
    if (reg.test(emer_email) == false) 
    {
           errmsg += "Invalid Email Address in Emergency Tab\n";          
    }
    if(errmsg == '')
    {
        document.forms[0].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}
function check_req_fields4newregistration(param)
{
//alert(param);
    var errmsg = ''; var home_flag=0;var cell_flag=0;var work_flag=0;
var emerhome_flag=0;var emercell_flag=0;var emerwork_flag=0;

var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
/***********personal info*******************/
if(param == 'profile1')
{
if(document.forms[0].email.value == '' ||
document.forms[0].email.value == '' ||
document.forms[0].fname.value == '' ||
document.forms[0].lname.value == '' ||
document.forms[0].gender.value == '' ||
document.forms[0].addr.value == '' ||
document.forms[0].city.value == '' ||
document.forms[0].state.value == '' ||
document.forms[0].zip.value == '' ||
document.forms[0].preferred_contact_mode.value == '')
{
   errmsg += "<b>Please Correct These Errors under Personal Information Tab</b><br><br>";
}

    if(document.forms[0].email.value == '')
    {
	errmsg += "Please Enter the Email Id<br>";
    }
    var emailField=document.forms[0].email.value;
    
    if (reg.test(emailField) == false) 
    {
           errmsg += "Invalid Email Address <br>";          
    }
    if(document.forms[0].fname.value == '')
    {
	errmsg += "Please Enter the First Name<br>";
    }
if(document.forms[0].lname.value == '')
    {
	errmsg += "Please Enter the Last Name<br>";
    }
   if(document.forms[0].year.value == '')
    {
	errmsg += "Please enter the Year in Date Of Birth<br>";
    }
if(document.forms[0].gender.value == '')
    {
	errmsg += "Please enter the Gender<br>";
    }
if(document.forms[0].addr.value == '')
    {
	errmsg += "Please Enter the Personal Address<br>";
    }
if(document.forms[0].city.value == '')
    {
	errmsg += "Please Enter the City<br>";
    }
if(document.forms[0].state.value == '')
    {
	errmsg += "Please Enter the State<br>";
    }
if(document.forms[0].zip.value == '')
    {
	errmsg += "Please Enter the Zip Code<br>";
    }

   if(document.forms[0].home_phone1.value == '' && 
document.forms[0].home_phone2.value == '' &&
document.forms[0].home_phone3.value == '')
    {
	home_flag=1;
    }
if(document.forms[0].cell_phone4peronal1.value == '' && 
document.forms[0].cell_phone4peronal2.value == '' && 
document.forms[0].cell_phone4peronal3.value == '')
    {
	cell_flag=1;
    }
if(document.forms[0].work_phone4peronal1.value == '' && 
document.forms[0].work_phone4peronal2.value == '' && 
document.forms[0].work_phone4peronal3.value == '')
    {
	work_flag=1;
    }

if(home_flag == 1 && cell_flag == 1 && work_flag == 1)
{
errmsg += "Please Enter atleast one valid Phone# in Personal Info<br>";
}

if(cell_flag == 0  && (document.forms[0].cell_phone4peronal1.value == '' || document.forms[0].cell_phone4peronal2.value == '' || document.forms[0].cell_phone4peronal3.value == ''))
    {
	errmsg += "Please Enter the Correct Cell Phone# in Personal Info<br>";
    }
if(work_flag == 0 && (document.forms[0].work_phone4peronal1.value == '' || document.forms[0].work_phone4peronal2.value == '' || document.forms[0].work_phone4peronal3.value == ''))
    {
	errmsg += "Please Enter the Correct Work Phone# in Personal Info<br>";
    }
if(home_flag == 0 && (document.forms[0].home_phone1.value == '' || document.forms[0].home_phone2.value == '' ||
document.forms[0].home_phone3.value == ''))
{
errmsg += "Please Enter the Correct Home Phone# in Personal Info<br>";
}

   if(document.forms[0].preferred_contact_mode.value == '')
    {
	errmsg += "Please Enter Preferred Contact Mode<br>";
    }


}






else if(param == 'dropdown11')
{

if(document.forms[0].emer_fname.value == '' ||
document.forms[0].emer_lname.value == '' ||
document.forms[0].emer_relation.value == '')
{
 errmsg += "<b>Please Correct These Errors under Emergency Information Tab</b><br><br>";
}

 if(document.forms[0].emer_fname.value == '')
    {
	errmsg += "Please Enter Emergency First Name<br>";
    }
if(document.forms[0].emer_lname.value == '')
    {
	errmsg += "Please Enter Emergency Last Name<br>";
    }
if(document.forms[0].emer_homenum1.value == '' && document.forms[0].emer_homenum2.value == '' && document.forms[0].emer_homenum3.value == '')
    {
	emerhome_flag=1;
    }
if(document.forms[0].emer_cellnum1.value == '' && document.forms[0].emer_cellnum2.value == '' && document.forms[0].emer_cellnum3.value == '')
    {
	emercell_flag=1;
    }
if(document.forms[0].emer_worknum1.value == '' && document.forms[0].emer_worknum2.value == '' && document.forms[0].emer_worknum3.value == '')
    {
	emerwork_flag=1;
    }
if(emerhome_flag == 1 && emercell_flag == 1 && emerwork_flag == 1)
{
errmsg += "Please Enter atleast one valid Phone# in Emergency Info<br>";
}

if(emerhome_flag == 0 && (document.forms[0].emer_homenum1.value == '' || document.forms[0].emer_homenum2.value == '' || 
document.forms[0].emer_homenum3.value == ''))
    {
	errmsg += "Please Enter the Correct Home Phone# in Emergency Info<br>";
    }
if(emercell_flag == 0 && (document.forms[0].emer_cellnum1.value == '' || document.forms[0].emer_cellnum2.value == '' || document.forms[0].emer_cellnum3.value == ''))
    {
	errmsg += "Please Enter the Correct Cell Phone# in Emergency Info<br>";
    }

if(emerwork_flag == 0 && (document.forms[0].emer_worknum1.value == '' || document.forms[0].emer_worknum2.value == '' || document.forms[0].emer_worknum3.value == ''))
    {
	errmsg += "Please Enter the Correct Work Phone# in Emergency Info<br>";
    }
/*************************removed on march 26th 2015**/
 /*if(document.forms[0].emer_email.value == '')
    {
	errmsg += "Please Enter Emergency Email#\n";
    }

    var emer_email=document.forms[0].emer_email.value;
    if (reg.test(emer_email) == false) 
    {
           errmsg += "Invalid Email Address in Emergency Tab\n";          
    }
*/
 if(document.forms[0].emer_relation.value == '')
    {
	errmsg += "Please Enter relationship in Emergency Info <br>";
    }

}




else if(param == 'dropdown21')
	   {
if(document.forms[0].height_inches.value == '' ||
document.forms[0].weight_lbs.value == '' )
{
errmsg += "<b>Please Correct These Errors under Health History Tab</b><br><br>";
}

 if(document.forms[0].height_inches.value == '')
    {
	errmsg += "Please Enter Hight in Health History <br>";
    }
 if(document.forms[0].weight_lbs.value == '')
    {
	errmsg += "Please Enter Wight in Health History <br>";
    }
}

    if(errmsg == '')
    {
	if( param != 'dropdown21' && param != 'profile1' && param != 'dropdown11' && param!='home1' && param!='dental_history' && param != 'surgery1' && param != 'postsurgery1')
	{
        	document.forms[0].submit();
	}
	return true;
    }
    else
    {
// 	$( "#dialog" ).html(errmsg);
// 	$( "#dialog" ).dialog({
// 				modal: true,
// 				 width: 500,
// 				 buttons: [
// 				{
// 				text: "OK",
// 				click: function() {
// 				$( this ).dialog( "close" );
// 				}
// 				}
// ]}).prev(".ui-dialog-titlebar").css("background","#70DBDB");
//        //alert (errmsg);
        return true;
    }
}
function check_req_fields4newregistration4patient()
{
var errmsg = ''; var home_flag=0;var cell_flag=0;var work_flag=0;
var emerhome_flag=0;var emercell_flag=0;var emerwork_flag=0;
if(document.forms[0].email.value == '' ||
document.forms[0].email.value == '' ||
document.forms[0].fname.value == '' ||
document.forms[0].lname.value == '' ||
document.forms[0].gender.value == '' ||
document.forms[0].addr.value == '' ||
document.forms[0].city.value == '' ||
document.forms[0].state.value == '' ||
document.forms[0].zip.value == '' ||
document.forms[0].preferred_contact_mode.value == '')
{
   errmsg += "\nPersonal Info Validation \n\n";
}

    if(document.forms[0].email.value == '')
    {
	errmsg += "Please Enter the Email Id\n";
    }
    var emailField=document.forms[0].email.value;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(emailField) == false) 
    {
           errmsg += "Invalid Email Address \n";          
    }
    if(document.forms[0].fname.value == '')
    {
	errmsg += "Please Enter the First Name\n";
    }
if(document.forms[0].lname.value == '')
    {
	errmsg += "Please Enter the Last Name\n";
    }
 if(document.forms[0].year.value == '')
    {
	errmsg += "Please enter the Year in Date Of Birth\n";
    }
if(document.forms[0].gender.value == '')
    {
	errmsg += "Please enter the Gender\n";
    }
if(document.forms[0].addr.value == '')
    {
	errmsg += "Please Enter the Personal Address\n";
    }
if(document.forms[0].city.value == '')
    {
	errmsg += "Please Enter the City\n";
    }
if(document.forms[0].state.value == '')
    {
	errmsg += "Please Enter the State\n";
    }
if(document.forms[0].zip.value == '')
    {
	errmsg += "Please Enter the Zip Code\n";
    }
/*
if(document.forms[0].home_phone1.value == '' || document.forms[0].home_phone2.value == '' ||
document.forms[0].home_phone3.value == '')
    {
	errmsg += "Please Enter the Correct Home Phone# in Personal Info\n";
    }
if(document.forms[0].cell_phone4peronal1.value == '' || document.forms[0].cell_phone4peronal2.value == '' || document.forms[0].cell_phone4peronal3.value == '')
    {
	errmsg += "Please Enter the Correct Cell Phone# in Personal Info\n";
    }
if(document.forms[0].work_phone4peronal1.value == '' || document.forms[0].work_phone4peronal2.value == '' || document.forms[0].work_phone4peronal3.value == '')
    {
	errmsg += "Please Enter the Correct Work Phone# in Personal Info\n";
    }
*/
if(document.forms[0].home_phone1.value == '' && 
document.forms[0].home_phone2.value == '' &&
document.forms[0].home_phone3.value == '')
    {
	home_flag=1;
    }
if(document.forms[0].cell_phone4peronal1.value == '' && 
document.forms[0].cell_phone4peronal2.value == '' && 
document.forms[0].cell_phone4peronal3.value == '')
    {
	cell_flag=1;
    }
if(document.forms[0].work_phone4peronal1.value == '' && 
document.forms[0].work_phone4peronal2.value == '' && 
document.forms[0].work_phone4peronal3.value == '')
    {
	work_flag=1;
    }

if(home_flag == 1 && cell_flag == 1 && work_flag == 1)
{
errmsg += "Please Enter atleast one valid Phone#\n";
}

if(cell_flag == 0  && (document.forms[0].cell_phone4peronal1.value == '' || document.forms[0].cell_phone4peronal2.value == '' || document.forms[0].cell_phone4peronal3.value == ''))
    {
	errmsg += "Please Enter the Correct Cell Phone# in Personal Info\n";
    }
if(work_flag == 0 && (document.forms[0].work_phone4peronal1.value == '' || document.forms[0].work_phone4peronal2.value == '' || document.forms[0].work_phone4peronal3.value == ''))
    {
	errmsg += "Please Enter the Correct Work Phone# in Personal Info\n";
    }
if(home_flag == 0 && (document.forms[0].home_phone1.value == '' || document.forms[0].home_phone2.value == '' ||
document.forms[0].home_phone3.value == ''))
{
errmsg += "Please Enter the Correct Home Phone# in Personal Info\n";
}

   if(document.forms[0].preferred_contact_mode.value == '')
    {
	errmsg += "Please Enter Preferred Contact Mode\n";
    }
if(document.forms[0].emer_fname.value == '' ||
document.forms[0].emer_lname.value == '' ||
document.forms[0].emer_email.value == '' ||
document.forms[0].emer_relation.value == '')
{
 errmsg += "\nEmergency Info Validation \n\n";
}

 if(document.forms[0].emer_fname.value == '')
    {
	errmsg += "Please Enter Emergency First Name\n";
    }
if(document.forms[0].emer_lname.value == '')
    {
	errmsg += "Please Enter Emergency Last Name\n";
    }
if(document.forms[0].emer_homenum1.value == '' && document.forms[0].emer_homenum2.value == '' && document.forms[0].emer_homenum3.value == '')
    {
	emerhome_flag=1;
    }
if(document.forms[0].emer_cellnum1.value == '' && document.forms[0].emer_cellnum2.value == '' && document.forms[0].emer_cellnum3.value == '')
    {
	emercell_flag=1;
    }
if(document.forms[0].emer_worknum1.value == '' && document.forms[0].emer_worknum2.value == '' && document.forms[0].emer_worknum3.value == '')
    {
	emerwork_flag=1;
    }
if(emerhome_flag == 1 && emercell_flag == 1 && emerwork_flag == 1)
{
errmsg += "Please Enter atleast one valid Phone# in Emergency Info\n";
}

if(emerhome_flag == 0 && (document.forms[0].emer_homenum1.value == '' || document.forms[0].emer_homenum2.value == '' || document.forms[0].emer_homenum3.value == ''))
    {
	errmsg += "Please Enter the Correct Home Phone# in Emergency Info\n";
    }
if(emercell_flag == 0 && (document.forms[0].emer_cellnum1.value == '' || document.forms[0].emer_cellnum2.value == '' || document.forms[0].emer_cellnum3.value == ''))
    {
	errmsg += "Please Enter the Correct Cell Phone# in Emergency Info\n";
    }
if(emerwork_flag == 0 && (document.forms[0].emer_worknum1.value == '' || document.forms[0].emer_worknum2.value == '' || document.forms[0].emer_worknum3.value == ''))
    {
	errmsg += "Please Enter the Correct Work Phone# in Emergency Info\n";
    }
 if(document.forms[0].emer_email.value == '')
    {
	errmsg += "Please Enter Emergency Email#\n";
    }
    var emer_email=document.forms[0].emer_email.value;
    if (reg.test(emer_email) == false) 
    {
           errmsg += "Invalid Email Address in Emergency Tab\n";          
    }
 if(document.forms[0].emer_relation.value == '')
    {
	errmsg += "Please Enter relationship in Emergency Info \n";
    }
if(document.forms[0].height_inches.value == '' ||
document.forms[0].weight_lbs.value == '' )
{
errmsg += "\nHealth History Validation \n\n";
}
 if(document.forms[0].height_inches.value == '')
    {
	errmsg += "Please Enter Hight in Health History \n";
    }
 if(document.forms[0].weight_lbs.value == '')
    {
	errmsg += "Please Enter Weight in Health History \n";
    }



if(document.forms[0].reason_text.value == '' ||
document.forms[0].former_dentist_name.value == '' ||
document.forms[0].last_dental_date.value == '' ||
document.forms[0].last_dental_xray_date.value == '')
{
errmsg += "\nDental History Validation \n\n";
}
 if(document.forms[0].reason_text.value == '')
    {
	errmsg += "Please Enter Reason for visit in Dental History \n";
    }
if(document.forms[0].former_dentist_name.value == '')
    {
	errmsg += "Please Enter Dentist name in Dental History \n";
    }
  if(document.forms[0].last_dental_date.value == '')
    {
	errmsg += "Please Enter Last dental exam date in Dental History \n";
    }
   if(document.forms[0].last_dental_xray_date.value == '')
    {
	errmsg += "Please Enter Last dental exam date in Dental History \n";
    }
    if(errmsg == '')
    {
        document.forms[0].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}


function check_req_fields4password()
{
    var errmsg = ''; 
    if(document.forms[0].email.value == '')
    {
	errmsg += "Please Enter the Email Id\n";
    }
    if(errmsg == '')
    {
        document.forms[0].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}


function check_req_fields4dental_history()
{
    var errmsg = ''; 
    if(document.forms['form-horizontal90'].reason_text.value == '')
    {
	errmsg += "Please Enter the reason for today's visit\n";
    }
  if(document.forms['form-horizontal90'].reason_text.value == '')
    {
	errmsg += "Please Enter the reason for today's visit\n";
    }
  if(document.forms['form-horizontal90'].former_dentist_name.value == '')
    {
	errmsg += "Please Enter Dentist Name\n";
    }
 if(document.forms['form-horizontal90'].last_dental_date.value == '')
    {
	errmsg += "Please Select Last dental exam Date\n";
    }
 if(document.forms['form-horizontal90'].last_dental_xray_date.value == '')
    {
	errmsg += "Please Select Last dental xray exam Date\n";
    }

    if(errmsg == '') 
    {
	document.forms['form-horizontal90'].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}

function check_req_fieds4consent()
{
	var errmsg = ''; 

	if(document.forms['form-horizontal120'].output4treatment.value == '' &&
	document.forms['form-horizontal120'].output4drug_med.value == '' &&
	document.forms['form-horizontal120'].output4treat_plan.value == '' &&
	document.forms['form-horizontal120'].output4extraction.value == '' &&
	document.forms['form-horizontal120'].output4crown.value == '' &&
	document.forms['form-horizontal120'].output4denture.value == '' &&
	document.forms['form-horizontal120'].output4endodontic.value == '' &&
	document.forms['form-horizontal120'].output4peridontal.value == '' &&
	document.forms['form-horizontal120'].output4filling.value == '' &&
	document.forms['form-horizontal120'].output4pedodontic.value == '')
	{
	errmsg += "Please Enter the Consent \n";
	}
	if(document.forms['form-horizontal120'].output4treatment.value == '' &&
	document.forms['form-horizontal120'].output4drug_med.value == '' &&
	document.forms['form-horizontal120'].output4treat_plan.value == '' &&
	document.forms['form-horizontal120'].output4extraction.value == '' &&
	document.forms['form-horizontal120'].output4crown.value == '' &&
	document.forms['form-horizontal120'].output4denture.value == '' &&
	document.forms['form-horizontal120'].output4endodontic.value == '' &&
	document.forms['form-horizontal120'].output4peridontal.value == '' &&
	document.forms['form-horizontal120'].output4filling.value == '' &&
	document.forms['form-horizontal120'].output4pedodontic.value == '' &&
	document.forms['form-horizontal120'].output4patientsign.value !=  '')
	{
	errmsg += "Please Enter the Consent before draw the patient Signature\n";
	}
	if(document.forms['form-horizontal120'].output4treatment.value == '' &&
	document.forms['form-horizontal120'].output4drug_med.value == '' &&
	document.forms['form-horizontal120'].output4treat_plan.value == '' &&
	document.forms['form-horizontal120'].output4extraction.value == '' &&
	document.forms['form-horizontal120'].output4crown.value == '' &&
	document.forms['form-horizontal120'].output4denture.value == '' &&
	document.forms['form-horizontal120'].output4endodontic.value == '' &&
	document.forms['form-horizontal120'].output4peridontal.value == '' &&
	document.forms['form-horizontal120'].output4filling.value == '' &&
	document.forms['form-horizontal120'].output4pedodontic.value == '' &&
	document.forms['form-horizontal120'].output4dentistsign.value !=  '')
	{
	errmsg += "Please Enter the Consent before draw the Doctor Signature\n";
	}
	if(document.forms['form-horizontal120'].output4treatment.value == '' &&
	document.forms['form-horizontal120'].output4drug_med.value == '' &&
	document.forms['form-horizontal120'].output4treat_plan.value == '' &&
	document.forms['form-horizontal120'].output4extraction.value == '' &&
	document.forms['form-horizontal120'].output4crown.value == '' &&
	document.forms['form-horizontal120'].output4denture.value == '' &&
	document.forms['form-horizontal120'].output4endodontic.value == '' &&
	document.forms['form-horizontal120'].output4peridontal.value == '' &&
	document.forms['form-horizontal120'].output4filling.value == '' &&
	document.forms['form-horizontal120'].output4pedodontic.value == '' &&
	document.forms['form-horizontal120'].output4witnesssign.value !=  '')
	{
	errmsg += "Please Enter the Consent before draw the Witness Signature\n";
	}

	if(document.forms['form-horizontal120'].output4patientsign.value == '')
	{
	errmsg += "Please draw the Patient Signature\n";
	}

if(document.forms['form-horizontal120'].login.value != 'patient')
{
	if(document.forms['form-horizontal120'].output4dentistsign.value == '')
	{
	errmsg += "Please draw the Doctor Signature\n";
	}
	if(document.forms['form-horizontal120'].output4witnesssign.value == '')
	{
	errmsg += "Please draw the Witness Signature\n";
	}
    if(document.forms['form-horizontal120'].output4dentistsign.value != '' &&
document.forms['form-horizontal120'].consent_doctor_name.value == 'select')
	{
	errmsg += "Please select the Dentist\n";
	}
if(document.forms['form-horizontal120'].output4witnesssign.value != '' &&
document.forms['form-horizontal120'].witness.value == '')
	{
	errmsg += "Please enter the Witness name\n";
	}
}
    if(errmsg == '') 
    {
	document.forms['form-horizontal120'].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}
function getpatiet_id(id)
{
     document.forms['form-horizontal120'].val.value=id;
     document.forms['form-horizontal120'].submit();
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


	
//<!--[if lt IE 9]>
//<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
//<![endif]-->


function check_req_fields4newregistration1()
{
	var errmsg =''
	
	if(document.forms[0].loc.value == '')
    {
	errmsg += "Please Select the Clinic's Name\n";
    }
    var loc=document.forms[0].loc.value;
	
	if(document.forms[0].dct_name.value == '0')
    {
	errmsg += "Please Select the Doctor's Name\n";
    }
    var dct=document.forms[0].dct_name.value;
	
    if(document.forms[0].email.value == '')
    {
	errmsg += "Please Enter the Email Id\n";
    }
    var emailField=document.forms[0].email.value;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(emailField) == false) 
    {
           errmsg += "Invalid Email Address \n";          
    }
	
	if(document.forms[0].fname.value == '')
    {
	errmsg += "Please Enter the First Name \n";
    }

	
	 if(document.forms[0].lname.value == '')
    {
	errmsg += "Please Enter the Last Name Id\n";
    }
	
	if(document.forms[0].cell_phone4peronal1.value == '' && 
	document.forms[0].cell_phone4peronal2.value == '' && 
	document.forms[0].cell_phone4peronal3.value == '')
    {
	errmsg += "Please Enter the Correct Cell Phone Number";
    }

	
	if(errmsg == '')
    {
        document.forms[0].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}

function check_req_fields4newregistration4admin()
{
	var errmsg =''
	
	if(document.forms[0].clinicname.value == '')
    {
	errmsg += "Please Enter the Clinic Name\n";
    }
    var clinicname=document.forms[0].clinicname.value;
	
    if(document.forms[0].email.value == '')
    {
	errmsg += "Please Enter the Email Id\n";
    }
    var emailField=document.forms[0].email.value;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(emailField) == false) 
    {
           errmsg += "Invalid Email Address \n";          
    }
		
	if(document.forms[0].cell_phone4peronal1.value == '' && 
	document.forms[0].cell_phone4peronal2.value == '' && 
	document.forms[0].cell_phone4peronal3.value == '')
    {
	errmsg += "Please Enter the Correct Cell Phone Number";
    }

	
	if(errmsg == '')
    {
        document.forms[0].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}