<?php

/**
 * Set user data into db and send email token to verify if form is submitted
 */

if (isset($_POST["submit"])) {
	require_once("../../src/classes/User_Auth.php"); #UserAuth class
	require_once("send_email.php"); #send_email function

	//Setters
	$user = new UserAuth;
	$user->setFirstName($_POST["first_name"]);
	$user->setLastName($_POST["last_name"]);
	$user->setUsername($_POST["username"]);
	$user->setEmail($_POST["email"]);
	$user->setPassword($_POST["password"]);
	$user->setStatus('Disabled');
	$user->setRegistrationDate(date('Y-m-d H:i:s'));
	$user->setVerificationCode(hash('sha512', uniqid()));
	$data = $user->getUserData();

	//Argumenst for send_email function
	$to = $user->getEmail();
	$from = "david.lucic007@gmail.com";

	$from_name = "Enigma";
	$subject = "Welcome to Enigma";
	$body = "<p>Thank you for registering!</p>
				 <p>This is a verification email, please click the link to veriy your email address.</p>
					<p><a href =http://192.168.100.14/enigma/src/model/verify_email.php?code={$user->getVerificationCode()}>Click to verify</a></p>
									 <p>If this is not you, please do not click on the link</p>";

	//id data returned from getUserData() method, username or email exits
	if (is_array($data) && count($data) > 0) {
		echo "<h3>Email you provided is already registered or username exists</h3>";
		echo "<p><a href= ../../public/view/login.php>Login instead?</a></p>";
	} else {
		#if new mail is provided and data is processed send token to user email
		if ($user->saveData()) {

			if (send_email($to, $from, $from_name, $subject, $body)) {
				$success_message = "Verification Email sent to "  . $user->getEmail() . ", verify your email before logging in";

				echo "<p>$success_message</p>";
			} else {
				echo "Email not sent";
			}
		} else {
			include("../../public/view/register.php");
			$user->showRegistrationErrors();
		}
	}
}
