
<nav class="navbar navbar-default menu-bar">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand visible-xs" href="#">Menu</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav menu-group">
                <li class="menu-list active"><a href="<?php echo site_url('home'); ?>">Home</a></li>
                <li class="menu-list"><a href="#">Clients</a></li>
                <li class="menu-list"><a href="#">Loans</a></li>
                <li class="menu-list"><a href="#">Link3</a></li>
                
            </ul>
            <ul class="nav navbar-nav navbar-right menu-group">
                <li class="menu-list"><a href="<?php echo site_url('user/logout'); ?>">Logout</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right menu-group">
                <li class="menu-list">
                    <a href="<?php echo site_url('user/user_accounts'); ?>"> Welcome <?php echo $this->session->userdata('uname'); ?>! </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

