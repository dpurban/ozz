<!DOCTYPE html>
<html>
<?php include 'head.php';?>
<?php
  $custinfo_id = $_SESSION['custinfo_id'];

  $frodo = mysqli_query($conn, "SELECT * FROM tbl_members WHERE custinfo_id = '$custinfo_id'");
  $arf = mysqli_fetch_array($frodo);
  $membershipexpiry = $arf['membershipexpiry'];
  $date = date_create($membershipexpiry);
?>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php include 'nav.php';?>
    <div class="wrapper">
      <div class="container">
    <!--INSERT CODE HERE-->

            <div class = "centercard" style="margin-top: 200px;">
              <h3 style="text-align: center;">ACCOUNT DEACTIVATION NOTICE</h3>
              <br>
              Dear Ozz customer,
              <br><br>
              It has come to our attention that your Ozz Membership has already expired
              last <?php echo date_format($date,"m-d-Y");?>.<br><br>
              To reactivate, you must pay the Basic Fee of 500 PHP. Payment could be made via bank transfer or by simply going to Ozz Fitness Centre to pay at the cashier.
              <br><br>
              Once paid, membership will be valid
              for 12 months, just like the previous membership. 
              <br><br>
              <div class="btnana">
                <a href="" class = "btn btn-default page-scroll" data-toggle="modal" data-target="#bankpay">CLICK HERE FOR BANK TRANSFER PAYMENT</a>
              </div>
            </div>

    <!--INSERT CODE HERE ^^^^-->
      </div>
    </div>
    <?php include 'javascript.php';?>
</body>
</html>
<style>
  .btnana{
    text-align: center;
  }
  body
  {
    font-family: Montserrat;
  }
</style>

<div id="bankpay" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <form method="POST" enctype="multipart/form-data">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">BANK PAYMENT</h4>
        </div>

        <div class="modal-body">
          <table  class="table table-bordered table-striped" style="text-align: center;">
            <?php
              $bankSel = mysqli_query($conn, "SELECT * FROM tbl_bank");
              $show = mysqli_fetch_array($bankSel);
              $bankname = $show['bankname'];
              $accnum = $show['accnum'];
              $accname = $show['accname'];
            ?>
            <tr>
              <td>Bank Name:</td>
              <td><?php echo $bankname;?></td>
            </tr>
            <tr>
              <td>Account Name:</td>
              <td><?php echo $accname;?></td>
            </tr>
            <tr>
              <td>Account #:</td>
              <td><?php echo $accnum;?></td>
            </tr>
          </table>

          <div  class="form-group">
              <strong>Bank / Remmitance Center</strong>
              <div class="input-group">
                  <div class="input-group-addon"></div>
                  <input type = "text" class="form-control" name ="bankrem" required>
                  <input type = "hidden" name ="user_id" value="<?php echo $custinfo_id; ?>">
              </div>
          </div>

          <div  class="form-group">
          <?php
              $selMemship = mysqli_query($conn, "SELECT * FROM tbl_payment_membership WHERE user_id = '$custinfo_id'");
              while ($pull = mysqli_fetch_array($selMemship))
              {
                  $rembalance = $pull['rembalance'];
              }
          ?>
              <strong>Membership</strong>
              <div class="input-group">
                  <div class="input-group-addon"></div>
                  <input type = "number" class="form-control" name ="mempay" placeholder="<?php echo $rembalance;?>" step="0.01" required>
              </div>
          </div>

          <div  class="form-group">
              <strong>Notes</strong>
              <div class="input-group">
                  <div class="input-group-addon"></div>
                  <textarea class="form-control" rows="3" name="notes"></textarea>
              </div>
          </div>
          <br>
          <div  class="form-group">
              <div class="input-group">
                  <input type="file" name="myimage" required> 
              </div>
          </div>
          <h6 style="color: red;">Note: Proof of payment confirmation shall be given within the next 24 hours.</h6>
        </div>

        <div class = "modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" name = "mempayrenew" class="btn btn-default">SUBMIT</button>
        </div>

      </div>
    </form>
  </div>

</div>

<?php
    if (isset($_POST['mempayrenew']))
    {
        $user_id = $_POST['user_id'];
        $bankrem = $_POST['bankrem'];
        $mempay = $_POST['mempay'];
        $notes = $_POST['notes'];

        $upload_image=$_FILES["myimage"][ "name" ];
        $folder="images/";
        move_uploaded_file($_FILES["myimage"]["tmp_name"], "ADMIN/images/".$_FILES["myimage"]["name"]);

        
        $insertMem = mysqli_query($conn, "INSERT INTO tbl_proofofpayment_membership 
        VALUES ('', '$user_id', '$bankrem', NOW(), '$folder', '$upload_image',
                    '$mempay', '$notes', '')");

        if ($insertMem)
        {
            echo '<script language ="javascript">' . 'alert("Proof of payment submitted!")'. '</script>';
        }
        else
        {
            echo mysqli_errno($conn);
        }
        

    }
?>