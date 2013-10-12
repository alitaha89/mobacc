package com.example.mobacc;

import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStreamWriter;

public class SFile {

	public void SvFile(String fileLocation,String text){
		
		 try {
         	
             File myFile = new File(fileLocation);
             myFile.createNewFile();
             FileOutputStream fOut = new FileOutputStream(myFile,true);
             OutputStreamWriter myOutWriter = new OutputStreamWriter(fOut);
            
             myOutWriter.append(text);
             myOutWriter.close();
             fOut.close();
            
         } catch (Exception e) {
             
         }
		
	}
}
