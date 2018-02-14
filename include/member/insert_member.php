
        <?php
        include '../../connect.php';

                                        $Member_firstname = $_POST['Member_firstname'];
                                        $Member_surname = $_POST['Member_surname'];
                                        $Username = $_POST['Username'];
                                        $Password = $_POST['Password'];
                                        $Member_email = $_POST['Member_email'];
                                

                                        $sql = "INSERT INTO member (Member_firstname, Member_surname, username,password,Member_email,Admin_permission,Member_visiblestatus)
VALUES ('$Member_firstname','$Member_surname','$Username','$Password','$Member_email','0','1');";
                                                         $data = mysqli_query($conn,$sql);

    

        ?>
