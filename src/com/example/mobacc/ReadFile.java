package com.example.mobacc;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;

import java.util.Timer;
import java.util.TimerTask;

import android.os.AsyncTask;

import android.os.Handler;
import android.util.Log;
 
public class ReadFile extends AsyncTask<String, Void, Void> {
 
	// String jSonval="";
	 protected Void doInBackground(String... params) {
 
		File file = new File("/data/data/com.example.mobacc/r.txt");
 
		try{
			FileInputStream fis = new FileInputStream(file);
			System.out.println("Total file size to read (in bytes) : "+ fis.available());
 
			int content;
			/*while ((content = fis.()) != -1) {
				// convert to char and display it
				System.out.print((char) content);
				jSonval += (char) content;
			}*/
			
			  Log.i ("info", "readfile");
			  Log.i ("info", fis.toString());
		 new RequestTask().execute(fis.toString());
		
			fis.close();
			file.delete();
		//	SaveFile ss = new SaveFile();
        //	ss.execute(uri[0]);
 
		} catch (IOException e) {
			e.printStackTrace();
		}
		return null;
	}
	 
	 
	 


	 public void callReadFile() {
		    final Handler handler = new Handler();
		    Timer timer = new Timer();
		    TimerTask doAsynchronousTask = new TimerTask() {       
		        @Override
		        public void run() {
		            handler.post(new Runnable() {
		                public void run() {       
		                    try {
		                    	ReadFile ReadFile = new ReadFile();
		                        // PerformBackgroundTask this class is the class that extends AsynchTask 
		                    	ReadFile.execute();
		                    } catch (Exception e) {
		                        // TODO Auto-generated catch block
		                    }
		                }
		            });
		        }
		    };
		    timer.schedule(doAsynchronousTask, 0, 50000); //execute in every 50000 ms
		}

	 
	 
	 
	 
} 