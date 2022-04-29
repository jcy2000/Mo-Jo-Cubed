package csvSampleExtractor;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.util.ArrayList;

public class ReadFile {
  public static void main(String[] args) throws Exception {
	  //Creating file, readers, & writers===================================================================
	  File cleanFile = null, dirtyFile = null;
	  try {
		  cleanFile = new File("resources//cleaned_steam_reviews.csv");
		  cleanFile.createNewFile();
		  dirtyFile = new File("resources//dirty_steam_reviews.csv");
		  dirtyFile.createNewFile();
	  }
	  catch(Exception e) {
		  System.out.println("Beep boop bop error.");
		  e.printStackTrace();
	  }
	  
	  BufferedReader br = new BufferedReader(new FileReader("resources//steam_reviews.csv"));
	  BufferedWriter bw1 = new BufferedWriter(new FileWriter(cleanFile));
	  BufferedWriter bw2 = new BufferedWriter(new FileWriter(dirtyFile));
	  //=================================================================================================
	  
	  //Gets first row of dataset. Each column indicates what each value means.
	  //==========================================================================
	  ArrayList<String> reviewValues = new ArrayList<String>();
	  String[] reviewLine = br.readLine().split(",");
	  
	  for(int i = 0; i < reviewLine.length; i++)
		  reviewValues.add(reviewLine[i]);
	  
	  reviewValues.set(0, "index");
	  reviewValues.add(9, String.valueOf("vote_id"));
	  reviewValues.remove(10);
	  reviewValues.set(10, "number_of_votes");
	  reviewValues.remove(13);
	  reviewValues.set(13, "game_attainment");
	  
	  for(int i = 0; i < reviewValues.size() - 1; i++) {
		  bw1.write(reviewValues.get(i) + ",");
		  bw2.write(reviewValues.get(i) + ",");
	  }
	  
	  bw1.write(reviewValues.get(reviewValues.size() - 1));
	  bw2.write(reviewValues.get(reviewValues.size() - 1));
	  bw1.newLine(); bw2.newLine();
	  //==========================================================================
		  
	  int voteIdCounter = 0, counter = 0;
	  String line;
	  
	  //Keeps iterating when there's another line
	  while((line = br.readLine()) != null) {
		  reviewValues = new ArrayList<String>();
		  reviewLine = line.split(",");
		  
		  //Puts tuple into var array
		  for(int i = 0; i < reviewLine.length; i++)
			  reviewValues.add(reviewLine[i]);
		  
		  if(reviewValues.size() == 23) {
			  //Write the current tuple into a cleaned dataset if it's valid.
			  //Validity is determined by whether the first value can be parsed into an integer.
			  try {
				  Integer.parseInt(reviewValues.get(0));
				  reviewValues.add(9, String.valueOf(voteIdCounter));
				  
				  //Combines funny votes and helpful votes. Also replaces them with number_of_votes on the cleaned file
				  int numVotes = 0;
				  numVotes += Integer.parseInt(reviewValues.get(10)) + Integer.parseInt(reviewValues.get(11));
				  reviewValues.remove(10);
				  reviewValues.set(10, Integer.toString(numVotes));
				  
				  //Combines steam_purchase and received_for_free into one category: gameAttainment
				  if(reviewValues.get(13).equalsIgnoreCase("true")) {
					  reviewValues.set(13, "Purchased");
					  reviewValues.remove(14);
				  }
				  else if(reviewValues.get(14).equalsIgnoreCase("true")) {
					  reviewValues.remove(13);
					  reviewValues.set(13, "Received For Free");
				  }
				  else {
					  reviewValues.set(13, "Other");
					  reviewValues.remove(14);
				  }
				  
				  
				  //Writes onto clean file
				  for(int i = 0; i < reviewValues.size() - 1; i++)
					  bw1.write(reviewValues.get(i) + ",");
				  
				  //Catches last element of the var array
				  bw1.write(reviewValues.get(reviewValues.size() - 1));
				  bw1.newLine();
				  
				  //Console print to show that program progress
				  System.out.println(reviewValues.get(2) + " " + counter);
				  
				  counter++;
				  voteIdCounter++;
			  }
			  catch(Exception e) {
				  //Write tuple into a dirty dataset if it's invalid
				  for(int i = 0; i < reviewValues.size() - 1; i++)
					  bw2.write(reviewValues.get(i) + ",");
				  
				  bw2.write(reviewValues.get(reviewValues.size() - 1));
				  bw2.newLine();
				  System.out.println("Invalid Input before: " + counter);
			  }
		  }
	  }
	  
	  br.close(); bw1.close(); bw2.close();
  }
}