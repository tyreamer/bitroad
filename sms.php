<?php
    // Get the PHP helper library from twilio.com/docs/php/install
    require_once './vendor/autoload.php'; // Loads the library
    use Twilio\Rest\Client;
    use Twilio\Exceptions\TwilioException;

    // require POST request
    if ($_SERVER['REQUEST_METHOD'] != "POST") die;
    if ( !(isset($_POST['phone_number']))) 
    {
        echo'   <script type="text/javascript">
                    alert("Please fill out all required fields and try again");
                    window.location = "create-post.php?loc=$_POST["number"]";
                    </script>      ';
                    return false;
                    break;
    }
        
    
    // generate "random" 6-digit verification code
    $code = rand(100000, 999999);
    
    // initiate phone call via Twilio REST API    
    // Set our AccountSid and AuthToken 
    $AccountSid = "AC5b13bae9e279a8ae57900d87aa1b41b4";
    $AuthToken = "3b21a5581cb2b8c93a06bf8551f27346";
    $twilioNumber = '+16466814242';
    $to = $_POST['phone_number']; 

    // Instantiate a new Twilio Rest Client 
    $client = new Client($AccountSid, $AuthToken);
    $message = 'Here is your verification code: '. $code .
                ' Enter this code to verify your phone number.';

    // make call
    try {
        $client->messages->create(
            $to,
            [
                "body" => $message,
                "from" => $twilioNumber
                //   On US phone numbers, you could send an image as well!
                //  'mediaUrl' => $imageUrl
            ]
        );
        // return verification code as JSON
        
    } catch (TwilioException $e) {
        echo 'Could not send SMS notification.' .
            ' Twilio replied with: ' . $e;
        
    }
    
    $json = array();    
    $json["verification_code"] = $code;
    
    header('Content-type: application/json');
    echo(json_encode($json));
    
    
?>