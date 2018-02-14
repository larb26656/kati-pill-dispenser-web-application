
        <?php
        include '../../connect.php';

                                        $Member_id = $_POST['Member_id'];
                                        $Member_firstname = $_POST['Member_firstname'];
                                        $Member_surname = $_POST['Member_surname'];
                                        $Password = $_POST['Password'];
                                        $Member_email = $_POST['Member_email'];

                                        $sql = "UPDATE member SET Member_firstname = '$Member_firstname',Member_surname = '$Member_surname',password = '$Password',Member_email = '$Member_email' WHERE Member_id='$Member_id'";
                                         $data = mysqli_query($conn,$sql);

    

        ?>
