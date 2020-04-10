<?php
$area_realty = get_option('_area_realty');
$price_realty = get_option('_price_realty');
$price_realty_sales = get_option('_price_realty_sales');
$direction_realty = get_option('_direction_realty');
$colorform_realty = get_option('_colorform_realty');
$customstyle_realty = get_option('_customstyle_realty');
$livingroom_realty = get_option('_number_room');
$pages_search = get_option('pages_search');

$s = "";
$district ='';
if(isset($_GET['search'])){
$s= $_GET['search'];
$cat = $_GET['cat'];
$states = $_GET['states'];
$district = $_GET['district'];
$area = $_GET['area'];
$price = $_GET['price'];
$bedroom = $_GET['bedroom'];
$direction = $_GET['direction'];
$project = $_GET['project'];
$kind = $_GET['kind'];   
}


if (isset($_GET['kind']) == false) {
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
if (isset($area) && $area != '') {
    $array_area = explode('-', $area);
    $areas = array(
        'key' => 'area_realty',
        'value' => $array_area,
        'type' => 'numeric',
        'compare' => "BETWEEN",
    );
} else {
    $areas = '';
}
// mÃ¡Â»Â©c giÃƒÂ¡
if (isset($price) && $price != '') {
    $array_price = explode('-', $price);
    $prices = array(
        'key' => 'price_realty',
        'value' => $array_price,
        'type' => 'numeric',
        'compare' => "BETWEEN",
    );
} else {
    $prices = '';
}
// phong ngu
if (isset($bedroom) && $bedroom != '' && is_numeric($bedroom)) {
    $bedrooms = array(
        'key' => 'bedroom_realty',
        'value' => $bedroom,
        'compare' => '=',
    );
} else {
    $bedrooms = '';
}
// huong nha
if (isset($direction) && $direction != '') {
    $directions = array(
        'key' => 'direction_realty',
        'value' => $direction,
        'compare' => 'LIKE',
    );
} else {
    $directions = '';
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
<div id="search_bds" class="container-fluidss">
    <div class="header-main">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php echo ($_GET['kind'] == 'bds_buy') ? '' : 'active'; ?>"><a
                        href="#realty_sales" aria-controls="Sales" role="tab"
                        data-toggle="tab"><?php _e('Bất động sản bán'); ?></a></li>
            <li role="presentation" class="<?php echo ($_GET['kind'] == 'bds_buy') ? 'active' : ''; ?>"><a
                        href="#realty_buy" aria-controls="Buy" role="tab"
                        data-toggle="tab"><?php _e('Bất động sản thuê'); ?></a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade <?php echo ($_GET['kind'] == 'bds_buy') ? '' : ' in active'; ?> "
                 id="realty_sales">
                <form id="form-search-bds-sales" action="<?php _e(get_permalink($pages_search)) ?>" method="get">
                    <div class="form-group col-md-12">
                        <input type="text" name="search" value="<?php _e($s); ?>" class="form-control"
                               placeholder="<?php _e('Tìm kiếm', 'realy') ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <?php list_category_realty('bat_dong_san', $cat, 'Loại bất động sản', 'cat') ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php
                        tinh_thanhpho('states', $states);
                        ?>
                        <!-- <select class="form-control bfh-states" name="states" data-country="VN" data-state="<?php _e($states) ?>"></select>-->
                    </div>
                    <div class="form-group col-md-6">
                        <?php
                        quan_huyen('district', $states, $district);
                        ?>
                        <!-- <select class="form-control bfh-states" name="states" data-country="VN" data-state="<?php _e($states) ?>"></select>-->
                    </div>

                    <div class="form-group col-md-6">
                        <?php _e(string_to_select_realty($area_realty, 'Diện tích', array('class' => ' bfh-selectbox', 'data-name' => "area", 'data-filter' => "true", "data-value" => $area), ' m2 ')) ?>
                    </div>

                    <div class="form-group col-md-6">
                        <?php _e(string_to_select_realty($price_realty_sales, 'Mức giá', array('class' => ' bfh-selectbox', 'data-name' => "price", 'data-filter' => "true", "data-value" => $price))) ?>
                    </div>

                    <div class="form-group col-md-6">
                        <?php _e(int_to_string_realty($livingroom_realty, 'Số phòng ngủ', array('class' => ' bfh-selectbox', 'data-name' => "bedroom", 'data-filter' => "true", "data-value" => $bedroom), ' phòng ')) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php _e(string_to_select_realty($direction_realty, 'Hướng nhà ', array('class' => ' bfh-selectbox', 'data-name' => "direction", 'data-filter' => 'true', "data-value" => $direction), '')) ?>
                    </div>

                    <div class="form-group col-md-6">
                        <?php list_category_realty('project_category', $project, 'Dự án', 'project') ?>
                    </div>


                    <div class="clearfix"></div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="form-control">Tìm kiếm</button>
                    </div>
                    <input type="hidden" name="kind" value="bds_sales"/>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane fade <?php echo ($_GET['kind'] == 'bds_buy') ? ' in active' : ''; ?> "
                 id="realty_buy">
                <form id="form-search-bds-sales" action="<?php _e(get_permalink($pages_search)) ?>" method="get">
                    <div class="form-group col-md-12">
                        <input type="text" name="search" value="<?php _e($s); ?>" class="form-control"
                               placeholder="Tìm kiếm">
                    </div>
                    <div class="form-group col-md-6">
                        <?php list_category_realty('bat_dong_san', $cat, 'Loại bất động sản', 'cat', 'bds_buy') ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php
                        tinh_thanhpho('states', $states);
                        ?>
                        <!-- <select class="form-control bfh-states" name="states" data-country="VN" data-state="<?php _e($states) ?>"></select> -->
                    </div>
                    <div class="form-group col-md-6">
                        <?php
                        quan_huyen('district', $states, $district);
                        ?>
                        <!-- <select class="form-control bfh-states" name="states" data-country="VN" data-state="<?php _e($states) ?>"></select> -->
                    </div>

                    <div class="form-group col-md-6">
                        <?php _e(string_to_select_realty($area_realty, 'Diện tích', array('class' => ' bfh-selectbox', 'data-name' => "area", 'data-filter' => "true", "data-value" => $area), ' m2 ')) ?>
                    </div>

                    <div class="form-group col-md-6">
                        <?php _e(string_to_select_realty($price_realty, 'Mức giá', array('class' => ' bfh-selectbox', 'data-name' => "price", 'data-filter' => "true", "data-value" => $price))) ?>
                    </div>

                    <div class="form-group col-md-6">
                        <?php _e(int_to_string_realty($livingroom_realty, 'Số phòng ngủ', array('class' => ' bfh-selectbox', 'data-name' => "bedroom", 'data-filter' => "true", "data-value" => $bedroom), ' phòng ')) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php _e(string_to_select_realty($direction_realty, 'Hướng nhà', array('class' => ' bfh-selectbox', 'data-name' => "direction", 'data-filter' => 'true', "data-value" => $direction), '')) ?>
                    </div>

                    <div class="form-group col-md-6">
                        <?php list_category_realty('project_category', $project, 'Dự án', 'project') ?>
                    </div>


                    <div class="clearfix"></div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="form-control">Tìm kiếm</button>
                    </div>
                    <input type="hidden" name="kind" value="bds_buy"/>
                </form>
            </div>
        </div>
    </div>
</div>
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
