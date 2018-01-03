<?PHP
ini_set ("display_errors", 1);
error_reporting(E_ALL);

echo "<p>Email formulier</p>";
/*/ Hierin kunt u de gegevens aanpassen waarnaar de informatie gestuurd word     /*/
$user ='Hier uw email'; //moet veranderd worden
$passw ='Hier uw wachtwoord'; //moet veranderd worden
/*/   Hieronder nog een aantal zaken nalopen /*/
/*/   Lees de comments voor meer informatie /*/
//includes
include 'PHPmailer/class.phpmailer.php';
include 'PHPmailer/class.smtp.php';

function sendMail ($to, $subject, $message, $headers){
	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
	$mail->IsSMTP(); // telling the class to use SMTP

	try {
		global $user;  // Uw gebruikersnaam voor SMTP
		global $passw; // Uw wachtwoord voor bovenstaande

		$mail->SMTPDebug  = 1;                     // Turn ON voor Debug
		$mail->SMTPAuth   = true;                  // Moet altijd aanstaan
		$mail->Host       = "smtp.mijnhostingpartner.nl"; // Moet op MHP staan
		$mail->Port       = 25;                    // Moet op 25 staan
		$mail->Username   = $user; //  Zie global $user
		$mail->Password   = $passw;        // Zie global $ passw


		/*/  /*/
		// Hieronder kan een alternatief email adres worden ingevuld zoals een gmail adres of live etc
		$mail->AddAddress($to); // Adress waar het naartoe word gestuurd, indien een ander adres vul dan het volgende in tussen de ()    "Hieruwalternatief@mail.adres"
		/*/  /*/
		$mail->SetFrom($user); // Adress waar het vandaan komt normaal $user tussen de ()
		//$mail->addReplyTo('email adress', 'onderwerp'); //  Hier een eventuele  tweede mail die het ontvangt
		$mail->addBCC("$user\r\n"); // zend BCC naar eigen mail
		$mail->Subject = $subject;  // pakt het onderwerp van het formulier
		$mail->MsgHTML($message); // Pakt het bericht
		$mail->Send();  // Verzend
		echo "Message Sent OK<p></p>\n";  // Kan aangepast worden naar een persoonlijk verstuurd bericht

		// hieronder de foutmelding rapportage
	} catch (phpmailerException $e) {
	  echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
	  echo $e->getMessage(); //Boring error messages from anything else!
	}
}


?>
