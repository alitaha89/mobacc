package com.example.mobacc;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;

public class Welcome extends Activity{
	
	@Override
	protected void onCreate(Bundle AliTaha) {
		// TODO Auto-generated method stub
		super.onCreate(AliTaha);
		setContentView(R.layout.welcome);
		Thread timer  = new Thread(){
			public void run(){
				try{
					
					sleep(500);
					
				} catch (InterruptedException e){
					e.printStackTrace();
				}finally{
					
					
					
					ClassFile rf = new ClassFile();
					String id = rf.RdFile("/data/data/com.example.mobacc/login.txt");
					
				if(id!=null  && !id.equals("") && id!="false"){
					
					Intent openStartingPoint = new Intent("com.example.mobacc.MENU");
					startActivity(openStartingPoint);
					
				}else{
					Intent openStartingPoint = new Intent("com.example.mobacc.LOGIN");
					startActivity(openStartingPoint);
					
				}
					
					
				}
				
				
			}
			
			
		};
		timer.start();
	}

	@Override
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		finish();
	}
	
	

}
