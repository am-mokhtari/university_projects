import java.util.Scanner;

public class ToDoList{
    public static void main(String[] args){
        Scanner input = new Scanner(System.in);
        String[][] list;
        list = new String[0][4];

        System.out.println("    * To Do List *");
        System.out.println("Hello! choose one option to start!");

        boolean run = true;
        list = getOrder(list);

        while(run == true){
            String close = "";
            while(close.compareTo("yes") != 0 && close.compareTo("no") != 0){
                System.out.print("\nDo you want to exit? yes or no ?");
                close = input.nextLine();
                close = close.toLowerCase();
            }
            if(close.compareTo("no") == 0){
                list = getOrder(list);
            }else{
                run = false;
            }
        }
    }

    public static String[][] getOrder(String[][] array) {
        Scanner input = new Scanner(System.in);
        int option = -1;

        while(option < 1 || option > 5){
            System.out.println("Order list: ");
            System.out.println(" 1) New Task \n 2) Show Tasks \n 3) Change Doing Status \n 4) Delete Task \n 5) Close");
            System.out.print("Enter the option number : ");
            option = input.nextInt();
        }

        switch (option) {
            case 1:
                array = newTask(array);
                break;

            case 2:
                array = printTasks(array);
                break;

            case 3:
                array = changeStatus(array);
                break;

            case 4:
                array = delTask(array);
                break;
        }

        return array;
    }

    public static String[][] newTask(String[][] oldArray) {
        int length = oldArray.length;
        String[][] newArray;
        newArray = new String[length+1][4];
        Scanner input = new Scanner(System.in);
        String[] task = new String[4];

        for(int i = 0; i < length; i++){
            for(int j = 0; j < 4; j++){
                newArray[i][j] = oldArray[i][j];
            }
        }

        System.out.print("Enter the title: ");
        String inputTitle = input.nextLine();
        task[0] = inputTitle.toLowerCase();

        String inputDay = "";
        while(inputDay.compareTo("saturday") != 0 && inputDay.compareTo("sunday") != 0 &&
                inputDay.compareTo("monday") != 0 && inputDay.compareTo("tuesday") != 0 &&
                inputDay.compareTo("wednesday") != 0 && inputDay.compareTo("thursday") != 0 && inputDay.compareTo("friday") != 0){
            System.out.print("\nEnter the name of weekday of task: ");
            inputDay = input.nextLine();
            inputDay = inputDay.toLowerCase();
        }
        task[1] = inputDay;

        int inputHour = -1;
        int inputMinute = -1;
        while(inputHour < 0 || inputHour > 23 || inputMinute < 0 || inputMinute > 59){
            System.out.print("\nFor it's time, first set hour! \n* Hour can be between 0 - 23 : ");
            inputHour = input.nextInt();

            System.out.print("\nNow set minute! \n* minute can be between 0 - 59 : ");
            inputMinute = input.nextInt();
        }

        String inputTime = String.valueOf(inputHour)+":"+String.valueOf(inputMinute);
        task[2] = inputTime;

        String inputStatus = "";
        while(inputStatus.compareTo("yes") != 0 && inputStatus.compareTo("no") != 0){
            System.out.println("Are you do it? \n* yes \n* no");
            inputStatus = input.next();
            inputStatus = inputStatus.toLowerCase();
        }

        if(inputStatus.compareTo("yes") == 0){
            inputStatus = "done";
        }else{
            inputStatus = "undone";
        }

        task[3] = inputStatus;

        for(int i = 0; i < 4; i++){
            newArray[length][i] = task[i];
        }
        System.out.println("\nTask added for: \n title: "+newArray[length][0]+"\n day: "+newArray[length][1]+"\n time: "+newArray[length][2]+"\n status: "+newArray[length][3]);
        return newArray;
    }

    public static String[][] delTask(String[][] oldArray) {
        int length = oldArray.length;

        if(length <= 0){
            System.out.println("\nArray is empty !!!");
            return oldArray;
        }else{
            String[][] newArray;
            newArray = new String[length-1][4];
            Scanner input = new Scanner(System.in);
            int[] idNumbers;
            int countId = 0;
            boolean resultExist = false;

            System.out.print("\nEnter the title to delete it: ");
            String delTitle = input.nextLine();
            delTitle = delTitle.toLowerCase();

            for(int i = 0; i < length; i++){
                if(oldArray[i][0].compareTo(delTitle) == 0){
                    resultExist = true;
                    countId++;
                }
            }

            if(resultExist == true){
                idNumbers = new int[countId];
                System.out.println("\nsearch results: ");

                for(int i = 0, j = 0; i < length; i++){
                    if(oldArray[i][0].compareTo(delTitle) == 0){
                        System.out.println("\nid: "+(i+1)+"\ntitle: "+oldArray[i][0]+"\nday: "+oldArray[i][1]+"\ntime: "+oldArray[i][2]+"\nstatus: "+oldArray[i][3]);
                        idNumbers[j] = i+1;
                        j++;
                    }
                }

                System.out.print("\nEnter the task's id for delete: ");
                int delId = input.nextInt();

                boolean validId = false;
                for(int x = 0; x < countId; x++){
                    if(delId == idNumbers[x]){
                        validId = true;
                    }
                }

                if(validId == true){
                    for(int i = 0; i < 4; i++){
                        oldArray[delId-1][i] = null;
                    }

                    for(int i = 0; i < length; i++){
                        if(oldArray[i][0] != null){
                            for(int j = 0; j < 4; j++){
                                newArray[i][j] = oldArray[i][j];
                            }
                        }
                    }

                    System.out.println("\nDeleted successfully !");
                    return newArray;

                }else{
                    System.out.println("\nThe id is not valid !!");
                    return oldArray;
                }

            }else{
                System.out.println("\nNo results found for delete !");
                return oldArray;
            }
        }
    }


    public static String[][] printTasks(String[][] array){
        Scanner input = new Scanner(System.in);
        int length = array.length;

        if(length <= 0){
            System.out.println("Array is empty !!!");
            return array;
        }else{
            String printType = "";

            while(printType.compareTo("all") != 0 && printType.compareTo("day") != 0){
                System.out.println("\nShow special day tasks or all tasks?\n   * day\n   * all");
                printType = input.nextLine();
                printType = printType.toLowerCase();
            }

            if(printType.compareTo("all") == 0){
                System.out.print("\ntitle -> day -> time -> status\n");

                boolean resultExist = false;
                for(int i = 0; i < length; i++){
                    System.out.println(array[i][0]+" -> "+array[i][1]+" -> "+array[i][2]+" -> "+array[i][3]);
                    resultExist = true;
                }

            }else if(printType.compareTo("day") == 0){
                String dayPrint = "";

                while(dayPrint.compareTo("saturday") != 0 && dayPrint.compareTo("sunday") != 0 &&
                        dayPrint.compareTo("monday") != 0 && dayPrint.compareTo("tuesday") != 0 &&
                        dayPrint.compareTo("wednesday") != 0 && dayPrint.compareTo("thursday") != 0 && dayPrint.compareTo("friday") != 0){

                    System.out.print("\nEnter the name of weekday to show it's tasks: ");
                    dayPrint = input.nextLine();
                    dayPrint = dayPrint.toLowerCase();
                }

                System.out.print("\ntitle -> day -> time -> status\n");

                boolean resultExist = false;
                for(int i = 0; i < length; i++){
                    if(array[i][1].compareTo(dayPrint) == 0){
                        System.out.println(array[i][0]+" -> "+array[i][1]+" -> "+array[i][2]+" -> "+array[i][3]);
                        resultExist = true;
                    }
                }

                if(resultExist == false){
                    System.out.println("\nNo results found to show.");
                }
            }else{
                System.out.print("\nThere is problem in the print tasks !!!");
            }
            return array;
        }
    }
    public static String[][] changeStatus(String[][] array){
        int length = array.length;

        if(length <= 0){
            System.out.println("Array is empty !!!");
        }else{
            Scanner input = new Scanner(System.in);
            int[] idNumbers;
            int countId = 0;
            boolean resultExist = false;

            System.out.print("\nEnter the title to change it's status: ");
            String titleForChange = input.nextLine();
            titleForChange = titleForChange.toLowerCase();

            for(int i = 0; i < length; i++){
                if(array[i][0].compareTo(titleForChange) == 0){
                    resultExist = true;
                    countId++;
                }
            }

            if(resultExist == true){
                idNumbers = new int[countId];
                System.out.println("\nsearch results: ");

                for(int i = 0, j = 0; i < length; i++){
                    if(array[i][0].compareTo(titleForChange) == 0){
                        System.out.println("id: "+(i+1)+"\ntitle: "+array[i][0]+"\nday: "+array[i][1]+"\ntime: "+array[i][2]+"\nstatus: "+array[i][3]);
                        idNumbers[j] = i+1;
                        j++;
                    }
                }

                System.out.print("\nEnter the task's id for change status: ");
                int changeId = input.nextInt();

                boolean validId = false;
                for(int x = 0; x < countId; x++){
                    if(changeId == idNumbers[x]){
                        validId = true;
                    }
                }

                if(validId == true){
                    if(array[changeId-1][3] == "undone"){
                        array[changeId-1][3] = "done";
                    }else{
                        array[changeId-1][3] = "undone";
                    }
                    System.out.println("\nDoing status of " + titleForChange + " is changed to " + array[changeId-1][3]);
                }else{
                    System.out.println("\nThe id is not valid !!");
                }
            }else{
                System.out.println("\nNo results found !");
            }
        }
        return array;
    }
}