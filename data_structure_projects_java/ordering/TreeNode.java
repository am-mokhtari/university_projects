public class TreeNode {
    public TreeNode left_child = null;
    public TreeNode right_child = null;
    public String data = null;

    public static void pre_order(TreeNode root) {
//        VLR
        if (root == null) {
            return;
        }

        System.out.print(root.data);
        pre_order(root.left_child);
        pre_order(root.right_child);
    }

    public static void in_order(TreeNode root) {
//        LVR
        if (root == null) {
            return;
        }

        in_order(root.left_child);
        System.out.print(root.data);
        in_order(root.right_child);
    }

    public static void post_order(TreeNode root) {
//        LRV
        if (root == null) {
            return;
        }

        post_order(root.left_child);
        post_order(root.right_child);
        System.out.print(root.data);
    }
}
