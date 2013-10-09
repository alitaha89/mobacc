package com.example.mobacc;


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
	  ReadFile rFile = new ReadFile();
      rFile.callReadFile();
  } 

 
 
  
  public void sendPost(String spinner) throws UnsupportedEncodingException{
	  
	   
	    new RequestTask().execute(URLEncoder.encode(spinner, "utf-8"),"Add_new");
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
				
				sendPost(Report.toString()) ;

			} catch (Exception  e) {
		        // TODO Auto-generated catch block
		        e.printStackTrace();
		    }
	  }
 
	});
  }
}