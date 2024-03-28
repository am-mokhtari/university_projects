import java.util.*;
class S2{
    public static void main(String args[])
    {
        Scanner input = new Scanner(System.in);
        
        System.out.println("enter n: ");
        int n = input.nextInt();
        
        System.out.println("enter m: ");
        int m = input.nextInt();
        
        if (m < n){
            System.out.println("m is smaller than n.");
            System.exit(0);
        }
        
        int factN = fact(n);
        
        int sum = 0;
        for(int k = 0; k <= n; k++)
        {
            int firstSentence = power(-1, k);
            
            int secondSentence = factN / (fact(n-k) * fact(n - (n-k)));
            
            int thirdSentence = power(n-k, m);
            
            sum += (firstSentence * secondSentence * thirdSentence);
        }
        int result = sum / factN;
        
        System.out.println("result is: " + result);
    }
        
        public static int fact(int n)
        {
            int factN = 1;
            for (int i = 1; i <= n; i++)
            {
                factN *= i;
            }
            
            return factN;
        }
        
        public static int power(int num, int power)
        {
            int poweredNum = 1;
            for(int i = 0; i < power; i++)
            {
                poweredNum *= num;
            }
            
            return poweredNum;
        }
}