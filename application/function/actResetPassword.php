<?php
    include "conn.php";
	
    $key  = @$_GET['key'];
	$link	= "http://localhost/backpack/auth/actResetPassword?key=".($key);
	date_default_timezone_set("Asia/Bangkok");
	$dateRegister = date("Ymd",time()).date("H:i:s");

	$userCheck = "SELECT link FROM forgot_password WHERE link = '$link'";
	$checkExist = mysqli_query($conn,$userCheck);
	$data = mysqli_fetch_array($checkExist, MYSQLI_NUM);
	echo ($data[0]);
	if($data[0] == NULL) {
		header('location:forgotPassword?status=unknown');
		exit;
	}
	else {
		header('location:resetPassword');
	}
?>
