<?php get_header();
do_action('wp_single_nha_dat');
?>
    <div class="container single-nha-dat">
        <div class="main-single col-md-8">
            <div class="enigma_header_breadcrum_title">
                <div class="containers">
                    <div class="row">
                        <div class="uk-width-medium-1-1">

                            <!-- BreadCrumb -->
                            <?php if (function_exists('realty_single_breadcrumbs')) realty_single_breadcrumbs(); ?>
                            <!-- BreadCrumb -->
                            <h1><?php if (!is_home()) the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-1">
                <div class="row enigma_blog_wrapper">
                    <div class="uk-width-medium-1-1">
                        <?php if (have_posts()) : while (have_posts()) : the_post();
                            $author_id = $post->post_author;
                            $thongtinlienhe = get_post_meta($post->ID, 'contact_realty', true);
                            ?>
                            <div class="container-fluid">
                                <div class="image-slide uk-width-medium-2-3">
                                    <?php
                                    $galleryArray = get_post_gallery_ids($post->ID);
                                    $galleryString = get_post_gallery_ids($post->ID, 'string');
                                    if (!empty($galleryString)) {
                                        foreach ($galleryArray as &$id) {
                                            $src_slide = wp_get_attachment_url($id);
                                            $src_carousel = wp_get_attachment_image_src($id, array(150, 150), true);
                                            $galleryHTML_slide .= '<li>' . $button . '<img id="' . $id . '" src="' . $src_slide . '"></li> ';
                                            $galleryHTML_carousel .= '<li>' . $button . '<img id="' . $id . '" src="' . $src_carousel[0] . '"></li> ';
                                        }
                                    }


                                    ?>
                                    <!-- Place somewhere in the <body> of your page -->
                                    <div id="realty_slider" class="flexslider">
                                        <ul class="slides">
                                            <?php echo $galleryHTML_slide; ?>
                                        </ul>
                                    </div>
                                    <div id="realty_carousel" class="flexslider">
                                        <ul class="slides">
                                            <?php echo $galleryHTML_carousel; ?>
                                        </ul>
                                    </div>


                                </div>
                                <div class="contact-nha-dat uk-width-medium-1-3">
                                    <?php
                                    get_realty_part('single/information', '');
                                    ?>
                                </div>

                            </div>
                            <div class="container-fluid">
                                <div class="information-detail">
                                    <h3>Thông tin chi tiết</h3>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="contact">
                                    <fieldset>
                                        <legend>Thông tin liên hệ</legend>
                                        <!--<div class="col-md-4">
                                <!--<img src="<?php echo get_avatar(get_the_author_meta('ID'), $author_id); ?> " width="140" height="140" class="avatar" alt="<?php echo the_author_meta('display_name', $author_id); ?>" />
                            <?php // echo get_wp_user_avatar(get_the_author_meta('ID'), 'thumbnail'); ?>
                            </div> -->
                                        <div class="col-md-8">

                                            <div class="author_realty">
                                                <span class="label-realty">Tên: </span>
                                                <span class="label-content">
                                        <?php echo get_the_author_meta('display_name', $author_id); ?>
                                    </span>
                                            </div>

                                            <div class="author_realty">
                                                <span class="label-realty">Điện thoại: </span>
                                                <span class="label-content">
                                        <?php echo get_the_author_meta('billing_phone', $author_id); ?>
                                    </span>
                                            </div>
                                            <div class="author_realty">
                                                <span class="label-realty">Email: </span>
                                                <span class="label-content">
                                        <?php echo get_the_author_meta('email', $author_id); ?>
                                    </span>
                                            </div>

                                            <div class="author_realty">
                                                <span class="label-realty">Địa chỉ: </span>
                                                <span class="label-content">
                                        <?php echo get_the_author_meta('billing_address_1', $author_id); ?>
                                    </span>
                                            </div>
                                            <?php if (!$thongtinlienhe): ?>
                                            <?php else: ?>
                                                <!--   <div class="author_realty">
                                    
                                    <span class="label-content">
                                        <?php echo $thongtinlienhe; ?>
                                    </span> 
                                </div>-->
                                            <?php endif; ?>


                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="realty_related">
                                    <h3>Bất động sản khác</h3>

                                    <?php
                                    $custom_taxterms = wp_get_object_terms($post->ID, 'bat_dong_san', array('fields' => 'ids'));
                                    // arguments
                                    $args = array(
                                        'post_type' => 'nha_dat',
                                        'post_status' => 'publish',
                                        'posts_per_page' => 5, // you may edit this number
                                        'orderby' => 'rand',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'bat_dong_san',
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            )
                                        ),
                                        'post__not_in' => array($post->ID),
                                    );
                                    $related_items = new WP_Query($args);
                                    // loop over query
                                    if ($related_items->have_posts()) :
                                        echo '<ul>';
                                        while ($related_items->have_posts()) : $related_items->the_post();
                                            $ID = $related_items->post->ID;
                                            $states_realty = get_post_meta($ID, 'states_realty', true);
                                            $price_realty = (int)get_post_meta($ID, 'price_realty', true);
                                            ?>
                                            <li class="col-md-full">
                                                <div class="img col-md-4">
                                                    <a href="<?php the_permalink(); ?>"
                                                       title="<?php the_title_attribute(); ?>">
                                                        <?php
                                                         echo (get_the_post_thumbnail(null, 'thumbnail', array('class' => 'img-responsive'))) ? get_the_post_thumbnail(null, 'thumbnail', array('class' => 'img-responsive')) : '<img class="img-responsive" src="' . real_URL . '/bootstrap/images/no-pre.png' . '">';
                                                        ?>
                                                    </a>
                                                </div>
                                                <div class="content col-md-8">
                                                    <a href="<?php the_permalink(); ?>"
                                                       title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    <div>
                                                        <span class="label-realty">Vị trí</span>
                                                        <span class="label-content bfh-states" data-country="VN"
                                                              data-state="<?php _e($states_realty); ?>"></span><br>
                                                    </div>
                                                    <div>
                                                        <span class="label-realty">Giá</span>
                                                        <span class="label-content label-price"> <?php echo ($price_realty != 0) ? (number_format((int)$price_realty, 0, '', '.') . ' VND ') : ' Liên hệ'; ?> </span>
                                                    </div>
                                                </div>

                                            </li>
                                            <?php
                                        endwhile;
                                        echo '</ul>';
                                    endif;
                                    // Reset Post Data
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        else :
                            get_template_part('nocontent');
                        endif;
                        //  enigma_parallax_navigation_posts();
                        comments_template('', true); ?>
                    </div>
                </div> <!-- row div end here -->
            </div><!-- container div end here -->
        </div>
        <div class="content-sidebar col-md-4">
            <div class="form-search-bds">
            <?php do_shortcode('[search_bds]'); ?>
            </div>
            <div class="taxomony-nha-dat">
                <h3 class="uk-panel-title"><?php _e('Danh Mục', 'wa_real_estate') ?></h3>
                <ul id="lct-widget-bat_dong_san">
                    <?php
                    $bat_dong_san = get_terms(array(
                        'taxonomy' => 'bat_dong_san',
                        'hide_empty' => true,
                    ));
                    if ($bat_dong_san): foreach ($bat_dong_san as $value):
                        ?>
                        <li class="cat-item cat-item-<?php echo $value->term_id ?>"><a
                                    href="<?php echo get_term_link($value->term_id) ?>"><?php echo $value->name; ?></a>
                            (<?php echo $value->count ?>)
                        </li>
                        <?php
                    endforeach; endif;
                    ?>
                </ul>
            </div>
            <?php dynamic_sidebar('sidebar-search'); ?>
        </div>
    </div>
<?php get_footer(); ?>