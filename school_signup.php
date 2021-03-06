<?php // school_signup.php
include 'common.php';
include 'db.php';

if (!isset($_POST['submitok'])):
// Display the school signup form
?>

<!DOCTYPE>
<head>
	<title>Backpack - Schools</title>
	<link rel="stylesheet" href="school_style.css"/>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head> 

<html>
<body>

<header>

<a href="signup.php" >
<img id="logo" src="img/backpack_logo.png" alt="logo" />
</a>

<div id="for_schools">
	for schools
</div>

<form id="returning_user" action="index.php" method="post" enctype="text/plain">
	<input id="login_button" type="submit" onclick="submit" value="Login" />

</form>

</header>

<div id="slides">

<div class="slide" id="s1">
	<div id="s1_content">

		<h1>Don't let important messages get lost on their way back from school.<h1>

	</div>
</div>

<div class="slide" id="s2">

	<img src="img/push_iphone.png" alt="push notifications" />

	<div id="s2_content">
	<h1>Reach the parents who need to know, with push notifications.<h1>
	</div>

	<div id="s2_explain">
		<p>Flyers get lost and emails get ignored. Nothing gets through to parents better than immediate notifications on their  mobile phones.
	</div>

</div>

<div class="slide" id="s4">
	<div id="price_plan">

	<div id="desc_price">
	The Backpack App is and always will be free for parents and teachers to use!<br> Start sending school wide messages for as low as 15 cents per student!
	</div>	

	<table>
	<tr style="font-weight: bold; 
		background-color: #5200A3; color:white;">
		<td>Service</td>
		<td>Price per Student</td>
		<td>Notification Type</td>
		<td>Monthly Limit</td>
		<td>Monthly Max Price</td>
	</tr>
	<tr>
		<td>The Backpack App</td>
		<td>FREE</td>
		<td>none</td>
		<td>na</td>
		<td>na</td>
	</tr>
	<tr>
		<td style="font-weight:bold">Standard</td>
		<td>$0.15</td>
		<td>School wide messages</td>
		<td>2</td>
		<td>$89.99</td>
	</tr>
	<tr>
		<td style="font-weight:bold">Directed</td>
		<td>$0.39</td>
		<td>School wide and grade specific messages</td>
		<td>5</td>
		<td>$249.99</td>	
	</tr>
	<tr>
		<td style="font-weight:bold">Directed+</td>
		<td>$0.59</td>
		<td>School wide and grade specific messages</td>
		<td>10</td>
		<td>$349.99</td>	
	</tr>
	</table>
	</div>
</div>

<div class="slide" id="s5">

	<form name="new_user" id="new_user" method="post" action="<?=$_SERVER['PHP_SELF']?>">

	<div id="form_cover">
	</div>

	<span id="h_sign">Get Signed Up</span><br>
	<div id="sh_sign">We'll notify your school when our service is up!</div><br>

	<input class="tb" id="name" type="text" name="name" 
		autocomplete="on" value="School name" 
		onclick="this.select();" maxlength="25" >
	<br>
	<input class="tb" id="city" type="text" name="city" 
		autocomplete="on" value="City" 
		onclick="this.select();" maxlength="25" >
	<br>
	 <select class="tb" id="state" name="state">
		<option value="State">State</option>
		<option value="Florida">Florida</option>
		<option value="Georgia">Georgia</option>
	</select>
	<br> 
	<input class="tb" id="new_email" 
		type="text" name="new_email" 
		autocomplete="on" value="Administrator email" 
		onclick="this.select();" maxlength="254" >
	<br> 
	<input class="tb" id="re_email" 
		type="text" name="re_email" 
		autocomplete="on" value="Re-enter email" 
		onclick="this.select();" maxlength="254" >
	<br> 
	<input class="tb" id="new_password" type="text"
		name="new_password" autocomplete="off" 
		value="New password" onclick="this.select();"
		maxlength="15" >
	<br>
	<input id="sign_up" name="submitok" type="submit"  value="Sign Up" />

	<span id="new_user_error"></span>

</form>

	<div id="center_links">
	<div id="links">
		<ul>
			<li>
			<a href="school_pricing.html">schools</a>
			</li>
			<li>
			<a href="careers.html">careers</a>
			</li>
			<li>
			<a href="about.html">about us</a>
			</li>
			<li>
			<a href="contact.php">contact us</a>
			</li>
		</ul>
	</div>
	</div>
</div>

</div> <!-- end of slides -->
</body>
</html>

<?php
	
else:
	// Process signup submission
	dbConnect('The_Backpack_App');

	if ($_POST['name']=='' or $_POST['city']==''
		or $_POST['new_email']=='' or $_POST['new_password']==''
		or $_POST['re_email']=='' 
		or $_POST['name']=='School name' 
		or $_POST['city']=='City'
		or $_POST['state']=='State'  
		or $_POST['new_email']=='Administrator email' 
		or $_POST['new_password']=='New Password' 
		or $_POST['re_email']=='Re-enter email')	{

		error('One or more required fields were left blank.\n'.
		'Please fill them in and try again.');
	}

	if ($_POST['new_email']!=$_POST['re_email'])	{

		error('Emails do not match\n'.
		'Please ensure the email you entered is correct');
	}

	if ( strpos($_POST['new_email'], '@') === false )
	{
		error('Invalid email entered\n'.
		'Please ensure the email you entered is correct');
	}
	
	// Check for existing user with the new id
	$sql = "SELECT COUNT(*) FROM schools WHERE name = '$_POST[name]' AND city = '$_POST[city]'";
	$result = mysql_query($sql);
	if (!$result) {
	error('A database error occurred in processing your '.
	'submission.\nIf this error persists, please '.
	'contact lukas@gmail.com.');
	}
	if (@mysql_result($result,0,0)>0) {
	error('An account is already associated with that school');
	}

	 $sql = "INSERT INTO schools SET
	name = '$_POST[name]',
	city = '$_POST[city]',
	state = '$_POST[state]',
	email = '$_POST[new_email]',
	password = '$_POST[new_password]'";

	if (!mysql_query($sql))
	error('A database error occurred in processing your '.
	'submission.\nIf this error persists, please '.
	'contact lukascarvajal@gmail.com.');
?>

<!DOCTYPE>
<head>
	<title>Backpack - Check Email</title>
	<link rel="stylesheet" href="basic_school_style.css"/>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

</head> 

<html>
<body>

<div id="new_user">
	<div id="new_user_paper">
		<a href="index.html"><img id="new_user_logo" src="img/backpack.png" alt="logo" /></a>

		<p style="font-weight: bold;">We'll let you know soon!</p>
		<p>We're working hard to build the best notification system for your school. We'll email you as soon as our service is ready! </p>
		<p style="font-size: 20px;">- The Backpack App Team</p>
	</div>
</div>

</body>
</html>

<?php
endif;
?>

