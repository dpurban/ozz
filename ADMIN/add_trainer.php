<?php

    include '../conn.php';
    
    if(isset($_POST['add']))
    {
        $target="../trainers_images/". basename($_FILES['image']['name']);

        if(!empty($_POST['isActive']))
        {
            $isActive = 1;
        }
        else
        {
            $isActive = 2;   
        }

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $fullname = $fname." ".$lname;
        $email = $_POST['email'];
        $cnum = $_POST['cnum'];
        $image =$_FILES['image']['name'];
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];

        $select = mysqli_query($conn,"SELECT * FROM tbl_users WHERE Username = '$uname'");
        $check = mysqli_num_rows($select);

            if(!isset($_POST['program_trainer']))
            {
                echo '<script language ="javascript">' . 'alert("Choose Specialization Program/s for your Trainer")'. '</script>';
            }
            else if($check > 0)
           {
             echo '<script language ="javascript">' . 'alert("Username already exists")'. '</script>';
           } 
            else
            {
                $insert_trainers = mysqli_query($conn,"INSERT INTO tbl_trainers VALUES('','$fname','$lname','$image','$cnum','$email','$isActive')");
                $last_id= mysqli_insert_id($conn);
                $date =date("Y-m-d");

                $insert_users = mysqli_query($conn,"INSERT INTO tbl_users VALUES('$last_id','$uname','$pass',3,'$date')");

                move_uploaded_file($_FILES['image']['tmp_name'], $target);


                if($insert_trainers && $insert_users)
                {
                    
                    $program_id = $_POST['program_trainer'];
                    $day = $_POST['program_day'];
                    $time = $_POST['time'];
                    $y = 0;
                        
                         for($i=0;$i<sizeof($program_id);$i++){
                            
                                $insert_trainer_program = mysqli_query($conn,"INSERT INTO tbl_spectrainer VALUES('','$last_id','$program_id[$i]')");
                            }
                        for($i=0;$i<sizeof($day);$i++){
                        
                            if($time[$y] !=="1")
                            {
                                 $insert_trainer_avail = mysqli_query($conn,"INSERT INTO tbl_trainer_avail VALUES('','$last_id','$day[$i]','$time[$y]')");
                                  $y++;
                            }
                            else
                            {
                                while($time[$y]=="1")
                                {
                                    $y++;

                                     if($time[$y]!=="1")
                                    {
                                      $insert_trainer_avail = mysqli_query($conn,"INSERT INTO tbl_trainer_avail VALUES('','$last_id','$day[$i]','$time[$y]')");
                                      $y++;
                                      break;
                                    }
                                }
                            }
                        }
                            
                            if($insert_trainer_program)
                            {

                                  
                                    echo '<script language ="javascript">' . 'alert("Trainers Added!")'. '</script>';
                            }
                            else
                            {
                                 echo mysqli_errno();
                            }
                }
                else
                {
                    echo mysqli_errno();
                }
            }

        }
    
    else if (isset($_POST['cancel']))
    {
        echo '<script language ="javascript">' . 'alert("Cancelled!")'. '</script>';
    }

?>
