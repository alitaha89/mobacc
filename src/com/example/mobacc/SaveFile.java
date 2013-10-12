package com.example.mobacc;

import android.os.AsyncTask;
import android.view.View;


public class SaveFile extends AsyncTask<String, Void, Void> {
	
      @Override
      protected Void doInBackground(String... params) {
       
    	  
		SFile sfile = new SFile();
		  
		sfile.SvFile("/data/data/com.example.mobacc/report.txt",params[0]);
		
		finish();
		return null;
    }

  


    private void finish() {
        // TODO Auto-generated method stub

    };

    public void onClick(View v) {
        // clear text box
        finish();
    }
}