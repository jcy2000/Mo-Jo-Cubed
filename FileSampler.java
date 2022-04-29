package csvSampleExtractor;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

public class FileSampler {

	public static void main(String[] args) throws IOException {
		//Creating file, readers, & writers===================================================================
		File file = null;
		  try {
			  file = new File("resources//cleaned_steam_reviews_sample.csv");
			  file.createNewFile();
		  }
		  catch(Exception e) {
			  System.out.println("Beep boop bop error.");
			  e.printStackTrace();
		  }
		  
		  BufferedReader br = new BufferedReader(new FileReader("resources//cleaned_steam_reviews.csv"));
		  BufferedWriter bw = new BufferedWriter(new FileWriter(file));
		  //=================================================================================================
		  final int interval = 13;
		  int counter = 0;
		  String line;
		  
		  //Keeps iterating when there's another line
		  while((line = br.readLine()) != null) {
			  //Every 13 tuples, write onto sample file
			  if(counter % interval == 0) {
				  bw.write(line);
				  bw.newLine();
				  System.out.println(counter);
			  }
			  
			  counter++;
		  }
		  
		  
		  
		  br.close();
		  bw.close();
	}

}
