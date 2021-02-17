<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        switch($this->var['view_name']){
            case 'shop':{
                echo "SpaceShop";
                break;
            }
            case 'product':{
                echo $this->var['product']['name'];
                break;
            }
            case '404':{
                echo "404 Not Found";
                break;
            }
            default:{
                echo ucfirst($this->var['view_name']);
                break;
            }
        }?></title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/fontawesome-pro-5.13.0-web/css/all.min.css">
    <?= $this->var['view_name'] == 'shop' ? '    
    <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.css">' : "" ?>
    <?php if($this->var['view_name'] != '404' || $this->var['view_name'] != 'register'):?>
    <link rel="stylesheet" type="text/css" href="/css/<?= $this->var['view_name'].".css"?>">
    <?php endif;?>
    <?php if($this->var['view_name'] == 'register'):?>
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <?php endif;?>
    <link rel="shortcut icon" href="/img/fav.png" type="image/x-icon">
    </head>
<body>
    <nav>
        <ul id="top-nav-menu">
            <li class="top-nav-menu-item"  id="hamburger-menu">
                <input id="menu-toggle" type="checkbox" />
                <label class="menu-btn" for="menu-toggle">
                    <span></span>
                </label>
                <ul id="menu-box">
                    <li class="menu-item">
                        <a href="/">Home</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://blog.c44787a9.beget.tech">Blog</a>
                    </li>
                    <li class="menu-item">
                        <a href="/about">About</a>
                    </li>
                    <li class="menu-item">
                        <a href="/contacts">Contacts</a>
                    </li>
                </ul>
            </li>
            <li class="top-nav-menu-item"<?= $this->var['view_name'] == 'shop' ? 'id="actual-page"' : "" ?>>
                <a href="/">Home</a>
            </li>
            <li class="top-nav-menu-item">
                <a href="http://blog.c44787a9.beget.tech/">Blog</a>
            </li>
            <li class="top-nav-menu-item"<?= $this->var['view_name'] == 'about' ? 'id="actual-page"' : "" ?>>
                <a href="/about">About</a>
            </li>
            <li class="top-nav-menu-item"<?= $this->var['view_name'] == 'contacts' ? 'id="actual-page"' : "" ?>>
                <a href="/contacts">Contacts</a>
            </li>
            <li class="top-nav-menu-item" id="search">
                <button class="search-button"><i class="fal fa-search fa-2x"></i></button>
            </li>
            <li class="top-nav-menu-item" id="shopping-cart">
                <button id="open-shopping-cart"><i class="fal fa-shopping-cart fa-2x"></i></button>
            </li>
            <li class='top-nav-menu-item login' id='login'>
                <button><i class='<?= isset($_SESSION['token']) ? 'fas' : 'fal'?> fa-user'></i></button>
                <div id="user-modal" class="disactive-modal">
                    <?= isset($_SESSION['token']) ? '<a href="/cabinet">Cabinet</a><a href="/logout">Logout</a>' : '<a href="/login">Login</a>' ?>
                </div>
            </li>
        </ul>
    </nav>