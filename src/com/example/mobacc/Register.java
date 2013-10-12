package com.example.mobacc;


import java.util.concurrent.ExecutionException;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;


public class Register extends Activity {
 
 EditText txtUserName;
 EditText txtPassword;
 Button btnRegister;
 Button btnLogin;
 
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.register);
        
       txtUserName=(EditText)this.findViewById(R.id.txtUname);
        txtPassword=(EditText)this.findViewById(R.id.txtPwd);
        btnRegister=(Button)this.findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(new OnClickListener() {
   
   @Override
   public void onClick(View v) {
    // TODO Auto-generated method stub
	 
			
    if(!txtPassword.getText().toString().equals("") && !txtUserName.getText().toString().equals("")){
    	

    		
			if(isOnline()){
			
    		String id="";
			try {
				id = new RegisterAction().execute(txtUserName.getText().toString(),txtPassword.getText().toString()).get();
				System.out.println("RegisterActionR"+id);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (ExecutionException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			System.out.println("lRegisterActionR2"+id);
			 if(id!=null && !id.equals("false") && !id.equals("")){
				 
				 SFile sf = new SFile();
				 sf.SvFile("/data/data/com.example.mobacc/login.txt", id);
				 Intent openStartingPoint = new Intent("com.example.mobacc.MENU");
				startActivity(openStartingPoint);
			 }else{
				 Toast.makeText(Register.this, "error occured",Toast.LENGTH_LONG).show();
				 
			 }
			 }else{
				 Toast.makeText(Register.this, "Connection error",Toast.LENGTH_LONG).show();
				 
			 }
		//	Toast.makeText(Login.this, (CharSequence) id,Toast.LENGTH_LONG).show();
   
			
	
    	
          // Toast.makeText(Login.this, "Login Successful",Toast.LENGTH_LONG).show();
          } else{
        	  Toast.makeText(Register.this, "all fields are required",Toast.LENGTH_LONG).show();
          }
    
   }
  });  
        
        
        btnLogin=(Button)this.findViewById(R.id.btnLogin);
        btnLogin.setOnClickListener(new OnClickListener() {
        	   
        	   @Override
        	   public void onClick(View v) {
        	    // TODO Auto-generated method stub
        		 
        		   Intent openStartingPoint = new Intent("com.example.mobacc.LOGIN");
					startActivity(openStartingPoint);	
        	  
        	   }
       });   
        
        
    }
    public boolean isOnline() {
        ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo netInfo = cm.getActiveNetworkInfo();

        if (netInfo != null && netInfo.isConnectedOrConnecting()) 
        {
            return true;
        }
        return false;
    }
 

} 