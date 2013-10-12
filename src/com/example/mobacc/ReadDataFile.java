package com.example.mobacc;

import java.util.Timer;
import java.util.TimerTask;


import android.os.AsyncTask;

import android.os.Handler;

 
public class ReadDataFile extends AsyncTask<String, Void, Void> {
 
	 String jSonval="";
	 String FileLocation =  "/data/data/com.example.mobacc/report.txt";
	 
	 protected Void doInBackground(String... params) {
 
		 ClassFile rfile = new ClassFile();
		jSonval = rfile.RdFile(FileLocation);
		//System.out.println("jSonval : "+ jSonval);
		 
		new Add_newAction().execute(jSonval.toString(),"ReadFile");
		
		
		return null;
	}
	 
	 
	 


	 public void periodiqSendData() {
		    final Handler handler = new Handler();
		    Timer timer = new Timer();
		    TimerTask doAsynchronousTask = new TimerTask() {       
		        @Override
		        public void run() {
		            handler.post(new Runnable() {
		                public void run() {       
		                    try {
		                    	ReadDataFile ReadDtFile = new ReadDataFile();
		                        // PerformBackgroundTask this class is the class that extends AsynchTask 
		                    	ReadDtFile.execute();
		                    } catch (Exception e) {
		                        // TODO Auto-generated catch block
		                    }
		                }
		            });
		        }
		    };
		    timer.schedule(doAsynchronousTask, 0, 7000); //execute in every 50000 ms
		}

	 

	 
} 