import java.util.Scanner;
public class q2{
  public static void main (String[] args){
    Scanner sc =new Scanner(System.in);
    System.out.print("No of days in the Marathon");
    int n=sc.nextInt();
    int[] scores=new int[n];
    System.out.print("Scores earned on each day:");
    for(int i=0;i<n;i++){
      scores[i]=sc.nextInt();
    }int count =0;
      for(int i=1;i<n-1;i++){
        if(scores[i]>scores[i-1] && scores[i]>scores[i+1]){
          count++;
        }
      }
    System.out.print("Magical day is/are: " +count);
    sc.close();
  }
}