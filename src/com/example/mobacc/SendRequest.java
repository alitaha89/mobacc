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

public class SendRequest {
	
	  HttpClient httpclient = new DefaultHttpClient();
      HttpResponse response;
      String responseString = null;
	public String sendRequest(String url){
		
        try {
        	
            response = httpclient.execute(new HttpGet("http://169.254.200.142/"+url));
           // System.out.println("http://169.254.107.81/"+url);

            StatusLine statusLine = response.getStatusLine();
            if(statusLine.getStatusCode() == HttpStatus.SC_OK){
            	
                ByteArrayOutputStream out = new ByteArrayOutputStream();
                response.getEntity().writeTo(out);
                responseString = out.toString() ;
                out.close();
                return responseString;
               
            } else{
                //Closes the connection.
            	System.out.println("request  send error");
                response.getEntity().getContent().close();
                return "false";
            
            }
        } catch (ClientProtocolException e) {
        	System.out.println("ClientProtocolException");
            //TODO Handle problems..
        	return "false";
        	
        } catch (IOException e) {
        	System.out.println("IOException");
            //TODO Handle problems..

        	return "false";
        }
        
	
	}

}
