<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/backend/utils.php";

// Include the bundled autoload from the Twilio PHP Helper Library
require $_SERVER["DOCUMENT_ROOT"] . '/libs/twilio/src/Twilio/autoload.php';
use Twilio\Rest\Client;
// Your Account SID and Auth Token from twilio.com/console

function sendSMS($message, $phone) {
    try {
        $client = new Client(TWILIO_SID, TWILIO_TOKEN);
    } catch (\Twilio\Exceptions\ConfigurationException $e) {
        //echo $e;
    }

    try {
        $client->messages->create(
        // Where to send a text message (your cell phone?)
            $phone,
            array(
                'from' => TWILIO_NUMBER,
                'body' => $message
            )
        );
    } catch (\Twilio\Exceptions\TwilioException $e) {
       // echo "Send failed:" . $e;
    }
}
