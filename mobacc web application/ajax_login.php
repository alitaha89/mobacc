<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml" lang="ar" xml:lang="ar">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mobacc</title>
</head>

<body  onload="document.loginForm.username.focus();">

<table class="lightbox" id="form-lightbox" style="display:table;opacity:1;background-color:#ffffff;">
    	<tr>
        	<td align="center">
            
  <!--------------------------- lightbox content ------------------------------------------------->
  
  <div class="lightbox-container">
    <div class="lightbox-head" style="display:none" >
    	<div class="lightbox-title"  >Login</div>
        <div class="lightbox-close">&times;</div>
    </div>
      <div class="lightbox-content" >
      <div class="lightbox-loader"></div>
      <form id="login-form" name="loginForm">
      <table class="form" cellpadding="5px" style="display: block;">
                  <tr>
                        <td>&nbsp;</td>
                        <td id="login-erro-placement"><span style="color:#000000;">LOGIN</span></td>
                        
                    </tr>
                    <tr>
                        <td>USER NAME:</td>
                        <td><input type="text" class="input-text required" name="username" id="f-name" style="width:320px"  /></td>
                        
                    </tr>
                 <tr>
                        <td>PASSWORD:</td>
                        <td><input type="password" class="input-text required" name="pass" id="f-password" style="width:320px"  /></td>
                        
                    </tr>
                    <tr>
                        <td><a href="register.php">CREATE NEW ACCOUNT</a></td>
                        <td><input type="submit" class="btn fr" value="LOGIN" /></td>
                       
                    </tr>
                    
			</table>
            </form>
        </div>
        </div>
        
        
        
        
        </td>
        </tr>
    </table>
<script>
$('#login-form').validate({
   submitHandler: function(form) {
    $('.lightbox-loader').show();
	$.post('api/login.php?source=browser',$(form).serializeArray(),function(data)
	{
		data = eval(data);
		
		if(data[0]=="false")
		{
			$('#login-erro-placement').html(data[1]);
		}else
		{
			$('#login-erro-placement').html(data[1])
			var milliseconds = new Date().getTime();
			window.location="index.php"
			
		} 
		
		$('.lightbox-loader').hide();
		
		
	})
	
	
	
   }
});
</script>
</body>
</html>