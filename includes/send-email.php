<?

function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}



$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

$error = 0;
$return = array();

if(strcmp($name, '') == 0){
	$return['error'] = 1;
	$return['culprit'] = "#name";
	$return['html'] = "Please include your name.";
	$error += 1;
	echo json_encode($return);
	exit();
}

if(strcmp($email, '') == 0){
        $return['error'] = 1;
        $return['culprit'] = "#email";
	$return['html'] = "Please include your email address.";
	$error += 1;
	echo json_encode($return);
	exit();
}

if(!check_email_address($email)){
	$return['error'] = 1;
	$return['culprit'] = "#email";
	$return['html'] = "Ensure your email address is valid.";
	$error += 1;
	echo json_encode($return);
	exit();
}

if(strcmp($message, '') == 0){
        $return['error'] = 1;
        $return['culprit'] = "#message";
	$return['html'] = "Please actually write a message!";
	$error += 1;
	echo json_encode($return);
	exit();
}

$to      = 'willwebberley@gmail.com';
$subject = 'Website Query';
$content = 'Name: '.$name.' Email: '.$email.' Message:'.$message;
$headers = 'From: website-query@willwebberley.net' . "\r\n" .
    'Reply-To: '.$email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $content, $headers);

$return['error'] = 0;
$return['html'] = "";

echo json_encode($return);

?>