<aside id="sidebar-left" class="sidebar-left">
				
	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle d-none" data-target="html" data-fire-event="sidebar-left-toggle">
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
			
				<ul class="nav nav-main">
					<li>
						<a class="nav-link active" href="<?=base_url()?>">
							<i class="fas fa-home" aria-hidden="true"></i>
							<span>Dashboard</span>
						</a>                        
					</li>
					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-list-alt" aria-hidden="true"></i>
							<span>Form Testcase</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="<?=base_url('testcase/add_form')?>">
									<span>Add New Form</span>
								</a>
							</li>
							<li>
								<a class="nav-link" href="<?=base_url('testcase/form_list')?>">
									<span>Form List</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-list-alt" aria-hidden="true"></i>
							<span>Checker Testcase</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" onclick="showModal2('<?= base_url('checker/modalAdd_splash') ?>', '', 'add');">
									<span>Add New Checker</span>
								</a>
							</li>
							<li>
								<a class="nav-link" href="<?=base_url('checker/checker_list')?>">
									<span>Checker List</span>
								</a>
							</li>
							
						</ul>
					</li>

					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-tools" aria-hidden="true"></i>
							<span>Master</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="<?=base_url('device')?>">
									<span>Device</span>
								</a>
							</li>
							<li>
								<a class="nav-link" href="<?=base_url('typecase')?>">
									<span>Type Testcase</span>
								</a>
							</li>
							<li>
								<a class="nav-link" href="<?=base_url('role')?>">
									<span>Role</span>
								</a>
							</li>
							<li>
								<a class="nav-link" href="<?=base_url('user')?>">
									<span>User</span>
								</a>
							</li>							
						</ul>
					</li>

				</ul>
			</nav>

			<hr class="separator" />

			<div class="sidebar-widget widget-tasks">
				<div class="widget-header">
					<h6>FrontEnd</h6>
					<div class="widget-toggle">+</div>
				</div>
				<div class="widget-content">
					<ul class="nav nav-main">
						<li><a href="#" target="_blank">Dashboard Monitor</a></li>
					</ul>
				</div>
			</div>
			
		</div>

		<script>
			// Maintain Scroll Position
			if (typeof localStorage !== 'undefined') {
				if (localStorage.getItem('sidebar-left-position') !== null) {
					var initialPosition = localStorage.getItem('sidebar-left-position'),
						sidebarLeft = document.querySelector('#sidebar-left .nano-content');
					
					sidebarLeft.scrollTop = initialPosition;
				}
			}
		</script>
		

	</div>

</aside>