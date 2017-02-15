function number_validation(obj,i)
{	
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('home_phone'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('home_phone'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('home_phone'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('home_phone'+i).value='';
		   document.getElementById('home_phone'+x).focus();
		   return false;
		}
		if(document.getElementById('home_phone'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('home_phone'+i).value='';
		   document.getElementById('home_phone'+x).focus();
		   return false;
		}
	}	

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('home_phone'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('home_phone'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('home_phone'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('home_phone'+i).value=str;
			 document.getElementById('home_phone'+j).focus();
		}		
		document.getElementById('cell_phone4peronal1').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('home_phone'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('home_phone'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('home_phone'+i).focus();
		}		
		document.getElementById('cell_phone4peronal1').focus();
	}

}
function number_validation4physician(obj,i)
{
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('physician_phone'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('physician_phone'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('physician_phone'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('physician_phone'+i).value='';
		   document.getElementById('physician_phone'+x).focus();
		   return false;
		}
		if(document.getElementById('physician_phone'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('physician_phone'+i).value='';
		   document.getElementById('physician_phone'+x).focus();
		   return false;
		}
	}	

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('physician_phone'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('physician_phone'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('physician_phone'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('physician_phone'+i).value=str;
			 document.getElementById('physician_phone'+j).focus();
		}		
		document.getElementById('illness_operation_hospitalized"').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('physician_phone'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('physician_phone'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('physician_phone'+i).focus();
		}		
		document.getElementById('illness_operation_hospitalized"').focus();
	}
}
function number_validation4cellphone(obj,i)
{	
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('cell_phone4peronal'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('cell_phone4peronal'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('cell_phone4peronal'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('cell_phone4peronal'+i).value='';
		   document.getElementById('cell_phone4peronal'+x).focus();
		   return false;
		}
		if(document.getElementById('cell_phone4peronal'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('cell_phone4peronal'+i).value='';
		   document.getElementById('cell_phone4peronal'+x).focus();
		   return false;
		}
	}	

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('cell_phone4peronal'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('cell_phone4peronal'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('cell_phone4peronal'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('cell_phone4peronal'+i).value=str;
			 document.getElementById('cell_phone4peronal'+j).focus();
		}		
		//document.getElementById('work_phone4peronal1').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('cell_phone4peronal'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('cell_phone4peronal'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('cell_phone4peronal'+i).focus();
		}		
		document.getElementById('work_phone4peronal1').focus();
	}
}
function number_validation4workphone(obj,i)
{	
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('work_phone4peronal'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('work_phone4peronal'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('work_phone4peronal'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('work_phone4peronal'+i).value='';
		   document.getElementById('work_phone4peronal'+x).focus();
		   return false;
		}
		if(document.getElementById('work_phone4peronal'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('work_phone4peronal'+i).value='';
		   document.getElementById('work_phone4peronal'+x).focus();
		   return false;
		}
	}	

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('work_phone4peronal'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('work_phone4peronal'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('work_phone4peronal'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('work_phone4peronal'+i).value=str;
			 document.getElementById('work_phone4peronal'+j).focus();
		}		
		document.getElementById('preferred_contact_mode').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('work_phone4peronal'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('work_phone4peronal'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('work_phone4peronal'+i).focus();
		}		
		document.getElementById('preferred_contact_mode').focus();
	}

}
function number_validation4emer_homephone(obj,i)
{
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('emer_homenum'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('emer_homenum'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	        if(document.getElementById('emer_homenum'+x).value == '' && x== 1)
		{
                   alert('Please Enter Area Code');
		   document.getElementById('emer_homenum'+i).value='';
		   document.getElementById('emer_homenum'+x).focus();
		   return false;
		}
		if(document.getElementById('emer_homenum'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('emer_homenum'+i).value='';
		   document.getElementById('emer_homenum'+x).focus();
		   return false;
		}
	}	
	if(len == 3)
	{	
		if(i<3)
		{					
                    document.getElementById('emer_homenum'+j).focus();
		}
	}
	else if(len == 4)
	{	
		if(i == 3)
		{			
             document.getElementById('emer_homenum'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('emer_homenum'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('emer_homenum'+i).value=str;
			 document.getElementById('emer_homenum'+j).focus();
		}		
		document.getElementById('emer_cellnum1').focus();
	}
	else if(len == 5)
	{
                var str=document.getElementById('emer_homenum'+i).value;		
                str = str.substring(0, str.length - 1);		
		document.getElementById('emer_homenum'+i).value=str;
		if(i == 3)
		{			
                   document.getElementById('emer_homenum'+i).focus();
		}		
		document.getElementById('emer_cellnum1').focus();
	}
}
function number_validation4emer_cellphone(obj,i)
{
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('emer_cellnum'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('emer_cellnum'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('emer_cellnum'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('emer_cellnum'+i).value='';
		   document.getElementById('emer_cellnum'+x).focus();
		   return false;
		}
		if(document.getElementById('emer_cellnum'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('emer_cellnum'+i).value='';
		   document.getElementById('emer_cellnum'+x).focus();
		   return false;
		}
	}	

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('emer_cellnum'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('emer_cellnum'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('emer_cellnum'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('emer_cellnum'+i).value=str;
			 document.getElementById('emer_cellnum'+j).focus();
		}		
		document.getElementById('emer_worknum1').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('emer_cellnum'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('emer_cellnum'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('emer_cellnum'+i).focus();
		}		
		document.getElementById('emer_worknum1').focus();
	}
}
function number_validation4emer_workphone(obj,i)
{
	var val=obj.value;
	var len=val.length;
        len=len+1;	
	var j=i+1;
	if(isNaN(document.getElementById('emer_worknum'+i).value) == true)
	{
		   alert('Please Enter number only');
		   document.getElementById('emer_worknum'+i).value='';
		   return false;
	}
	if(i >1)
	{
		var x=parseInt(i)-1;		
	    if(document.getElementById('emer_worknum'+x).value == '' && x== 1)
		{
               alert('Please Enter Area Code');
		   document.getElementById('emer_worknum'+i).value='';
		   document.getElementById('emer_worknum'+x).focus();
		   return false;
		}
		if(document.getElementById('emer_worknum'+x).value == '' && x == 2)
		{
                  alert('Please Enter prefix Code');
		   document.getElementById('emer_cellnum'+i).value='';
		   document.getElementById('emer_cellnum'+x).focus();
		   return false;
		}
	}	

	if(len == 3)
	{	
		if(i<3)
		{
					
             document.getElementById('emer_worknum'+j).focus();
		}
	}
	else if(len == 4)
	{
	
		if(i == 3)
		{			
             document.getElementById('emer_worknum'+i).focus();
		}
		else if(i < 3)
		{
			 var str=document.getElementById('emer_worknum'+i).value;		
			 str = str.substring(0, str.length - 1);		
			 document.getElementById('emer_worknum'+i).value=str;
			 document.getElementById('emer_worknum'+j).focus();
		}		
		document.getElementById('emer_email').focus();
	}
	else if(len == 5)
	{
        var str=document.getElementById('emer_worknum'+i).value;		
        str = str.substring(0, str.length - 1);		
		document.getElementById('emer_worknum'+i).value=str;
		if(i == 3)
		{			
             document.getElementById('emer_worknum'+i).focus();
		}		
		document.getElementById('emer_email').focus();
	}
}
