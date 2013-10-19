package com.example.mobacc;

import java.util.concurrent.ExecutionException;

import org.json.JSONArray;
import org.json.JSONException;
import android.app.Activity;
import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.Toast;



 
public class Statement extends Activity {
 
	private String id;
	EditText TextView01val,TextView02val,TextView03val;


  @Override
  public void onCreate(Bundle savedInstanceState) {
	super.onCreate(savedInstanceState);
	setContentView(R.layout.statement);
	
	ClassFile rf=	new ClassFile();
	 id = rf.getUserId();
	 
	 TextView01val=(EditText)this.findViewById(R.id.TextView01val);
	 TextView02val=(EditText)this.findViewById(R.id.TextView02val);
	 TextView03val=(EditText)this.findViewById(R.id.TextView03val);
	 
	 
	 if(isOnline()){
		 String returns;
		 String status = "";
		 String desc="";
		 String today="";
		 String month="";
		 String all="";
		try {
			returns = new StatementAction().execute(id).get();
			JSONArray arrayReturns = new JSONArray(returns);
			status = (String) arrayReturns.get(0);
			desc = (String) arrayReturns.get(1);
			today=(String) arrayReturns.get(2);
			month=(String) arrayReturns.get(3);
			all=(String) arrayReturns.get(4);
			
			
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (ExecutionException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
			
		if(status!=null && !status.equals("false") && !status.equals("") ){
			
			TextView01val.setText(today+" L.L");
			TextView02val.setText(month+" L.L");
			TextView03val.setText(all+" L.L");
			Toast.makeText(Statement.this, desc,Toast.LENGTH_LONG).show();
			  
			
		 }else{
			 Toast.makeText(Statement.this, desc,Toast.LENGTH_LONG).show();
			 
		 }
		
	 }else{
        	  Toast.makeText(Statement.this, "Connection is Needed",Toast.LENGTH_LONG).show();
     }
	
	
  } 

  public boolean isOnline() {
      ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
      NetworkInfo netInfo = cm.getActiveNetworkInfo();

      if (netInfo != null && netInfo.isConnectedOrConnecting()) 
      {
          return true;
      }
      return false;
  }


 

 
}