<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">
		<title><?=$titleWeb?></title>

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        
        <!-- CSS Scope -->
        <!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor/')?>bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor/')?>animate/animate.css">
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor/')?>font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor/')?>magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor/')?>bootstrap-datepicker/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor/')?>jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor/')?>jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/pnotify/pnotify.custom.css" />
		<?php if(isset($_CSS) and !empty($_CSS)) echo $_CSS; ?>

		<!-- base CSS -->
		<link rel="stylesheet" href="<?=base_url('source/assets/css/')?>theme.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/css/')?>skins/default.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/css')?>/icons/icomoon/styles.css">
		<link rel="stylesheet" href="<?=base_url('source/assets/css/')?>custom.css">

		<!-- Head Libs -->
		<script src="<?=base_url('source/assets/vendor/')?>modernizr/modernizr.js"></script>

        <!-- JS Scope -->
        <!-- Vendor -->
		<script src="<?=base_url('source/assets/vendor/')?>jquery/jquery.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>popper/umd/popper.min.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>bootstrap/js/bootstrap.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>common/common.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>nanoscroller/nanoscroller.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>magnific-popup/jquery.magnific-popup.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>jquery-placeholder/jquery.placeholder.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>jquery-validation/jquery.validate.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>jquery-ui/jquery-ui.js"></script>
		<script src="<?=base_url('source/assets/vendor/')?>jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/pnotify/pnotify.custom.js"></script>
		
		<!-- JS Page -->
		<script src="<?=base_url('source/assets/vendor/')?>jquery-appear/jquery.appear.js"></script>
		<script src="<?=base_url('source/assets/js')?>/pages/notifications.js"></script>
		<?php if(isset($_JS) and !empty($_JS)) echo $_JS; ?>

		<!-- JS Base -->
		<script src="<?=base_url('source/assets/js/')?>theme.js"></script>
		<script src="<?=base_url('source/assets/js/')?>custom.js"></script>
		<script src="<?=base_url('source/assets/js/')?>theme.init.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<!-- <a href="/" class="logo float-left">
					<img src="img/logo-dash.png" height="54" alt="Porto Admin" />
				</a> -->

				<div class="panel card-sign appear-animation" data-appear-animation="flipInY" data-appear-animation-delay="0" data-appear-animation-duration="1s">
					<div class="mt-3 text-center">
						<h1 style="font-family: Impact, Charcoal, sans-serif; font-size: 50px;">LOGIN TO DASHBOARD</h1>
						<h4>ADMINISTRATOR</h4>
					</div>
					<div class="card-body">
						<?php echo form_open('auth/do_login',array('id'=>'form-login')); ?>
							<div class="form-group mb-3">
								<label>Email</label>
								<div class="input-group">
									<input name="login_email" id="login_email" value="<?php if(isset($_COOKIE['login_email'])) { echo $_COOKIE['login_email']; } ?>" type="email" class="form-control" required />
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="clearfix">
									<label class="float-left">Password</label>
									<a href="<?=base_url('auth/forgot')?>" class="float-right">Lost Password?</a>
								</div>
								<div class="input-group">
									<input name="login_password" id="login_password" value="<?php if(isset($_COOKIE['login_password'])) { echo $_COOKIE['login_password']; } ?>" type="password" class="form-control" required/>
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" <?php if(isset($_COOKIE['login_email'])) { echo "checked"; } ?> type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary mt-2">Sign In</button>
								</div>
							</div>

							<?php echo form_close(); ?>
					</div>
				</div>

				<p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2020. Dens.TV.</p>
			</div>
		</section>
		<!-- end: page -->
	</body>
	<script>
		<?php if(has_alert()):?>
		<?php foreach(has_alert() as $key => $message):
			if ($key == 'error') { $head = 'Error'; } elseif ($key == 'info') { $head = 'Information'; } elseif ($key == 'success') { $head = 'Success'; } else { $head = 'Warning'; }
		?>
			notif('<?= $head ?>','<?= $message ?>','<?= $key ?>');
		<?php endforeach; ?>
		<?php endif; ?>
	</script>
</html>