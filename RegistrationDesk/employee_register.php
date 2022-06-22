<?php
session_start();
include('assets/configs/config.php');
if (isset($_POST['register'])){
  $em_email = $_POST['em_email'];
  $password = sha1($_POST['password']);
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $department = $_POST['department'];
  $stmt = $mysqli->prepare("insert into hospital_employees (em_email, password, em_fname, em_lname, em_dept, em_address, em_phone)  values (?,?,?,?,?,?,?)");
  $stmt->bind_param('sssssss',  $em_email, $password, $f_name, $l_name, $department, $address, $phone);
  $stmt->execute();
  $stmt2 = $mysqli->prepare("SELECT em_email, password, em_id FROM  hospital_employees  WHERE   em_email=? and password=?");
  $stmt2->bind_param('ss',  $em_email, $password);
  $stmt2->execute();
  $stmt2->bind_result($em_email, $password, $em_id);
  $rs = $stmt2->fetch();
  $_SESSION['em_id'] = $em_id;
  if($rs){
    header("location:ohcms_pages_employee_dashboard.php");
  } else {
    $error = "Please Check Your Email Or Password";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="assets/img/logo-fav.png">
  <title>HealthCare Systems</title>
  <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" />
  <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css" />
  <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
  <script src="assets/lib/sweetjs/swal.js"></script>
  <!--Sweet alert js-->

</head>

<body class="be-splash-screen">
  <div class="be-wrapper be-login">
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="splash-container">
          <div class="card card-border-color card-border-color-primary">
            <div class="card-header"><img class="logo-img" src="assets/img/logo-xx.png" alt="logo" width="102" height="27"><span class="splash-description">Patient Registration Department Login Panel</span></div>
            <div class="card-body">
              <!--Code for Triggering an error-->
              <?php if (isset($error)) { ?>
                <script>
                  setTimeout(function() {
                      swal("Failed!", "<?php echo $error; ?>!", "error");
                    },
                    100);
                </script>

              <?php } ?>

              <form method="post">
                <div class="form-group">
                  <input class="form-control" name="f_name" id="f_name" type="text" placeholder="First Name" autocomplete="off">
                </div>
                <div class="form-group">
                  <input class="form-control" name="l_name" id="l_name" type="text" placeholder="Last Name" autocomplete="off">
                </div>

                <div class="form-group">
                  <input class="form-control" name="address" id="address" type="text" placeholder="Address" autocomplete="off">
                </div>
                <div class="form-group">
                  <input class="form-control" name="phone" id="phone" type="text" placeholder="Phone" autocomplete="off">
                </div>
                <div class="form-group">
                  <input class="form-control" name="department" id="department" type="text" placeholder="Department" autocomplete="off">
                </div>


                <div class="form-group">
                  <input class="form-control" name="em_email" id="username" type="text" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group">
                  <input class="form-control" name="password" id="password" type="password" placeholder="Password">
                </div>


                <div class="form-group login-submit"><input type="submit" class="btn btn-primary btn-xl" name="register" data-dismiss="modal" value="Sign Up"></div>
              </form>

            </div>
          </div>
          <div class="splash-footer"><span>© All Rights Reserved HealthCare Systems</span></div>
          <div class="splash-footer"><span>Powered By <a href="https://martmbithi.github.io">Team FYP</a></span></div>
          <div class="splash-footer"><span><a href="../">Home</a></span></div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
  <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="assets/js/app.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
    });
  </script>
</body>

</html>
