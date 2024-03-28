import java.util.List;

public class LinkedList {
    public static ListNode first = null;

    public static void main(String[] args) {
        addNodeToFirst("A");
        addNodeToEnd("B");

        ListNode B = findByData("B");
        addNodeNextOfTheNode("D", B);

        ListNode D = findByData("D");
        addNodeBeforeOfTheNode("C", D);

        deleteFromFirst();
        deleteFromEnd();
        deleteTheNode(B);

        display();
    }

    public static void display() {
        if (first == null)
            System.out.println("List is empty.");
        else {
            System.out.println(first.data);
            ListNode temp = first.next;

            while (!temp.equals(first)) {
                System.out.println(temp.data);
                temp = temp.next;
            }
        }
    }

    public static void addNodeToFirst(String data) {
        if (data != null) {
            ListNode newNode = new ListNode();
            newNode.data = data;
            newNode.next = first;
            if (first == null)
                newNode.pre = newNode;
            else
                newNode.pre = first.pre;

            first = newNode;
        }
    }

    public static void addNodeNextOfTheNode(String data, ListNode node) {
        if (node != null && data != null && existsInList(node)) {
            ListNode newNode = new ListNode();
            newNode.data = data;
            newNode.pre = node;
            newNode.next = node.next;

            if (node.next != null) {
                ListNode nextNode = node.next;
                nextNode.pre = newNode;
            }

            node.next = newNode;
        }
    }

    public static void addNodeBeforeOfTheNode(String data, ListNode node) {
        if (node != null && data != null) {
            ListNode newNode = new ListNode();
            newNode.data = data;
            newNode.next = node;
            newNode.pre = node.pre;

            if (node.pre != null) {
                ListNode preNode = node.pre;
                preNode.next = newNode;
            }

            node.pre = newNode;
        }
    }

    public static void addNodeToEnd(String data) {
        if (data != null) {
            if (first == null) {
                addNodeToFirst(data);
            } else {
                ListNode newNode = new ListNode();
                newNode.data = data;
                newNode.next = first;
                newNode.pre = first.pre;

                ListNode last = first.pre;
                last.next = newNode;
                first.pre = newNode;
            }
        }
    }

    public static void deleteFromFirst() {
        if (first == null) {
            System.out.println("List is empty");
        } else {
            ListNode last = first.pre;
            if (last.equals(first)) {
                first = null;
            } else {
                first = first.next;
                first.pre = last;
                last.next = first;
            }
        }
    }

    public static void deleteTheNode(ListNode node) {
        if (existsInList(node)) {
            ListNode preNode = node.pre;
            if (preNode.equals(node)) {
                first = null;
            } else {
                ListNode nextNode = node.next;
                preNode.next = nextNode;
                nextNode.pre = preNode;
                if (node.equals(first)){
                    first = node.next;
                }
            }
        }
    }

    public static void deleteFromEnd() {
        if (first == null) {
            System.out.println("List is empty");
        } else {
            ListNode last = first.pre;
            if (last.equals(first)) {
                first = null;
            } else {
                ListNode beforeLast = last.pre;
                beforeLast.next = first;
                first.pre = beforeLast;
            }
        }
    }

    public static ListNode findByData(String data) {
        if (data != null && first != null) {

            if (first.data.equals(data)) {
                return first;
            }
            ListNode temp = first.next;

            while (!temp.data.equals(data) && !temp.equals(first)) {
                temp = temp.next;
            }
            if (temp == first) {
                System.out.println("A node with data: " + data + " does not exists.");
                return null;
            }
            return temp;
        }
        System.out.println("invalid inputs!");
        return null;
    }

    public static boolean existsInList(ListNode node) {
        if (first != null) {

            if (first.equals(node)) {
                return true;
            }
            ListNode temp = first.next;

            while (!temp.equals(node) && !temp.equals(first)) {
                temp = temp.next;
            }
            if (temp.equals(first)) {
                return false;
            }
            return true;
        }
        return false;
    }
}
