// // Problem Statement
// // Shivam loves ice cream. Every day after college, he visits the ice cream cart near the gate.
// // Today, he has a few coins in his pocket and a fixed budget.
// // There are different ice creams priced differently, but he wants to buy only one that fits exactly into his budget.

// // Write a function that takes an integer budget and a list of integers iceCreamPrices, and returns true if there exists at least one ice cream whose price is exactly equal to the budget, otherwise return false.

// // Input
// // An integer budget where budget ≥ 0
// // A list of integers iceCreamPrices
// // (1 ≤ length ≤ 1000, 1 ≤ price ≤ 10⁴)
// // Output
// // A boolean value:

// // true if there's a price that matches the budget
// // false otherwise
// // Example

// // Example 1
// // Input:
// // budget = 30
// // iceCreamPrices = \[10, 25, 30, 50]
// // Output:
// // true

// // Explanation:
// // Shivam can buy the ice cream priced at 30, which matches his budget exactly.
import java.util.Scanner;
public class q1{

    public static boolean buy(int budget,int[] iceprices){
        for(int prices: iceprices){
            if(prices==budget){
                return true;
            }

        }
        return false;
    }
    public static void main(String[] args) {
         Scanner sc=new Scanner(System.in);
         System.out.println("Entert the budget: ");
        int budget=sc.nextInt();
        System.out.println("Enter the Icecream Prices:");
        int n = sc.nextInt();
        int[] iceprices = new int[n];
        System.out.println("enter the prices:");
        for (int i = 0; i < n; i++) {
            iceprices[i] = sc.nextInt();
        }

        boolean result=buy(budget,iceprices);
        System.out.println(result);
    }

    }


