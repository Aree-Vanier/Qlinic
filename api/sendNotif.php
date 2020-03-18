<?php
//phpinfo();

include $_SERVER["DOCUMENT_ROOT"]."/backend/utils.php";
// Include the bundled autoload from the Twilio PHP Helper Library
require $_SERVER["DOCUMENT_ROOT"] . '/libs/twilio/src/Twilio/autoload.php';
use Twilio\Rest\Client;
// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'ACde26130a147272b1009971dffcbb4479';
$auth_token = '209f43316b95742240fcf300a71a4652';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
$twilio_number = "+12066780982";

echo "Sending message";

try {
    $client = new Client($account_sid, $auth_token);
} catch (\Twilio\Exceptions\ConfigurationException $e) {
    echo $e;
}

echo "Connection created";

//curl_init();
//echo "init";

try {
    $client->messages->create(
    // Where to send a text message (your cell phone?)
        '+16139297295',
        array(
            'from' => $twilio_number,
            'body' => 'I sent this message in under 10 minutes!'
        )
    );
} catch (\Twilio\Exceptions\TwilioException $e) {
    echo "Send failed:".$e;
}

echo "Message sent";
