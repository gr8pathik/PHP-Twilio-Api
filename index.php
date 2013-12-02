<html>
<head> 
<title> Twilio Api - Make a call </title>
</head>

<body bgcolor="white" text="blue">

<h1> Twilio Api - Make a call </h1>
<form name="twilioForm" id="twilioForm" action="" method="post">
	<!-- <input type="submit" name="twilioSubmitSMS" value="Send and SMS" /> -->
	<input type="submit" name="twilioSubmit" value="Make a Call" />
</form>

</body>

</html>
<?php
// Download the library and copy into the folder containing this file.
require('twilio-php/Services/Twilio.php');
$account_sid = "ACce3ca8e97d00cdfcc965747acb1983aa"; // Your Twilio account sid
$auth_token = "210151f0972fd1465ce6416dafdfdff3"; // Your Twilio auth token
$client = new Services_Twilio($account_sid, $auth_token);
$phoneNumber = '+919510076697'; //Your register Twilio number
$fromPhoneNumber = '+12028172206';

if(isset($_POST['twilioSubmit'])){	
	// Create a new DOMDocument object
    $doc = new DOMDocument();
     
    // Load XML from a file
    $doc->load( 'call.xml' );
    //echo $doc->childNodes->length; 	
 	$age = $doc->getElementsByTagName('Say');   
    // print node value      
    //echo $age->item(0)->getAttribute('voice');
    $age->item(0)->nodeValue = 'One Order has been Placed in your Website. Thanks.';

    $doc->save('call.xml');

	$call = $client->account->calls->create(
	  $fromPhoneNumber, // From a Twilio number in your account
	  $phoneNumber, // Call any number

	  // Read TwiML at this URL when a call connects (hold music)
	  /*'http://demo.twilio.com/docs/voice.xml'*/
	  'http://dev.indianic.com/startup49/twiliocall/call.xml'
	);
}

if(isset($_POST['twilioSubmitSMS'])){
	$message = $client->account->sms_messages->create(
	  $fromPhoneNumber, // From a Twilio number in your account
	  $phoneNumber, // Text any number
	  "Hello monkey!"
	);

	print $message->sid;
}
?>