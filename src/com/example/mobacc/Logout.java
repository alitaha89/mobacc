package com.example.mobacc;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;

public class Logout extends Activity{

	  @Override
	    public void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	    	setContentView(R.layout.logout);
	    	logout();
	  }
	 public void logout(){
	
		 ClassFile rf = new ClassFile();
	 	rf.deleteLoginFile();
	 	
	 	Intent openStartingPoint = new Intent("com.example.mobacc.LOGIN");
		startActivity(openStartingPoint);
		
	} 

}
