package com.example.mobacc;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;

import android.app.Activity;

public class ClassFile{

	public String RdFile(String fileLocation){
		 String returnVal="";
		 int content;
		File file = new File(fileLocation);
		 
		 try{
			FileInputStream fis = new FileInputStream(file);
 
			
			 while ((content = fis.read()) != -1) {
				
				 // convert to char 
				 returnVal += (char) content;
				 
			 } 
			 fis.close();
		} catch (IOException e) {
			
			e.printStackTrace();
		}
		
		return returnVal;
	}
	
	 public void deleteFile(String FileLocation){
		    
		 File file = new File(FileLocation);
		 file.delete();
	    }

}
