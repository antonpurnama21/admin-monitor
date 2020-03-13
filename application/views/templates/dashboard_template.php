<!doctype html>
<html class="fixed sidebar-left-big-icons">
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
        <!-- CSS PAGE -->
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/animate/animate.css">
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
        
        <!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/select2/css/select2.css" />
		<link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/select2-bootstrap-theme/select2-bootstrap.min.css" />
        
        <link rel="stylesheet" href="<?=base_url('source/assets/vendor')?>/pnotify/pnotify.custom.css" />
        <?php if(isset($_CSS) and !empty($_CSS)) echo $_CSS; ?>

        <!-- CSS Base -->
		<link rel="stylesheet" href="<?=base_url('source/assets/css')?>/theme.css" />
        <link rel="stylesheet" href="<?=base_url('source/assets/css')?>/skins/default.css" />
        <link rel="stylesheet" href="<?=base_url('source/assets/css')?>/icons/icomoon/styles.css">
        <link rel="stylesheet" href="<?=base_url('source/assets/css')?>/custom.css">

        <!-- Head Libs -->
		<script src="<?=base_url('source/assets/vendor/')?>modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			
			<?php $this->load->view('partials/partial-header')?>
			
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php $this->load->view('partials/partial-sidebar')?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2><?=$breadcrumb[1]?></h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<!-- <li>
									<a href="<?=base_url()?>">
										<i class="fas fa-home"></i>
									</a>
								</li> -->
								<li><span><?=$breadcrumb[0]?></span></li>
								<li><span><?=$breadcrumb[1]?></span></li>
							</ol>
					
							<a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<?=$body?>
					<!-- end: page -->
				</section>
			</div>

			<div id="showModal"></div>
            
        </section>
        <!-- JS PAGE -->
        <!-- JS Vendor -->
        
		<script src="<?=base_url('source/assets/vendor')?>/jquery/jquery.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/popper/umd/popper.min.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/bootstrap/js/bootstrap.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/common/common.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/nanoscroller/nanoscroller.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/magnific-popup/jquery.magnific-popup.js"></script>
        <script src="<?=base_url('source/assets/vendor')?>/jquery-placeholder/jquery.placeholder.js"></script>
        
        <!-- Specific Page Vendor -->
		<script src="<?=base_url('source/assets/vendor')?>/jquery-ui/jquery-ui.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/jquery-appear/jquery.appear.js"></script>
		<script src="<?=base_url('source/assets/vendor')?>/select2/js/select2.js"></script>
        
        
        <!-- JS Page -->
        <script src="<?=base_url('source/assets/vendor')?>/pnotify/pnotify.custom.js"></script>
		<script src="<?=base_url('source/assets/js')?>/pages/notifications.js"></script>
		<?php if(isset($_JS) and !empty($_JS)) echo $_JS; ?>		
		<!-- JS Base -->
		<script src="<?=base_url('source/assets/js')?>/theme.js"></script>
		<script src="<?=base_url('source/assets/js')?>/custom.js"></script>
		<script src="<?=base_url('source/assets/js')?>/theme.init.js"></script>

    </body>
    <script>
		<?php if(has_alert()):?>
		<?php foreach(has_alert() as $key => $message):
			if ($key == 'Error') { $head = 'Error'; } elseif ($key == 'info') { $head = 'Information'; } elseif ($key == 'success') { $head = 'Success'; } else { $head = 'Warning'; }
		?>
			notif('<?= $head ?>','<?= $message ?>','<?= $key ?>');
		<?php endforeach; ?>
		<?php endif; ?>
	</script>
</html>