<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['name']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}
	

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	$phone = trim($_POST['phone']);
	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'luka.howard@gmail.com'; //Put your own email address here
		$body = "Name: $name \n\nPhone: $phone \n\nEmail: $email \n\nComments:\n $comments";
		$headers = 'DISUK Ennquiry' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<!-- ======== Basic Page Needs ========= -->    
<meta charset="utf-8">
<title>Luke Howard // Designer, Developer and Geek</title>

<!-- ======== Responsive Page Needs ========= -->    
    
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- ======== Mooi Layout, and Responsive Needs ========= -->
    
<!-- HTML5Shiv.js & Respond.js -->
<!--[if lte IE 8]>
<script type="text/javscript" src="jquery/html5shiv.js"></script>
<script type="text/javscript" src="jquery/respond.js"></script>
<![endif]-->

<!-- ======== CSS StyleSheets ========= -->    
<link rel="stylesheet" href="//f.fontdeck.com/s/css/hHe2eeOPSef/0iNrBlOdAIYMato/lukehoward.me.uk/35410.css" type="text/css" />
<link rel="stylesheet" href="//f.fontdeck.com/s/css/hHe2eeOPSef/0iNrBlOdAIYMato/www.lukehoward.me.uk/35410.css" type="text/css" />
<link href="../stylesheets/style.css" rel="stylesheet" type="text/css">

<!--[if lte IE 9]>
<link href="stylesheets/ie_style.css" rel="stylesheet" type="text/css">
<![endif]-->
   <script type="text/javascript">
$(document).ready(function(){
	// validate signup form on keyup and submit
	var validator = $("#contactform").validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: false,
			},
			company: {
				required: false,
			},
			message: {
				required: true,
				minlength: 10
			}
		},
		messages: {
			name: {
				required: "Please enter your name.",
				minlength: jQuery.format("Please enter your name")
			},
			email: {
				required: "Please enter your email address.",
				minlength: "Please enter your email address."
			},
			message: {
				required: "Please enter your message.",
				minlength: jQuery.format("Please enter your message.")
			}
		},
		// set this class to error-labels to indicate valid fields
		success: function(label) {
			label.addClass("checked");
		}
	});
});
</script> 
    
</head>

<body>

<!-- ======== Site Content ========= -->

<header class="full-row page-header">
    <div class="row">
        <div class="sixteen columns header">
            <img class="logo" src="../images/logo.png" alt="Luke Howard" width="300" height="80" />
            <nav>
                <ul class="mooi-menu-horizontal  mooi-menu-right">
                    <li><a href="http://lukehoward.me.uk">Home</a></li>    
                    <li><a href="http://lukehoward.me.uk/about">About</a></li>
                    <li><a href="http://lukehoward.me.uk/work">Work</a></li>
                    <li><a href="http://lukehoward.me.uk/projects">Projects</a></li>
                    <li><a href="http://lukehoward.me.uk/blog">Blog</a></li>
                    <li><a href="http://lukehoward.me.uk/contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>        
</header>    
    
    
<div class="row">
    
    <div class="one-third column">
        <div class="workspace">
            <img src="../images/desk.png" alt="My Workspace" />
            <div class="workspace-background">
            <p>This is where I spend most of my time creating websites, or working on projects.</p>
            </div>
            
        </div>            
    </div>
    
    <div class="two-thirds column padding-left">
    <h2>I'm based in Northampton, in the UK </h2>
    
        <p>If you want to get in touch, and find out more about me, then drop me a line, use the form below, or drop me an email.</p>
        
        <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
                    <div class="form_success">
                        <h6>Email Successfully Sent!</h6>
                        <p>Thanks for your message <strong><?php echo $name;?></strong>! I will be in touch with you soon.</p>
                	</div>
				<?php } ?>
    
    	<form class="mooi-form mooi-form-aligned" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform" >
        	<div>
                <label>Name</label>
                <input type="text" name="name" id="name" placeholder="Name" />
			</div>
            <div>
                <label>Email</label>
                <input type="text" name="email" id="email" placeholder="Email" />
			</div>
            <div>
                <label>Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Phone" />
			</div>
            <div>
                <label>Message</label>
                <textarea name="message" id="message" placeholder="Message"></textarea>
			</div>            
            
            <div class="mooi-form-aligned-right">
            	<input class="mooi-button mooi-button-primary" type="submit" value="Send Message" name="submit" id="contact-submit-button" title="Click here to submit your message!" />
            </div>
		</form>
    		
            <?php if(isset($hasError)) { //If errors are found ?>
                    <p class="form_error">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
			<?php } ?>
        
        
    </div>
    
    
</div>
    
    
<footer class="row">
    <div class="sixteen columns footer">
        
    </div>

    <div class="four columns"><p>&copy; Copyright 2013. Luke Howard.</p></div>
    <div class="four columns"><p>&nbsp;</p></div>
    <div class="four columns"><p>&nbsp;</p></div>
    <div class="four columns"><p>Website built by <a href="http://www.lukehoward.me.uk/about.php">Me</a> using <a href="http://www.lukehoward.me.uk/mooi">Mooi</a>.</p></div>
    
</footer>    
    

</body>
</html>