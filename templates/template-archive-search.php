<?php
$area_realty = get_option('_area_realty');
$price_realty = get_option('_price_realty');
$price_realty_sales = get_option('_price_realty_sales');
$direction_realty = get_option('_direction_realty');
$colorform_realty = get_option('_colorform_realty');
$customstyle_realty = get_option('_customstyle_realty');
$livingroom_realty = get_option('_number_room');

$s='';
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
    $district = '';
    $area = '';
    $price = '';
    $bedroom = '';
    $direction = '';
    $project = 0;
}

// category
if (isset($cat) && $cat != 0 && is_numeric($cat)) {
    $cats = array(
        'taxonomy' => 'bat_dong_san',
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
// district
if (isset($district) && $district != '') {
    $districts = array(
        'key' => 'district',
        'value' => $district,
        'compare' => 'LIKE',
    );
} else {
    $districts = '';
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
// má»©c giÃ¡
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

        $args = array(
            's' => "$s",
            'tax_query' => array(
                'relation' => 'AND',
                $cats,
                $projects,
            ),
            'meta_query' => array(
                'relation' => 'AND',
                $statess,
                $districts,
                $areas,
                $prices,
                $bedrooms,
                $bedrooms,
                $directions,
                $kinds,
            ),
        );



       
      