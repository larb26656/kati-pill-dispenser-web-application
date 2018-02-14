
        <?php
        include '../../connect.php';

                                        $Member_id = $_GET['Member_id'];
 

                                        $sql = "UPDATE member SET Admin_permission = '0'";
                                         $data = mysqli_query($conn,$sql);
                                         $sql2 = "UPDATE member SET Admin_permission = '1' WHERE Member_id = '$Member_id'";
                                         $data2 = mysqli_query($conn,$sql2);
    

        ?>
