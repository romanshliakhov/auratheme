<!DOCTYPE html>
<html lang="en" class="fixed-block">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="Description" content="<?php bloginfo('description'); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); ?></title>

	<?php load_template( get_template_directory() . '/helpers/fonts.php', true );?>
    <?php wp_head();?>

</head>

<body <?php body_class(); ?>>
    <?php load_template( get_template_directory() . '/components/custom_header.php', true );?>
<main>
