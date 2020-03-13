<header class="header">
<div class="logo-container">
    <a href="" class="logo">
        <img src="<?=base_url('source/assets/img')?>/logo-dash.png" width="75" height="35" alt="DENS" />
    </a>
    <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
        <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
    </div>
</div>

<!-- start: search & user box -->
<div class="header-right">

    <form action="pages-search-results.html" class="search nav-form">
        <div class="input-group">
            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
            <span class="input-group-append">
                <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
            </span>
        </div>
    </form>

    <span class="separator"></span>

    <!-- notification -->
    <ul class="notifications">
        <li>
            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fas fa-bell"></i>
                <span class="badge"></span>
            </a>
    
            <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                    <span class="float-right badge badge-default"></span>
                    Alerts
                </div>
    
                <div class="content">
                    <ul>
                        <li>
                            <a href="#" class="clearfix">
                                <div class="image">
                                    <i class="fas fa-thumbs-down bg-danger text-light"></i>
                                </div>
                                <span class="title">Server is Down!</span>
                                <span class="message">Just now</span>
                            </a>
                        </li>
    
                    <hr />
    
                    <div class="text-right">
                        <a href="#" class="view-more">View All</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <!-- notification -->

    <span class="separator"></span>

    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
                <img src="<?=base_url('source/assets/img')?>/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
            </figure>
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                <span class="name"><?=$sesi['firstname']?></span>
                <span class="role"><?=role_name($sesi['role'])?></span>
            </div>

            <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled mb-2">
                <li class="divider"></li>
                <li>
                    <a role="menuitem" tabindex="-1" href="#"><i class="fas fa-user"></i> My Profile</a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="<?=base_url('auth/logout')?>"><i class="fas fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</header>