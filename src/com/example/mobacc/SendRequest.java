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
        	
            response = httpclient.execute(new HttpGet(url));
         
            StatusLine statusLine = response.getStatusLine();
            if(statusLine.getStatusCode() == HttpStatus.SC_OK){
            
                ByteArrayOutputStream out = new ByteArrayOutputStream();
                response.getEntity().writeTo(out);
                responseString = out.toString() ;
                out.close();
                return responseString;
               
            } else{
                //Closes the connection.
                response.getEntity().getContent().close();
                return "false";
            
            }
        } catch (ClientProtocolException e) {
            //TODO Handle problems..
        	return "false";
        	
        } catch (IOException e) {
            //TODO Handle problems..

        	return "false";
        }
	
	}

}
