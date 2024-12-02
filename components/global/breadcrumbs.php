<?php
function get_breadcrumbs() {
    $text['home']     = 'Головна';
    $text['category'] = __('Archive', 'wayup') . ' "%s"';
    $text['search']   = __('Search results', 'wayup') . ' "%s"';
    $text['tag']      = __('Позначка', 'wayup') . ' "%s"';
    $text['author']   = __('Author', 'wayup') . ' %s';
    $text['404']      = __('Сторінка не знайдена');
    
    $show_current   = 1; // Показывать текущую страницу
    $show_on_home   = 0; // Показывать хлебные крошки на главной
    $show_home_link = 1; // Показывать ссылку на главную
    $show_title     = 1; // Показывать заголовки
    $delimiter      = ''; // Разделитель между уровнями
    $before         = '<span class="breadcrumbs__current">';
    $after          = '</span>';
    
    global $post;
    $home_link = home_url('/');
    $link_attr = ' class="breadcrumbs__prev"';
    $link      = '<a' . $link_attr . ' href="%1$s">%2$s</a>';
    
    if ($post) {
        $parent_id = $parent_id_2 = $post->post_parent;
    } else {
        $parent_id = $parent_id_2 = '';
    }

    $frontpage_id = get_option('page_on_front');

    if (is_home() || is_front_page()) {
        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
    } else {
        echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
        if ($show_home_link == 1) {
            echo sprintf($link, $home_link, $text['home']);
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
        }

        if (is_category()) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                $cats = str_replace('/category/', '/', $cats); // Убираем /category/
                echo $cats;
            }
            if ($show_current == 1) echo $before . single_cat_title('', false) . $after;

        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() == 'product') {
                $post_type = get_post_type_object(get_post_type());
                printf($link, get_permalink(wc_get_page_id('shop')), 'Products');
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif (get_post_type() == 'blog') {
                printf($link, '/blog/', 'Blog');
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                printf($link, $home_link . '/' . $post_type->rewrite['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

            } else {
                $cat = get_the_category();
                if (!empty($cat)) {
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    $cats = str_replace('/category/', '/', $cats); // Убираем /category/
                    echo $cats;
                }
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }

        } elseif (is_tag()) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif (is_404()) {
            echo $before . $text['404'] . $after;

        } elseif (is_search()) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif (is_day()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif (is_month()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;

        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif (is_page() && !$parent_id) {
            if ($show_current == 1) echo $before . get_the_title() . $after;

        } elseif (is_page() && $parent_id) {
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                if ($parent_id != $frontpage_id) {
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                }
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1) echo $delimiter;
            }
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
        }

        if (get_query_var('paged')) {
            echo $delimiter . __('Page', 'wayup') . ' ' . get_query_var('paged');
        }

        echo '</div>';
    }
}
?>
