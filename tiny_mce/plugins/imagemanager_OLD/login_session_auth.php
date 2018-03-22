<?php
	// Some settings
	session_start(); 
	// Some settings
	$sesid = $_SESSION['sesid'];
	$podkor = $_SESSION['podacikorisnik'][$sesid][podacilink];
	$podkorun = $_SESSION['podacikorisnik'][$sesid][podaciusername];
	
	$msg = "";
	$username = "$podkorun";
	$password = "d"; // Change the password to something suitable

   if (!$password)
		$msg = 'You must set a password in the file "login_session_auth.php" inorder to login using this page or reconfigure it the authenticator config options to fit your needs. Consult the <a href="http://wiki.moxiecode.com/index.php/Main_Page" target="_blank">Wiki</a> for more details.';

	if (isset($_POST['submit_button'])) {
		// If password match, then set login
		//if ($_POST['login'] == $podkorun) {
		// if ($_POST['login'] == $username && $_POST['password'] == $password && $password) {
			if (1==1) {
			// Set session
			session_start();
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['FileManager_UserName'] = $podkor;

			// Override any config option
			//$_SESSION['imagemanager.filesystem.rootpath'] = 'some path';
			//$_SESSION['filemanager.filesystem.rootpath'] = 'some path';

			// Redirect
			header("location: " . $_POST['return_url']);
			die;
		} else
			$msg = "Wrong username/password.";
	}
?>

<html>
<head>
<title>Sample login page</title>
<style>
body { font-family: Arial, Verdana; font-size: 11px; }
fieldset { display: block; width: 170px; }
legend { font-weight: bold; }
label { display: block; }
div { margin-bottom: 10px; }
div.last { margin: 0; }
div.container { position: absolute; top: 50%; left: 50%; margin: -100px 0 0 -85px; }
h1 { font-size: 14px; }
.button { border: 1px solid gray; font-family: Arial, Verdana; font-size: 11px; }
.error { color: red; margin: 0; margin-top: 10px; }
</style>
</head>
<body>

<div class="container">
	<form action="login_session_auth.php" method="post">
		<input type="hidden" name="return_url" value="<?php echo isset($_REQUEST['return_url']) ? htmlentities($_REQUEST['return_url']) : ""; ?>" />

		<fieldset>
			<legend>Ona portal login</legend>

			<div>
				<label>Username:</label>
				<input type="text" name="login" class="text" value="<?php echo isset($podkorun) ? $podkorun : ""; ?>" />
			</div>

			<div>
				<label>Password:</label>
				<input type="password" name="password" class="text" value="<?php echo isset($_POST['password']) ? htmlentities($_POST['password']) : ""; ?>" />
			</div>

			<div class="last">
				<input type="submit" name="submit_button" value="Login" class="button" />
			</div>

<?php if ($msg) { ?>
			<div class="error">
				<?php echo $msg; ?>
			</div>
<?php } ?>
		</fieldset>
	</form>
</div>

</body>
</html>
