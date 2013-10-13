<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<title>MOBACC</title>
<script src="Scripts/jquery-1.7.min.js"  type="text/javascript" language="javascript"></script>
<script src="Scripts/jquery.validate.min.js" type="text/javascript" language="javascript"></script>


</head><body><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml" lang="ar" xml:lang="ar">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mobacc</title>
</head>

<body>

<table class="lightbox" id="form-lightbox" style="display:table;opacity:1;background-color:#ffffff;">
    	<tr>
        	<td align="center">
            
  <!--------------------------- lightbox content ------------------------------------------------->
  
  <div class="lightbox-container">
    <div class="lightbox-head" style="display:none" >
    	<div class="lightbox-title"  >Register</div>
        <div class="lightbox-close">&times;</div>
    </div>
      <div class="lightbox-content" >
      <div class="lightbox-loader"></div>
      <form id="register-form" name="registerForm">
      <table class="form" cellpadding="5px" style="display: block;">
                  <tr>
                        <td>&nbsp;</td>
                        <td id="login-erro-placement"><span style="color:#000000;">REGISTER</span></td>
                        
                    </tr>
                    <tr>
                        <td>NAME:</td>
                        <td><input type="text" class="input-text required" name="name" id="f-name" style="width:320px"  /></td>
                        
                    </tr>
                    <tr>
                        <td>USER NAME:</td>
                        <td><input type="text" class="input-text required" name="username" id="f-username" style="width:320px"  /></td>
                        
                    </tr>
                 <tr>
                        <td>PASSWORD:</td>
                        <td><input type="password" class="input-text required" name="pass" id="pass" style="width:320px"  /></td>
                        
                    </tr>
                    <tr>
                        <td>CONFIRM PASSWORD:</td>
                        <td><input type="password" class="input-text required" name="cpass" id="cpass" style="width:320px"  /></td>
                        
                    </tr>
                    <tr>
                        <td><a href="index.php#!login.php">LOGIN</a></td>
                        <td><input type="submit" class="btn fr" value="SAVE" /></td>
                       
                    </tr>
                    
			</table>
            </form>
        </div>
        </div>
        
        
        
        
        </td>
        </tr>
    </table>
<script>
$('#register-form').validate({
	rules: {
    cpass: {
      equalTo: "#pass"
    }
  },
   submitHandler: function(form) {
	  
    $('.lightbox-loader').show();
	$.post('api/register.php?source=browser',$(form).serializeArray(),function(data)
	{	data = eval(data);
		if(data[0]=="false")
		{
			$('#login-erro-placement').html(data[1])
			
		}else
		{
			window.location="index.php";
			
		} 
		
		$('.lightbox-loader').hide();
		
		
	})
	
	return false;
	
   }
});
</script>
</body>
</html></body></html>