package com.example.mobacc;



import java.io.FileWriter;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;

import org.json.JSONException;
import org.json.JSONObject;
import android.app.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

 
public class Add_new extends Activity {
 
  private Spinner category;
  private EditText amount;
  private EditText merchant;
  private EditText date;
  private EditText description;
  private Button button;
  private JSONObject Report;
 
  @Override
  public void onCreate(Bundle savedInstanceState) {
	super.onCreate(savedInstanceState);
	setContentView(R.layout.add_new);

	try {
		addListenerOnButton();
	} catch (JSONException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}

  } 

  public void mCreateAndSaveFile(String params, String mJsonResponse) {
	    try {
	        FileWriter file = new FileWriter(getFilesDir().getPath()+ getApplicationContext().getPackageName() + "/" + params);
	        file.append(mJsonResponse);
	        file.flush();
	        file.close();
	    } catch (IOException e) {
	        e.printStackTrace();
	    }
	}
  public boolean isNetworkOnline() {
	return true;
	 /*  boolean status=false;
	    try{
	        ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
	        NetworkInfo netInfo = cm.getNetworkInfo(0);
	        if (netInfo != null && netInfo.getState()==NetworkInfo.State.CONNECTED) {
	            status= true;
	        }else {
	            netInfo = cm.getNetworkInfo(1);
	            if(netInfo!=null && netInfo.getState()==NetworkInfo.State.CONNECTED)
	                status= true;
	        }
	    }catch(Exception e){
	        e.printStackTrace();  
	        return false;
	    }
	    return status;
*/
	    }
  
  public void sendPost(String spinner) throws UnsupportedEncodingException{
	  
	 // 	query = URLEncoder.encode("apples oranges", "utf-8");
	   
	    new RequestTask().execute("http://www.linteractif.com/mobacc/add.php?spinner="+URLEncoder.encode(spinner, "utf-8"));
  }
  /*public void mReadJsonData(String params) {
	    try {
	        File f = new File("/data/data/" + getPackageName() + "/" + params);
	        FileInputStream is = new FileInputStream(f);
	        int size = is.available();
	        byte[] buffer = new byte[size];
	        is.read(buffer);
	        is.close();
	        String mResponse = new String(buffer);
	    } catch (IOException e) {
	        // TODO Auto-generated catch block
	        e.printStackTrace();
	    }
	}*/
  public void addListenerOnButton() throws JSONException {
 
	Report = new JSONObject();
	
	category = (Spinner) findViewById(R.id.category);
	amount = (EditText) findViewById(R.id.amount);
	merchant = (EditText) findViewById(R.id.merchant);
	date = (EditText) findViewById(R.id.date);
	description = (EditText) findViewById(R.id.description);
	button = (Button) findViewById(R.id.button);
	
	
	button.setOnClickListener(new OnClickListener() {
 
	  @Override
	  public void onClick(View v) {
 
		  try{
				
				Report.put("spinner", category.getSelectedItem().toString());
				Report.put("amount", amount.getText().toString());
				Report.put("merchant", merchant.getText().toString());
				Report.put("date", date.getText().toString());
				Report.put("description", description.getText().toString());
				
				if(isNetworkOnline()){
					
					sendPost(Report.toString()) ;
					
				}else{
				
					
					
					mCreateAndSaveFile("report.txt",Report.toString());
					Toast.makeText(Add_new.this,"offline",Toast.LENGTH_SHORT).show();
				}
				
			} catch (Exception  e) {
		        // TODO Auto-generated catch block
		        e.printStackTrace();
		    }
		 
		 
	  //  Toast.makeText(Add_new.this,"Result : " + "\nSpinner 2 : "+ String.valueOf(category.getSelectedItem()),Toast.LENGTH_SHORT).show();
	  }
 
	});
  }
}