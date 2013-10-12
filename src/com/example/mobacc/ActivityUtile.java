package com.example.mobacc;

import android.app.Activity;
import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

public class ActivityUtile extends Activity{
	

	 public boolean isOnline(){
			
			ConnectivityManager cm= (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
			NetworkInfo netInfo = cm.getActiveNetworkInfo();
			
			try{
				if(netInfo!=null && netInfo.isConnectedOrConnecting())
				return true;
				}catch(Exception e){
					
				}
			
			return false;
		}
	
	

}
