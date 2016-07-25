<?php echo "<b>Dear</b> @".$username.","; ?>
<p><?php echo 'We got a request to reset your app password'; ?></p>
<p><?php echo "<b>Please click on the link below to reset your password.</b>"; ?></p>
<a href="http://<?= $_SERVER['HTTP_HOST']; ?>/users/reset_password_token/<?php echo $token; ?>">Click here to reset your account password</a>
<p><?php echo "<b>Alternatively</b>, you can also copy paste the below link into your browser"; ?></p>
<p>http://<?= $_SERVER['HTTP_HOST']; ?>/users/reset_password_token/<?php echo $token; ?>/</p>
<p><?php echo 'If you did not forget your password, please ignore this E-mail'; ?>
