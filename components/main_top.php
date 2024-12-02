<?php 
	$build_folder = get_template_directory_uri() . '/assets/'; 
?>

<?php function display_main_top_section($tagname = 'h1', $title = '', $text = '') { ?>
	<div class="main-top">
		<?php if ($title): ?>
			<<?php echo $tagname; ?> class="main-top__title">
				<?php sprite(29, 35, 'site-icon'); ?>

				<?php echo $title; ?>
			</<?php echo $tagname; ?>>
		<?php endif; ?>

		<?php if ($text): ?>
			<div class="main-top__text">
				<?php echo $text; ?>
			</div>
		<?php endif; ?>
	</div>
<?php } ?>