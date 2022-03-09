package csvSampleExtractor;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class ReadFile {
  public static void main(String[] args) throws FileNotFoundException {
	  Scanner fileReader = new Scanner(new FileInputStream("resources//steam_reviews.csv"));
	  
	  int numOfOccurences = 50;
	  while(fileReader.hasNextLine()) {
		  String[] var = fileReader.nextLine().split(",");
		  if(var.length == 0)
			  continue;
		  
		  if(numOfOccurences < 50)
			  System.out.println(var[0]);
		  else
			  numOfOccurences = 0;
		  
		  numOfOccurences--;
	  }
  }
}