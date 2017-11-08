<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function breadcrumbs($list) { 
    $bread = "";
    $size = sizeof($list);
    
    $bread .= "<ol class='breadcrumb'>";
    for($i=0; $i<$size; $i++) {
        if ($i == $size-1){
            $bread .= "<li class='active'>".$list[$i]."</li>";
        }else {
            $bread .= "<li><a href='".site_url()."/".$list[$i]."'>".$list[$i]."</a></li>";
        }
        
    }
    $bread .= "</ol>";

    return $bread; 
}

function navbar_left($controller) {
    $menu = "";
    $item = array('home', 'clients', 'users');
    $size = sizeof($item);
    $menu .= "<ul class='nav navbar-nav menu-group'>";

    for ($i=0; $i < $size; $i++) { 
        if ($item[$i] == $controller){
            $menu .= "<li class='menu-list active'>";
        }else {
            $menu .= "<li class='menu-list'>";
        }

        $menu .= "<a href='".site_url()."/".$item[$i]."'>".$item[$i]."</a></li>";
    }
    $menu .= "</ul>";

    return $menu;
}
