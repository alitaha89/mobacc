package com.example.mobacc;


import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;


import android.os.AsyncTask;



class StatementAction extends AsyncTask<String, String, String>{
	
    @Override
    protected String doInBackground(String... uri) {
       
        	
        	SendRequest snd = new SendRequest();
        
         
           
            try {
            	
            	return snd.sendRequest("mobacc/api/statement.php?id="+URLEncoder.encode(uri[0], "utf-8"));
				
			} catch (UnsupportedEncodingException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
            return "false";
    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        //Do anything with response..
    }
   
}