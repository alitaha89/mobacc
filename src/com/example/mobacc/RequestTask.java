<<<<<<< HEAD
package com.example.mobacc;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.net.URLEncoder;

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
        	
            response = httpclient.execute(new HttpGet("http://www.linteractif.com/mobacc/add.php?data="+URLEncoder.encode(uri[0], "utf-8")));
           
           
            StatusLine statusLine = response.getStatusLine();
            if(statusLine.getStatusCode() == HttpStatus.SC_OK){
            
                ByteArrayOutputStream out = new ByteArrayOutputStream();
                response.getEntity().writeTo(out);
                responseString = out.toString() ;
                out.close();
               // Log.i ("info", "else0");
                if(uri[1]=="ReadFile"){
                	
                	ClassFile rf = new ClassFile();
               	 	rf.deleteFile("/data/data/com.example.mobacc/report.txt");
                	
                }
               
            } else{
                //Closes the connection.
            	Log.i ("info", "else");
            	if(uri[1]!="ReadFile"){
	              	SaveFile ss = new SaveFile();
	             	ss.execute(uri[0]);
            	}
            	
                response.getEntity().getContent().close();
                return "false";
                
             
                
                
               // throw new IOException(statusLine.getReasonPhrase());
            }
        } catch (ClientProtocolException e) {
            //TODO Handle problems..
        	Log.i ("info", "else1");

        	if(uri[1]!="ReadFile"){
              	SaveFile ss = new SaveFile();
             	ss.execute(uri[0]);
        	}
         	 return "false";
        	
        } catch (IOException e) {
            //TODO Handle problems..
        	 
        	if(uri[1]!="ReadFile"){
              	SaveFile ss = new SaveFile();
             	ss.execute(uri[0]);
        	}
        return "false";
        }
        return responseString;
    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        //Do anything with response..
    }
   
=======
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
            response = httpclient.execute(new HttpGet("http://www.linteractif.com/mobacc/add.php?data="+uri[0]));
            StatusLine statusLine = response.getStatusLine();
            if(statusLine.getStatusCode() == HttpStatus.SC_OK){
                ByteArrayOutputStream out = new ByteArrayOutputStream();
                response.getEntity().writeTo(out);
                responseString = out.toString() ;
                out.close();
                Log.i ("info", "else0");
                if(uri[1]=="ReadFile"){
                	
                	ReadFile rf = new ReadFile();
                	rf.deleteFile();
                	
                }
               
            } else{
                //Closes the connection.
            	Log.i ("info", "else");
            	if(uri[1]!="ReadFile"){
	              	SaveFile ss = new SaveFile();
	             	ss.execute(uri[0]);
            	}
            	
                response.getEntity().getContent().close();
                return "false";
                
             
                
                
               // throw new IOException(statusLine.getReasonPhrase());
            }
        } catch (ClientProtocolException e) {
            //TODO Handle problems..
        	Log.i ("info", "else1");

        	if(uri[1]!="ReadFile"){
              	SaveFile ss = new SaveFile();
             	ss.execute(uri[0]);
        	}
         	 return "false";
        	
        } catch (IOException e) {
            //TODO Handle problems..
        	 
        	if(uri[1]!="ReadFile"){
              	SaveFile ss = new SaveFile();
             	ss.execute(uri[0]);
        	}
        return "false";
        }
        return responseString;
    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        //Do anything with response..
    }
   
>>>>>>> 8bb5c9ea6f3b5c14aa85f57b34b22f27ca1044bf
}