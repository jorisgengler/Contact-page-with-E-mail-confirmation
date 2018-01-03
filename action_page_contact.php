<?php
//------------------------------ Connect database ------------------------------//
	$con = mysqli_connect('Database naam','Database gebruiktsnaam','Wachtwoord'); //moet veranderd worden

//------------------------------ Database check ------------------------------//
	if(!$con) {
		echo 'Not Connected To Server';
	}
	if (!mysqli_select_db ($con,'database')) { //moet veranderd worden
		echo 'Database Not Selected';
	}

//------------------------------ Insert intro database ------------------------------//
	$firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : '';
	$email = (isset($_POST['email'])) ? $_POST['email'] : '';
	$subject1 = (isset($_POST['subject1'])) ? $_POST['subject1'] : '';

//------------------------------ Insert intro database ------------------------------//
	$sql = "insert into grid_site (firstname,email,subject1) values ('$firstname','$email','$subject1')";

//------------------------------ Database check if inserted ------------------------------//
	if (!mysqli_query($con,$sql)) {
		echo 'Not Inserted';
	}

	else {

	 echo 'Inserted Successfully'; //when data inserted to database

//------------------------------ Insert intro mail ------------------------------//
		require 'mailer.php';

		$to = $email;   // Hier het email adres waarnaar verstuurd word.(In dit geval wordt het ingevoerde e-mail uit het contact vormulier gebruikt)
		$subject = "Grid site contact_formulier"; // Onderwerp
		$message = "From: $email </br></br> Uw email is aangekomen </br> $subject1";  // Het bericht

		$headers ="hallo";

		sendMail($to, $subject, $message, $headers); //send mail



		//------------------------------ after insert to contact ------------------------------//
			 header("Location: https://www.grid.jorisgengler.nl/index.php#section7"); //Terug naar uw eigen pagina

	}
?>﻿
