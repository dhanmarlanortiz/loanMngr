<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $home = site_url();
    $clients = site_url('main');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>loanMngr | <?php echo $title; ?></title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" >
        <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">loanMNGR</a>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?=$home?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$clients?>">Clients</a>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <h2><?php echo $title; ?></h2>
                    <hr>
                </div>
            </div>
        </div>
