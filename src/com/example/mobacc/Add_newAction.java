package com.example.mobacc;


import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;


import android.os.AsyncTask;



class Add_newAction extends AsyncTask<String, String, String>{
	
    @Override
    protected  String doInBackground(String... uri) {
       
        	
        	SendRequest snd = new SendRequest();
           
            try {
            	

            	ClassFile rf=	new ClassFile();
            	
            	if(uri[0] != null && !uri[0].equals("") ){
            		String responce = snd.sendRequest("api/expence.php?data="+URLEncoder.encode(uri[0], "utf-8"));
					if(!responce.equals("false")){
					
					   return responce;
					   
					} else{
					    
						
						if(uri[1]!="ReadFile"){
							
					      	SaveFile ss = new SaveFile();
					     	ss.execute(uri[0]);
					     	
						}else{
							
							
							rf.deleteDataFile();
						}
	      
					}
            	}
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