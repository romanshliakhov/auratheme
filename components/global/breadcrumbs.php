<?php
function get_breadcrumbs() {
    $text['home']     = 'Головна'; // Главная страница
    $text['granite']  = 'Гранітні вироби'; // Ссылка на статическую страницу
    $text['catalog']  = 'Каталог'; // Ссылка на страницу каталога
    $text['404']      = 'Сторінка не знайдена'; // Страница 404

    $show_current   = 1; // Показать текущий элемент
    $show_on_home   = 0; // Показать хлебные крошки на главной странице
    $show_home_link = 1; // Показать ссылку на главную страницу
    $delimiter      = ' <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.620616 0.0219373C0.626085 0.0242038 0.631366 0.0268481 0.636647 0.0296813C0.645888 0.0345922 0.654752 0.0400697 0.663427 0.0461139C0.677195 0.0557468 0.691151 0.0651908 0.705107 0.0744459C0.760742 0.112033 0.816944 0.148865 0.871259 0.18834C0.913882 0.219317 0.955561 0.251615 0.994412 0.287125C2.88451 2.00725 4.77254 3.72965 6.65774 5.45526C6.77561 5.5633 6.90273 5.68682 6.96006 5.82962C7.05059 6.05476 6.98382 6.26858 6.79429 6.44102C5.5092 7.61038 4.22675 8.78276 2.94336 9.95419C2.26724 10.5714 1.58981 11.1874 0.915768 11.8069C0.767155 11.9435 0.606471 12.0339 0.400337 11.9879C0.206838 11.9446 0.0742553 11.8232 0.0206942 11.6309C-0.0343757 11.4331 0.0220143 11.2601 0.171382 11.1213C0.414104 10.8959 0.659467 10.6736 0.904075 10.4504C2.50676 8.9875 4.10963 7.52463 5.71269 6.06232C5.72966 6.04683 5.7523 6.03776 5.78266 6.01944C5.56898 5.82376 5.37473 5.64546 5.17991 5.46772C3.54007 3.97066 1.90665 2.46623 0.254552 0.982392C0.184961 0.920061 0.124987 0.846209 0.0816105 0.763291C0.0427598 0.689061 0.0172995 0.607087 0.0127732 0.523036C0.00843547 0.443517 0.0235231 0.363432 0.0586018 0.292036C0.0968867 0.213839 0.157614 0.149053 0.228715 0.0997558C0.316034 0.0389365 0.419196 -0.00658361 0.52745 0.000782709C0.544801 0.00191599 0.562151 0.00456031 0.579125 0.00852679C0.593458 0.0119266 0.607226 0.0162709 0.620427 0.0219373H0.620616Z" />
                        </svg> '; // Разделитель
    $before         = '<span class="breadcrumbs__current">'; // Оформление текущей ссылки
    $after          = '</span>';

    global $post;
    $home_link = home_url('/');
    $granite_url = home_url('/granitni_viroby/'); // URL статической страницы "Гранітні вироби"
    $catalog_url = home_url('/catalog/'); // URL статической страницы "Каталог"
    $link_attr = ' class="breadcrumbs__prev"';
    $link      = '<a' . $link_attr . ' href="%1$s">%2$s</a>';

    if (is_home() || is_front_page()) {
        if ($show_on_home) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
    } else {
        echo '<div class="breadcrumbs">';
        if ($show_home_link) {
            echo sprintf($link, $home_link, $text['home']);
            echo $delimiter;
        }

        if (is_singular('granites')) {
            // Хлебные крошки для "Гранітні вироби"
            echo sprintf($link, $granite_url, $text['granite']);
            echo $delimiter;

            $terms = get_the_terms($post->ID, 'granites_category');
            if ($terms && !is_wp_error($terms)) {
                $term = current($terms);
                echo sprintf($link, get_term_link($term), $term->name);
                echo $delimiter;
            }

            if ($show_current) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_singular('monuments')) {
            // Хлебные крошки для "Памʼятники"
            echo sprintf($link, $catalog_url, $text['catalog']);
            echo $delimiter;

            $terms = get_the_terms($post->ID, 'monuments_category');
            if ($terms && !is_wp_error($terms)) {
                $term = current($terms);
                echo sprintf($link, get_term_link($term), $term->name);
                echo $delimiter;
            }

            if ($show_current) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_tax('granites_category') || is_tax('monuments_category')) {
            // Хлебные крошки для таксономий
            $current_term = get_queried_object();
            if (is_tax('granites_category')) {
                echo sprintf($link, $granite_url, $text['granite']);
            } else {
                echo sprintf($link, $catalog_url, $text['catalog']);
            }
            echo $delimiter;

            if ($current_term->parent) {
                echo get_category_parents($current_term->parent, true, $delimiter);
            }
            echo $before . single_term_title('', false) . $after;
        } elseif (is_single()) {
            // Хлебные крошки для стандартных постов
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0];
                $category_link = apply_filters('term_link', get_category_link($category->term_id), $category, 'category');
                $category_name = $category->name;
                echo sprintf($link, $category_link, esc_html($category_name));
                echo $delimiter;
            }

            if ($show_current) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_category()) {
            // Хлебные крошки для категории
            $category = get_category(get_query_var('cat'));
            if ($category->parent) {
                echo get_category_parents($category->parent, true, $delimiter);
            }
            echo $before . single_cat_title('', false) . $after;
        } elseif (is_page() && !$post->post_parent) {
            // Одиночная страница
            if ($show_current) echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            // Страница с родительской
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb . $delimiter;
            }
            if ($show_current) echo $before . get_the_title() . $after;
        } elseif (is_404()) {
            echo $before . $text['404'] . $after;
        }

        echo '</div>';
    }
}