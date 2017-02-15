function number_validation(obj,i)
{	
	var val=obj.value;
	var len=val.length;	
         len=len+1;
	var j=i+1;	
	if(isNaN(document.getElementById('phone'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('phone'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('phone'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('phone'+i).value='';
		   document.getElementById('phone'+x).focus();
		   return false;
		}
		if(document.getElementById('phone'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('phone'+i).value='';
		   document.getElementById('phone'+x).focus();
		   return false;
		}
	}

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('phone'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('phone'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('phone'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('phone'+i).value=str;
			 document.getElementById('phone'+j).focus();
		}		
		document.getElementById('fax1').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('phone'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('phone'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('phone'+i).focus();
		}		
		document.getElementById('fax1').focus();
	}

}
function check_req_fields4clinic()
{
    var errmsg = '';var licount  = 0 ;
    if(document.forms['form-horizontal2'].clinic.value == '')
    {
	errmsg += "Please Enter the Clinic \n";
    }
	    if(document.forms['form-horizontal2'].location.value == '')
	    {
		errmsg += "Please Enter the Location \n";
	    } 
	    if(document.forms['form-horizontal2'].phone1.value == '')
	    {
		errmsg += "Please Enter the Phone# \n";
	    } 
            if(document.forms['form-horizontal2'].fax1.value == '')
	    {
		errmsg += "Please Enter the Fax \n";
	    } 
           if(document.forms['form-horizontal2'].website.value == '')
	    {
		errmsg += "Please Enter the Website \n";
	    } 
var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
var website=document.forms['form-horizontal2'].website.value;
if (!myRegExp.test(website) && website != '')
{
  errmsg += "Not a valid Website\n";
}

if(isNaN(document.getElementById('phone1').value) == true)
	    {
                 errmsg += "Please Enter only number for Phone \n";
            }
            if(isNaN(document.getElementById('fax1').value) == true)
	    {
                 errmsg += "Please Enter only number for FAX \n";
            }
	if(document.forms['form-horizontal2'].city.value == '')
	    {
		errmsg += "Please Enter the City \n";
	    } 
	if(document.forms['form-horizontal2'].state.value == '')
	    {
		errmsg += "Please Enter the State \n";
	    } 
if(document.forms['form-horizontal2'].home.checked == false &&
document.forms['form-horizontal2'].profile.checked == false &&
document.forms['form-horizontal2'].appts.checked == false &&
document.forms['form-horizontal2'].msg.checked == false &&
document.forms['form-horizontal2'].report.checked == false	)
	    {
		errmsg += "Please Select atleast one Menu Item\n";
	    } 

          

	for(var j=1;j<=5;j++)
	{
	var opname="op_name"+j;

	if(document.getElementById(opname).value!= '')
	{
	licount=1;
	}
	}
	if(licount == 0)
	{
		  errmsg += "Please Enter atleast One Operatory  \n";		
	}
    if (errmsg == '')
    {
        document.forms['form-horizontal2'].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}
function check4num()
{
 if(isNaN(document.getElementById('fax').value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('fax').value='';
		   return false;
	}
}
function check4num4zip()
{
 if(isNaN(document.getElementById('zip').value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('zip').value='';
		   return false;
	}
}
function check_req_fields4doc()
{
    var errmsg = ''; 
    if(document.forms[0].fname.value == '')
    {
	errmsg += "Please Enter the First Name \n";
    }
    if(document.forms[0].city.value == '')
    {
	errmsg += "Please Enter the City \n";
    }
    if(document.forms[0].state.value == '')
    {
	errmsg += "Please Enter the State \n";
    }
if(document.forms[0].phone1.value == '')
    {
	errmsg += "Please Enter the Phone Number \n";
    }
if(document.forms[0].email.value == '')
    {
	errmsg += "Please Enter the Email ID \n";
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
function number_validation4fax(obj,i)
{	
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('fax'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('fax'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('fax'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('fax'+i).value='';
		   document.getElementById('fax'+x).focus();
		   return false;
		}
		if(document.getElementById('fax'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('fax'+i).value='';
		   document.getElementById('fax'+x).focus();
		   return false;
		}
	}	

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('fax'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('fax'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('fax'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('fax'+i).value=str;
			 document.getElementById('fax'+j).focus();
		}		
		document.getElementById('website').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('fax'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('fax'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('fax'+i).focus();
		}		
		document.getElementById('website').focus();
	}

}

function search_clinic()
{
	document.getElementById('check_search').value=1;
	document.forms['form-horizontal_4'].submit();
}

function getval()
{
   var base_url=document.getElementById('base_url').value;
   window.location=base_url+"login";
}
function check_req_fields4healthhisory()
{
    var errmsg = ''; 
    if(document.forms[0].group_name.value == 'NULL' ||
       document.forms[0].group_name.value == '')
    {
	errmsg += "Please Enter the Group \n";
    }
    if(document.forms[0].cond_name.value == '')
    {
	errmsg += "Please Enter the Name \n";
    }
    if(document.forms[0].disp_seq.value == '')
    {
	errmsg += "Please Enter the Display Sequence No.\n";
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
function check_req_fields4consent()
{
    var errmsg = '';    
    if(document.forms['form-horizontal3'].cond_name.value == '')
    {
	errmsg += "Please Enter the consent Name\n";
    }
    if(document.forms['form-horizontal3'].consent_text.value == '')
    {
	errmsg += "Please Enter the consent Text \n";
    }
    if(document.forms['form-horizontal3'].disp_seq.value == '')
    {
	errmsg += "Please Enter the Display Sequence No.\n";
    }
    if(errmsg == '')
    {
        document.forms['form-horizontal3'].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}
