<?php
    $build_folder = get_template_directory_uri() . '/assets/';
    $shower = get_sub_field('shower');
    $title = get_sub_field('title');

    if (!$shower): ?>
        <section class="categories-section">
            <div class="container">
                <?php display_main_top_section('h2', $title); ?>
            </div>

            <?php
                // Получаем категории таксономии monuments_category
                $categories = get_terms(array(
                    'taxonomy'   => 'monuments_category',
                    'hide_empty' => false,
                ));

                if (!empty($categories) && !is_wp_error($categories)): ?>
                    <div class="categories-section__slider">
                        <div class="container container--max">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($categories as $category):
                                        // Получаем изображение для категории
                                        $image = get_field('image', 'term_' . $category->term_id); ?>
                                        <li class="swiper-slide">
                                            <a class="categories-card" href="<?php echo get_term_link($category); ?>">
                                                <div class="categories-card__image">
                                                    <?php if ($image): ?>
                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" alt="Placeholder" />
                                                    <?php endif; ?>
                                                </div>
                                                <span class="categories-card__title">
                                                    <?php echo esc_html($category->name); ?>
                                                </span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>

                                    <?php foreach ($categories as $category):
                                        // Получаем изображение для категории
                                        $image = get_field('image', 'term_' . $category->term_id); ?>
                                        <li class="swiper-slide">
                                            <a class="categories-card" href="<?php echo get_term_link($category); ?>">
                                                <div class="categories-card__image">
                                                    <?php if ($image): ?>
                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>" alt="Placeholder" />
                                                    <?php endif; ?>
                                                </div>
                                                <span class="categories-card__title">
                                                    <?php echo esc_html($category->name); ?>
                                                </span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        
                        </div>

                        <button class="swiper-button prev">
                            <?php sprite(32, 54, 'arrow-left'); ?>
                        </button>
                        <button class="swiper-button next">
                            <?php sprite(32, 54, 'arrow-right'); ?>
                        </button>
                    </div>
                <?php endif; 
            ?>
        </section>
    <?php endif; ?>
