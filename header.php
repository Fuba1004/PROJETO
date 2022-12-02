<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UniFrutas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
    <!-- bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="themes/css/bootstrappage.css" rel="stylesheet" />

    <!-- global styles -->
    <link href="themes/css/flexslider.css" rel="stylesheet" />
    <link href="themes/css/main.css" rel="stylesheet" />

    <!-- scripts -->
    <script src="themes/js/jquery-1.7.2.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="themes/js/superfish.js"></script>
    <script src="themes/js/jquery.scrolltotop.js"></script>
    <!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
</head>

<body>
    <div id="top-bar" class="container">
        <div class="row">
            <div class="span4">
                <form method="GET" action="/produtos">
                    <input type="text" name="busca" class="input-block-level search-query" Placeholder="Busca" <?php if(isset($_GET["busca"]) && $_GET["busca"] != "") {echo'value="'.$_GET["busca"].'"';} ?>>
                </form>
            </div>
            <div class="span8">
                <div class="account pull-right">
                    <ul class="user-menu">
                        <li><a href="/">Home</a></li>
                        <li><a href="/produtos">Categorias</a></li>
                        <li><a href="/carrinho">Carrinho <span><?php echo count($_SESSION["carrinho"]) ?></span></a></li>
                        <?php
                        if (isset($_SESSION["usuario"])) {
                            echo '<li><a href="/minhaconta">Minha conta</a><a href="/sair" style="margin-left: 18px;color: #fd4004;">Sair</a></li>';
                        } else {
                            echo '<li><a href="login">Login</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper" class="container">
        <section class="navbar main-menu">
            <div class="navbar-inner main-menu">
                <a href="/" class="logo pull-left"><img src="themes/<?php echo $SYS["data"]["empresa"]["empresaLogo"] ?>" class="site_logo" alt=""></a>
                <nav id="menu" class="pull-right">
                    <ul>
                        <?php

                        for ($i = 0; $i < count($SYS["data"]["categorias"]); $i++) {
                            echo '<li><a href="./produtos?categoria='.$SYS["data"]["categorias"][$i]["categoriaPermalink"].'">' . $SYS["data"]["categorias"][$i]["categoriaNome"] . '</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </section>