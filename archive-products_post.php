<?php
	/* Template Name: Гранітні Вироби */
	$build_folder = get_template_directory_uri() . '/assets/';

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$is_mobile = preg_match('/Mobile|Android|BlackBerry|iPhone|Windows Phone/', $user_agent);
	$posts_per_page = -1;

	$blog_posts = new WP_Query( array(
		'post_type'      => 'products_post',
		'posts_per_page' => $posts_per_page,
		'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1
	) );

	$total_pages = $blog_posts->max_num_pages;
    $paged = 1;

	get_header();
?>

<section class="blog-section">
    <div class="container">
		<?php get_breadcrumbs() ?>

		<div class="blog-section__wrapp">
			<h1>Гранітні Вироби</h1>

			<?php if ( $blog_posts->have_posts() ) : ?>
				<ul class="blog-section__posts">
					<?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
						<li class="blog-list__item">
							<div class="blog-card">
								<div class="blog-card__thumbnail">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
									<?php endif; ?>
								</div>
								
								<div class="blog-card__info">
									<span class="pretitle"><?php the_title(); ?></span>

									<?php if ( has_excerpt() ) : ?>
										<p class="blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
									<?php endif; ?>

									<a href="<?php the_permalink() ?>">Читать далее</a>
								</div>
							</div>
						</li>
					<?php endwhile; ?>

				</ul>

				<?php
					wp_reset_postdata();
				?>

			<?php else : ?>
				<p>Записів не знайдено</p>
			<?php endif; ?>
		</div>
    </div>
</section>

<?php get_footer(); ?>