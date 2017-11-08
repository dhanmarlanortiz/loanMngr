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
            <?php 
                echo $navbar_left;
            ?>
            <ul class="nav navbar-nav navbar-right menu-group">
                <li class="menu-list"><a href="<?php echo site_url('user/logout'); ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class='col-sm-12'>
                <?php 
                    if(isset($breadcrumbs)) {
                        echo $breadcrumbs; 
                    }
                ?>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-6 col-md-4'>
            <h3 class="section-title">
                <?php 
                    if(isset($form_header)) {
                        echo $form_header; 
                    }
                ?>
            </h3>
            <?php
                if(isset($form)) {
                    echo $form;
                    echo validation_errors();
                    if(isset($create_alert)) {
                        echo $create_alert;
                    }else if(null !== $this->input->get('create_alert')) {
                        echo $this->input->get('create_alert');
                    }
                }
            ?>
        </div>
        <div class="col-sm-6 col-md-8">
            <h3 class="section-title">
                <?php 
                    if(isset($table_header)) {
                        echo $table_header; 
                    }
                ?>
            </h3>
                <?php
                    if(isset($table)) {
                        echo $table;
                    }
                ?>
        </div>
    </div>
</div>

