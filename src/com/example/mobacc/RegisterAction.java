package com.example.mobacc;


import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;


import android.os.AsyncTask;



class RegisterAction extends AsyncTask<String, String, String>{
	
    @Override
    protected String doInBackground(String... uri) {
       
        	
        	SendRequest snd = new SendRequest();
        
         
           
            try {
            	return snd.sendRequest("mobacc/api/register.php?name="+URLEncoder.encode(uri[0], "utf-8")+"&username="+URLEncoder.encode(uri[1], "utf-8")+"&pass="+URLEncoder.encode(uri[2], "utf-8"));
				
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