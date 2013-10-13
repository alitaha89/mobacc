package com.example.mobacc;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;

public class ClassFile{

	public String RdFisle(String fileLocation){
		 String returnVal="";
		 int content;
		File file = new File(fileLocation);
		if(file.exists()){
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
		}
		
		return returnVal;
	}
	
	public String ReadDataFile(){
		
		
		return RdFisle("/data/data/com.example.mobacc/report.txt");
		
	} 
	
	 public void deleteDataFile(){
		 
		
		 File file = new File("/data/data/com.example.mobacc/report.txt");
		 file.delete();
	    }
	 public void deleteLoginFile(){
		    
		 File file = new File("/data/data/com.example.mobacc/login.txt");
		 file.delete();
	    }
	 
	 public String getUserId(){
		 return RdFisle("/data/data/com.example.mobacc/login.txt");   
		 
	 }

		public void SaveReportFile(String text){
			
			 try {
				
				
	             File myFile = new File("/data/data/com.example.mobacc/report.txt");
	             myFile.createNewFile();
	             FileOutputStream fOut = new FileOutputStream(myFile,true);
	             OutputStreamWriter myOutWriter = new OutputStreamWriter(fOut);
	            
	             myOutWriter.append(text);
	             myOutWriter.close();
	             fOut.close();
	            
	         } catch (Exception e) {
	             
	         }
			
		}
		
		public void SaveLoginFile(String text){
			
			 try {
	        	
	            File myFile = new File("/data/data/com.example.mobacc/login.txt");
	            myFile.createNewFile();
	            FileOutputStream fOut = new FileOutputStream(myFile);
	            OutputStreamWriter myOutWriter = new OutputStreamWriter(fOut);
	           
	            myOutWriter.write(text);
	            myOutWriter.close();
	            fOut.close();
	           
	        } catch (Exception e) {
	            
	        }
			
		}
}
