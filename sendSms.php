<?php

// Start Twilio Connection
    // Require the bundled autoload file - the path may need to change
    // based on where you downloaded and unzipped the SDK
    require __DIR__ . '/twilio-php-master/Twilio/autoload.php';

    // Use the REST API Client to make requests to the Twilio REST API
    use Twilio\Rest\Client;

    // Your Account SID and Auth Token from twilio.com/console
    $sid = 'AC849b43dee2858f0b1358c8526d75afb9';
    $token = '8a33bf720e70b35239d44a6814206ce2';
    $client = new Client($sid, $token);

    // Use the client to do fun stuff like send text messages!
    $client->messages->create(
    // the number you'd like to send the message to
    '+18455449246',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+19733586042 ',
        // the body of the text message you'd like to send
        'body' => "echo $comments"
    )
);
