package com.example.mobacc;

import java.io.ByteArrayOutputStream;
import java.io.IOException;

import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.apache.http.StatusLine;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.os.AsyncTask;
import android.util.Log;


class RequestTask extends AsyncTask<String, String, String>{

	
	
	
	

	
    @Override
    protected String doInBackground(String... uri) {
        HttpClient httpclient = new DefaultHttpClient();
        HttpResponse response;
        String responseString = null;
       
        try {
            response = httpclient.execute(new HttpGet("http://www.linteractif.com/mobacc/add.php?spinner="+uri[0]));
            StatusLine statusLine = response.getStatusLine();
            if(statusLine.getStatusCode() == HttpStatus.SC_OK){
                ByteArrayOutputStream out = new ByteArrayOutputStream();
                response.getEntity().writeTo(out);
                responseString = out.toString() ;
                out.close();
                Log.i ("info", "else0");

               // responseString = out.toString();
            } else{
                //Closes the connection.
            	Log.i ("info", "else");

              	SaveFile ss = new SaveFile();
             	ss.execute(uri[0]);
            	
                response.getEntity().getContent().close();
                
                
             
                
                
               // throw new IOException(statusLine.getReasonPhrase());
            }
        } catch (ClientProtocolException e) {
            //TODO Handle problems..
        	Log.i ("info", "else1");

        	SaveFile ss = new SaveFile();
         	ss.execute(uri[0]);
        	
        	
        } catch (IOException e) {
            //TODO Handle problems..
        	 
         	SaveFile ss = new SaveFile();
       	ss.execute(uri[0]);
        }
        return responseString;
    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        //Do anything with response..
    }
}