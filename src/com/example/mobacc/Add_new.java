package com.example.mobacc;


import java.io.UnsupportedEncodingException;
import java.text.SimpleDateFormat;
import java.util.Date;


import org.json.JSONException;
import org.json.JSONObject;
import android.app.Activity;
import android.app.DialogFragment;
import android.content.Context;

import android.net.ConnectivityManager;
import android.net.NetworkInfo;
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
  private String id;
  @Override
  public void onCreate(Bundle savedInstanceState) {
	super.onCreate(savedInstanceState);
	setContentView(R.layout.add_new);
	
	ClassFile rf=	new ClassFile();
	 id = rf.getUserId();
	
	category = (Spinner) findViewById(R.id.category);
	amount = (EditText) findViewById(R.id.amount);
	merchant = (EditText) findViewById(R.id.merchant);
	date = (EditText) findViewById(R.id.date);
	description = (EditText) findViewById(R.id.description);
	button = (Button) findViewById(R.id.button);
	
	
	setDateValue();
	
	try {
		addListenerOnButton();
	} catch (JSONException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	ReadDataFile rFile = new ReadDataFile();
      rFile.periodiqSendData();
  } 

 
 private void setDateValue(){
	 
	 
	 SimpleDateFormat sdf = new SimpleDateFormat( "yyyy/MM/dd" ); 
		date.setText( sdf.format( new Date() ));
 }
  
  public void sendPost(String spinner) throws UnsupportedEncodingException{
	  
	   
	    new Add_newAction().execute(spinner,"Add_new");
  }

  public void addListenerOnButton() throws JSONException {
 
	Report = new JSONObject();
	
	
	
	
	button.setOnClickListener(new OnClickListener() {
 
	  @Override
	  public void onClick(View v) {
		
		  button.setEnabled(false);
		  
		  try{
				if(amount.getText().toString() != null && !amount.getText().toString() .equals("")){
					
					Report.put("userid", id);
					Report.put("cat", category.getSelectedItem().toString());
					Report.put("amount", amount.getText().toString());
					Report.put("merchant", merchant.getText().toString());
					Report.put("date", date.getText().toString());
					Report.put("description", description.getText().toString());
					
					amount.setText("");
					merchant.setText("");
					setDateValue();
					description.setText("");
					  
					if(isOnline()){
						
						sendPost(Report.toString()) ;
						
					}else{
						
					 Toast.makeText(Add_new.this, "saved localy",Toast.LENGTH_LONG).show();
					 SaveFile ss = new SaveFile();
				     ss.execute(Report.toString());
				     
				 }
				}else{
					Toast.makeText(Add_new.this, "Amount is required",Toast.LENGTH_LONG).show();
					
				}
			} catch (Exception  e) {
		        // TODO Auto-generated catch block
		        e.printStackTrace();
		    }
		  
		  
		  button.setEnabled(true);
		 
	  }
 
	});
  }
  public boolean isOnline() {
      ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
      NetworkInfo netInfo = cm.getActiveNetworkInfo();
      //Context.getFilesDir().getPath();
      if (netInfo != null && netInfo.isConnectedOrConnecting()) 
      {
          return true;
      }
      return false;
  }
 
}