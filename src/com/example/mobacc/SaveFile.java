package com.example.mobacc;

import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStreamWriter;
import android.os.AsyncTask;
import android.view.View;


public class SaveFile extends AsyncTask<String, Void, Void> {
	
      @Override
      protected Void doInBackground(String... params) {
        // write in data folder
            try {
            	
                File myFile = new File("/data/data/com.example.mobacc/report.txt");
                myFile.createNewFile();
                FileOutputStream fOut = new FileOutputStream(myFile,true);
                OutputStreamWriter myOutWriter = new OutputStreamWriter(fOut);
               
                myOutWriter.append(params[0]);
                myOutWriter.close();
                fOut.close();
               
            } catch (Exception e) {
                
            }

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