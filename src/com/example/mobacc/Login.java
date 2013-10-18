package com.example.mobacc;


import java.util.concurrent.ExecutionException;

import org.json.JSONArray;
import org.json.JSONException;

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


public class Login extends Activity {
 
 EditText txtUserName;
 EditText txtPassword;
 Button btnLogin;
 Button btnRegister;
 
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);
        
        txtUserName=(EditText)this.findViewById(R.id.txtUname);
        txtPassword=(EditText)this.findViewById(R.id.txtPwd);
        btnLogin=(Button)this.findViewById(R.id.btnLogin);

        btnLogin.setOnClickListener(new OnClickListener() {
   
   @Override
   public void onClick(View v) {
    // TODO Auto-generated method stub
	 
			
    if(!txtPassword.getText().toString().equals("") && !txtUserName.getText().toString().equals("")){
    	

    		if(isOnline()){
    			
    			String returns="";
        		String status="";
        		String desc="";
        		String id="";
        		
			try {

				returns = new LoginAction().execute(txtUserName.getText().toString(),txtPassword.getText().toString()).get();
				JSONArray arrayReturns = new JSONArray(returns);
				
				status = (String) arrayReturns.get(0);
				desc = (String) arrayReturns.get(1);
				id = (String) arrayReturns.get(2);
				
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (ExecutionException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			
			if(status!=null && !status.equals("false") && !status.equals("") ){
				
				Toast.makeText(Login.this, desc,Toast.LENGTH_LONG).show();
				 ClassFile sf = new ClassFile();
				 sf.SaveLoginFile(id.replace("\"", ""));
				 Intent openStartingPoint = new Intent("com.example.mobacc.MENU");
				startActivity(openStartingPoint);
			 }else{
				 Toast.makeText(Login.this, desc,Toast.LENGTH_LONG).show();
				 
			 }
    		} else{
          	  Toast.makeText(Login.this, "Connection error",Toast.LENGTH_LONG).show();
            }
		
   
			
	
    	
          
          } else{
        	  Toast.makeText(Login.this, "all fields are required",Toast.LENGTH_LONG).show();
          }
    
   }
  });  
        btnRegister=(Button)this.findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(new OnClickListener() {
     	   
     	   @Override
     	   public void onClick(View v) {
     	    // TODO Auto-generated method stub
     		 
     		   Intent openStartingPoint = new Intent("com.example.mobacc.REGISTER");
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