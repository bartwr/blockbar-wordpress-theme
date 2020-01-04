<!DOCTYPE html>
<html lang="nl">

  <head>
    <title>Blockbar | Open Blockchain Lab The Hague</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php wp_head();?>

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/style.css?3" />

    <link href="/img/favicon/favicon.png" rel="shortcut icon" type="image/x-icon" />

  </head>
  <body <?php body_class(); ?>>

    <wrapper>

      <nav class="main-nav">
        <ul id="menu-nav">
          <?php wp_nav_menu(); ?>
        </ul>
      </nav>

      <a href="/" class="logo">
        <img src="<?php bloginfo('template_directory');?>/img/logo/blockbar.jpg" alt="Blockbar logo" />
      </a>

      <div class="content">
