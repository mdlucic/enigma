<?php

//if user clicked on the link change his status and for now redirect to homepage
//TODO make createPage function work and redirect there after used logs in
if (isset($_GET['code'])) {

	require_once("../classes/User_Auth.php");
	$user = new UserAuth;
	$user->setVerificationCode($_GET['code']);

	if ($user->isValidEmailToken()) {
		$user->setStatus('Enabled');
	}

	if ($user->enableAccount()) {
		$user->createPage($_GET['user']);
		header("Location: ../../public/view/login.php?action=verified");
		exit();
	}
	else {
		echo "Error, account not enabled";
	}
}
else {
		echo "There is a mistake with the address of the sender, please change url in register_validation.php";
}
