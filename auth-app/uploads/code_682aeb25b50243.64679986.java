
import java.util.Scanner;
public class q2 {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("Enter the number of shots:");
        int n = sc.nextInt();
        int[] scores = new int[n];
        System.out.println("Enter the Scores:");
        for (int i = 0; i < n; i++) {
            scores[i] = sc.nextInt();
        }
        int goodshots = 0;
        int missedshots = 0;
        for (int shot : scores) {
            if (shot >= 7) {
                goodshots++;
            } else {
                missedshots++;
            }
        }
        System.out.print(goodshots + " " + missedshots);
        sc.close();
    }
}
