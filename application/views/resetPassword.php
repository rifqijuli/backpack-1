<?php
    include "conn.php";
	
    $key  = @$_GET['key'];
	$link	= "http://localhost/backpack/auth/resetPassword?key=".($key);
	date_default_timezone_set("Asia/Bangkok");
	$dateRegister = date("Ymd",time()).date("H:i:s");

	$userCheck = "SELECT link, email FROM forgot_password WHERE link = '$link' AND flag='0'";
	
	$checkExist = mysqli_query($conn,$userCheck);
	$data = mysqli_fetch_array($checkExist, MYSQLI_NUM);
	if($data[0] == NULL) {
		header('location:forgotPassword?status=unknown');
		exit;
	}
	else {
		$sql = "UPDATE forgot_password SET flag = '1' WHERE link = '$link' AND flag='0'";
		if ($conn->query($sql) === TRUE) {
		} 
		else {
			header('location:forgotPassword?status=unknown');
		}  
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo isset($title)?$title:'Backpack Reset Password';?></title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url().'assets/bootstrap/vendor';?>/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=base_url().'assets/bootstrap/css';?>/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
				  <div class="text-center">
					<?php 
						if(@$_GET['status'] == 'failed'){ ?>
							<h1 class="h4 text-gray-900 mb-4">Failed!</h1>
					<?php } 
						else if(@$_GET['status'] == 'success'){ ?>
							<h1 class="h4 text-gray-900 mb-4">Success!</h1>
					<?php } 
						else { ?>                 
							<h1 class="h4 text-gray-900 mb-4">Insert your new Password</h1>
					<?php } ?>
                  </div>
                  <form class="user" method="post" action="actResetPassword">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="inputPassword" placeholder="New Password">
                    </div>
					<div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputRetypePassword" name="inputRetypePassword" placeholder="Retype New Password">
                    </div>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<input type="hidden" name="inputEmail" value="<?php echo $data[1];?>">
					<input type="hidden" name="inputHash" value="<?php echo $data[0];?>">
                    <button class="btn btn-primary btn-user btn-block" type="submit">
                      Reset Password
                    </button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url().'assets/bootstrap/vendor';?>/jquery/jquery.min.js"></script>
  <script src="<?=base_url().'assets/bootstrap/vendor';?>/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url().'assets/bootstrap/vendor';?>/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url().'assets/bootstrap/js';?>/sb-admin-2.min.js"></script>

</body>

</html>
