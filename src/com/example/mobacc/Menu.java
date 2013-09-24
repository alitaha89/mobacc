package com.example.mobacc;

import android.app.ListActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;


public class Menu extends ListActivity{

	
	String classess[] = {"Add new","Statment"};
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setListAdapter(new ArrayAdapter<String>(Menu.this, android.R.layout.simple_list_item_1, classess));
	}
	


}