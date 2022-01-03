<?php session_start();

ini_set('session.gc_maxlifetime',10);
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$inactive = 10;
if( !isset($_SESSION['timeout']) )
$_SESSION['timeout'] = time() + $inactive; 

$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive)
{  session_destroy();     }

$_SESSION['timeout']=time();
if(isset($_POST['submit'])){

$number = $_POST['number'];
$otp = rand(1000,9999);
$_SESSION['otp'] = $otp;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'ACd50f4e45307094432d759bde1b18cb04';
$auth_token = 'c2cac1dd13aca0d5caa01363449788d6';


// A Twilio number you own with SMS capabilities
$twilio_number = "+17069199622";

$client = new Client($account_sid, $auth_token);

$mmm=$client->messages->create(
    // Where to send a text message (your cell phone?)
    $number,
    array(
        'from' => $twilio_number,
        'body' => $otp
    )
);
echo "<pre>";
print_r($mmm);

}
?>

<form method ="post">
	<label>mobile</label>
	<input type="text" name ="number"><br><br><br>

    

	<input type="submit" name ="submit"><br><br><br>


</form>