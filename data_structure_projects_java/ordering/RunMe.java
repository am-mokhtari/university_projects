public class RunMe {
    public static void main(String[] args) {
//        ساخت ریشه
//        l = level in tree, n = number of node
        TreeNode root = new TreeNode();
        root.data = "A";

//        سطح دوم
        TreeNode l2n1 = new TreeNode();
        l2n1.data = "B";
        TreeNode l2n2 = new TreeNode();
        l2n2.data = "C";

        root.left_child = l2n1;
        root.right_child = l2n2;


//        ساخت 3 گره برای سطح سوم
        TreeNode l3n1 = new TreeNode();
        l3n1.data = "D";
        TreeNode l3n2 = new TreeNode();
        l3n2.data = "E";

        l2n1.left_child = l3n1;
        l2n1.right_child = l3n2;
//

        TreeNode l3n3 = new TreeNode();
        l3n3.data = "F";
        TreeNode l3n4 = new TreeNode();
        l3n4.data = "G";

        l2n2.left_child = l3n3;
        l2n2.right_child = l3n4;

//        run
        System.out.print("Pre (VLR) : ");
        TreeNode.pre_order(root);
        System.out.print("\n");
//
        System.out.print("In (LVR) : ");
        TreeNode.in_order(root);
        System.out.print("\n");
//
        System.out.print("Post (LRV) : ");
        TreeNode.post_order(root);
        System.out.print("\n");
    }
}
