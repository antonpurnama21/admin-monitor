<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."controllers/CommonDash.php");

class Dashboard extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}
    
	public function index()
	{
		$data = array(
				'_JS' => generate_js(array(
					'vendor/jquery-validation/jquery.validate.js',
					'js/pages/index-script.js',
				)
			),
			'titleWeb' 	=> 'Home | Administrator Monitoring Dashboard',
			'breadcrumb'=> explode(',', 'Dashboard, Main Page'),
			
		);
		$this->render('dashboard_template', 'pages/dashboard_admin', $data);
	}
}
