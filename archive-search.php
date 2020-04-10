<?php
/* Template Name: Custom Search */
get_header();
$area_realty = get_option('_area_realty');
$price_realty = get_option('_price_realty');
$direction_realty = get_option('_direction_realty');
$colorform_realty = get_option('_colorform_realty');
$customstyle_realty = get_option('_customstyle_realty');
$livingroom_realty = 9;


$cat = $_POST['cat'];
$states = $_POST['states'];
$area = $_POST['area'];
$price = $_POST['price'];
$bedroom = $_POST['bedroom'];
$direction = $_POST['direction'];
$project = $_POST['project'];
$kind = $_POST['kind'];

if (isset($_POST['kind']) == false) {
    $cat = 0;
    $states = '';
    $area = '';
    $price = '';
    $bedroom = '';
    $direction = '';
    $project = 0;
}

// category
if (isset($cat) && $cat != 0 && is_numeric($cat)) {
    $cats = array(
        'taxonomy' => 'nha_dat_category',
        'field' => 'id',
        'terms' => array($cat),
    );
} else {
    $cats = '';
}

// states
if (isset($states) && $states != '') {
    $statess = array(
        'key' => 'states_realty',
        'value' => $states,
        'compare' => '=',
    );
} else {
    $statess = '';
}
// dien tich
if (isset($area) && $area != '' && $area != 'undefined') {
    $array_area = explode('-', $area);
    $areas = array(
        'key' => 'area_realty',
        'value' => $array_area,
        'type' => 'numeric',
        'compare' => "BETWEEN",
    );
} else {
    $areas = '';
    $area = '';
}
// mức giá
if (isset($price) && $price != '' && $price != 'undefined') {
    $array_price = explode('-', $price);
    $prices = array(
        'key' => 'price_realty',
        'value' => $array_price,
        'type' => 'numeric',
        'compare' => "BETWEEN",
    );
} else {
    $prices = '';
    $price = '';
}
// phong ngu
if (isset($bedroom) && $bedroom != '' && is_numeric($bedroom) && $bedroom != 'undefined') {
    $bedrooms = array(
        'key' => 'bedroom_realty',
        'value' => $bedroom,
        'compare' => '=',
    );
} else {
    $bedrooms = '';
    $bedroom = '';
}
// huong nha
if (isset($direction) && $direction != '' && $direction != 'undefined') {
    $directions = array(
        'key' => 'direction_realty',
        'value' => $direction,
        'compare' => 'LIKE',
    );
} else {
    $directions = '';
    $direction = '';
}
// du an
if (isset($project) && $project != 0 && is_numeric($project)) {
    $projects = array(
        'taxonomy' => 'project_category',
        'field' => 'id',
        'terms' => array($project),
    );
} else {
    $projects = '';
}
// loai
if (isset($kind) && $kind != '') {
    $kinds = array(
        'key' => 'kind_realty',
        'value' => $kind,
        'compare' => '=',
    );
} else {
    $kinds = '';
}


?>
<div class="container">
    <div id="search_bds" class="container-fluid">
        <div class="header-main">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php echo ($_POST['kind'] == 'bds_buy') ? '' : 'active'; ?>">
                    <a href="#realty_sales" aria-controls="Sales" role="tab" data-toggle="tab"
                       aria-expanded="<?php echo ($_POST['kind'] == 'bds_buy') ? 'false' : 'true'; ?>">Bất động sản
                        bán</a></li>
                <li role="presentation" class="<?php echo ($_POST['kind'] == 'bds_buy') ? 'active' : ''; ?>">
                    <a href="#realty_buy" aria-controls="Buy" role="tab" data-toggle="tab"
                       aria-expanded="<?php echo ($_POST['kind'] == 'bds_buy') ? 'true' : 'false'; ?>">Bất động sản cho
                        thuê</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel"
                     class="tab-pane fade <?php echo ($_POST['kind'] == 'bds_buy') ? '' : ' in active'; ?> "
                     id="realty_sales">
                    <form id="form-search-bds-sales" action="" method="post">
                        <div class="form-group col-md-12">
                            <input type="text" name="s" value="<?php the_search_query(); ?>" class="form-control"
                                   placeholder="Nhập địa điểm">
                        </div>
                        <div class="form-group col-md-3">
                            <?php list_category_realty('nha_dat_category', $cat, 'Loại bất động sản', 'cat') ?>
                        </div>
                        <div class="form-group col-md-3">
                            <select class="form-control bfh-states" name="states" data-country="VN"
                                    data-state="<?php _e($states) ?>"></select>
                        </div>

                        <div class="form-group col-md-3">
                            <?php _e(string_to_select_realty($area_realty, 'Diện tích', array('class' => ' bfh-selectbox', 'data-name' => "area", 'data-filter' => "true", "data-value" => $area), ' m2 ')) ?>
                        </div>

                        <div class="form-group col-md-3">
                            <?php _e(string_to_select_realty($price_realty, 'Mức giá', array('class' => ' bfh-selectbox', 'data-name' => "price", 'data-filter' => "true", "data-value" => $price))) ?>
                        </div>

                        <div class="form-group col-md-3">
                            <?php _e(int_to_string_realty($livingroom_realty, 'Số phòng ngủ', array('class' => ' bfh-selectbox', 'data-name' => "bedroom", 'data-filter' => "true", "data-value" => $bedroom), ' phòng ')) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?php _e(string_to_select_realty($direction_realty, 'Hướng nhà', array('class' => ' bfh-selectbox', 'data-name' => "direction", 'data-filter' => 'true', "data-value" => $direction), '')) ?>
                        </div>

                        <div class="form-group col-md-3">
                            <?php list_category_realty('project_category', $project, 'Dự án bất động sản', 'project') ?>
                        </div>


                        <div class="form-group col-md-3">
                            <button type="submit" class="form-control yellow">Tìm kiếm</button>
                        </div>
                        <input type="hidden" name="post_type" value="nha_dat"/>
                        <input type="hidden" name="kind" value="bds_sales"/>
                    </form>
                </div>
                <div role="tabpanel"
                     class="tab-pane fade <?php echo ($_POST['kind'] == 'bds_buy') ? ' in active' : ''; ?> "
                     id="realty_buy">
                    <form id="form-search-bds-buy" action="" method="post">
                        <div class="form-group col-md-12">
                            <input type="text" name="s" value="<?php the_search_query(); ?>" class="form-control"
                                   placeholder="Nhập địa điểm">
                        </div>
                        <div class="form-group col-md-3">
                            <?php list_category_realty('nha_dat_category', $cat, 'Loại bất động sản', 'cat') ?>
                        </div>
                        <div class="form-group col-md-3">
                            <select class="form-control bfh-states" name="states" data-country="VN"
                                    data-state="<?php _e($states) ?>"></select>
                        </div>

                        <div class="form-group col-md-3">
                            <?php _e(string_to_select_realty($area_realty, 'Diện tích', array('class' => ' bfh-selectbox', 'data-name' => "area", 'data-filter' => "true", "data-value" => $area), ' m2 ')) ?>
                        </div>

                        <div class="form-group col-md-3">
                            <?php _e(string_to_select_realty($price_realty, 'Mức giá', array('class' => ' bfh-selectbox', 'data-name' => "price", 'data-filter' => "true", "data-value" => $price))) ?>
                        </div>

                        <div class="form-group col-md-3">
                            <?php _e(int_to_string_realty($livingroom_realty, 'Số phòng ngủ', array('class' => ' bfh-selectbox', 'data-name' => "bedroom", 'data-filter' => "true", "data-value" => $bedroom), ' phòng ')) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?php _e(string_to_select_realty($direction_realty, 'Hướng nhà', array('class' => ' bfh-selectbox', 'data-name' => "direction", 'data-filter' => 'true', "data-value" => $direction), '')) ?>
                        </div>

                        <div class="form-group col-md-3">
                            <?php list_category_realty('project_category', $project, 'Dự án bất động sản', 'project') ?>
                        </div>


                        <div class="form-group col-md-3">
                            <button type="submit" class="form-control yellow ">Tìm kiếm</button>
                        </div>
                        <input type="hidden" name="post_type" value="nha_dat"/>
                        <input type="hidden" name="kind" value="bds_buy"/>
                    </form>
                </div>
            </div>
        </div>

        <div id="content" class="content_right col-md-8">
            <h3>Bất động sản việt nam </h3>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'nha_dat',
                'posts_per_page' => 10,
                'paged' => $paged,
                's' => "$s",
                'tax_query' => array(
                    'relation' => 'AND',
                    $cats,
                    $projects,
                ),
                'meta_query' => array(
                    'relation' => 'AND',
                    $statess,
                    $areas,
                    $prices,
                    $bedrooms,
                    $bedrooms,
                    $directions,
                    $kinds,
                ),
            );
            $the_query = new WP_Query($args);
            $count = $the_query->post_count;
            ?>
            <div class="count-search"> Có <font><?php _e(number_format($count, 0, '', '.')); ?></font> bất động sản
            </div>

            <?php while ($the_query->have_posts()) : $the_query->the_post();
                $ID = get_the_ID();
                $kind_realty = get_post_meta($ID, 'kind_realty', true);
                $code_realty = get_post_meta($ID, 'code_realty', true);
                $states_realty = get_post_meta($ID, 'states_realty', true);
                $address_realty = get_post_meta($ID, 'address_realty', true);
                $area_realty = get_post_meta($ID, 'area_realty', true);
                $price_realty = get_post_meta($ID, 'price_realty', true);
                $juridical_realty = get_post_meta($ID, 'juridical_realty', true);
                $bedroom_realty = get_post_meta($ID, 'bedroom_realty', true);
                $livingroom_realty = get_post_meta($ID, 'livingroom_realty', true);
                $kitchen_realty = get_post_meta($ID, 'kitchen_realty', true);
                $toilet_realty = get_post_meta($ID, 'toilet_realty', true);
                $direction_realty = get_post_meta($ID, 'direction_realty', true);
                $contact_realty = get_post_meta($ID, 'contact_realty', true);
                $floor_realty = get_post_meta($ID, 'floor_realty', true);
                $air_conditioner_realty = get_post_meta($ID, 'air_conditioner_realty', true);
                ?>
                <div id="post-<?php the_ID(); ?>" class="posts col-md-6">


                    <article>
                        <h4><a href="<?php the_permalink(); ?>"
                               title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

                        <div class="content">
                            <div class="post_thumnai col-md-6">
                                <a href="<?php the_permalink() ?>">
                                    <div class="img">
                                        <?php
                                        the_post_thumbnail('large', array('class' => 'img-responsive'));
                                        echo ($kind_realty == 'bds_buy') ? '<span>Thuê</span>' : '<span>Bán</span>';
                                        ?>
                                    </div>
                                </a>
                            </div>

                            <div class="deription col-md-6">
                                <div class="container-fluid">
                                    <div class="price"><label>Mức giá
                                            :</label><?php echo ($price_realty != 0) ? (number_format((int)$price_realty, 0, '', '.') . ' VND ') : ' Liên hệ'; ?>
                                    </div>
                                    <div class="address"><?php _e($address_realty) ?></div>
                                    <a href="<?php the_permalink() ?>">Xem chi tiết</a>
                                </div>


                            </div>

                            <div class="bottom-content">
                                <!-- <div class="date">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                       <span class="entry-date"><?php echo get_the_date('d-m-Y'); ?></span>
                    </div>-->
                                <div class="area"><label>Diện tích </label><i
                                            class="icon-area"></i> <?php _e($area_realty) ?> m<sup>2</sup></div>
                                <div class="bedroom"><label>Phòng ngủ </label><i
                                            class="icon-bed"></i> <?php _e((int)$bedroom_realty + (int)$livingroom_realty + (int)$kitchen_realty) ?>
                                    Phòng
                                </div>

                                <div class="bedroom"><label>WC </label><i
                                            class="icon-bed"></i> <?php _e($toilet_realty) ?> wc
                                </div>

                                <div class="Floor"><label>Số tầng </label><i
                                            class="icon-bath"></i> <?php _e($floor_realty) ?> Tầng
                                </div>

                                <div class="air_conditioner"><label>Máy lạnh </label><i
                                            class="icon-garage"></i> <?php _e($air_conditioner_realty) ?> Máy lạnh
                                </div>
                            </div>

                        </div>


                    </article><!-- #post -->
                </div>
            <?php endwhile; ?>


            <div class="pagination">

                <?php
                global $wp_query;

                $big = 999999999; // need an unlikely integer

                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages
                ));
                ?>

            </div>

        </div><!-- content -->
        <div class="content-sidebar col-md-4">
            <?php dynamic_sidebar('sidebar-search'); ?>
        </div>
    </div>
</div><!-- contentarea -->

<style type="text/css">
    #search_bds .nav-tabs > li.active a {
        background: <?php _e($colorform_realty) ?>;
    }

    #form-search-bds-sales,
    #form-search-bds-buy {
        background: <?php _e($colorform_realty) ?>;
    }

    <?php _e($customstyle_realty) ?>
</style>
<?php get_footer(); ?>
        
      