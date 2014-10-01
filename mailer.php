<?php

$myemail = "gusac.info@gmail.com";


$name = sanitize($_POST['inputName'], "Your Name");
$info = sanitize($_POST['inputInfo'], "Your College and Branch");
$number = sanitize($_POST['inputNumber'], "Your Phone number");
$email = sanitize($_POST['inputEmail'], "Your E-mail Address");
$subj = sanitize($_POST['inputSubject'], "Message Subject");
$message = sanitize($_POST['inputMessage'], "Your Message");


if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
	show_error("Invalid e-mail address");
}


$subject = "Message from $email";

$message = "

	$name has sent you a message using your contact form:

	Name: $name
	Email: $email
	From: $info
	Number: $number
	Subject: $subj

	Message:
	$message

	";


mail($myemail, $subject, $message);


header('Location: http://www.gusac.org/contact.html');
exit();


function sanitize($data, $problem='')
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	if ($problem && strlen($data) == 0)
	{
		show_error($problem);
	}
	return $data;
}

function show_error($myError)
{
?>
<html>
<body>

<p>Please correct the following error:</p>
<strong><?php echo $myError; ?></strong>
<p>Hit the back button and try again</p>

</body>
</html>
<?php
	exit();
}
?>
