<?php
global $post;
    $kind_realty = get_post_meta($post->ID, 'kind_realty', true);
    $code_realty = get_post_meta($post->ID, 'code_realty', true);
    $states_realty = get_post_meta($post->ID, 'states_realty', true);
    $address_realty = get_post_meta($post->ID, 'address_realty', true);
    $area_realty = get_post_meta($post->ID, 'area_realty', true);
    $price_realty = get_post_meta($post->ID, 'price_realty', true);
    $juridical_realty = get_post_meta($post->ID, 'juridical_realty', true);
    $bedroom_realty = get_post_meta($post->ID, 'bedroom_realty', true);
    $livingroom_realty = get_post_meta($post->ID, 'livingroom_realty', true);
    $kitchen_realty = get_post_meta($post->ID, 'kitchen_realty', true);
    $toilet_realty = get_post_meta($post->ID, 'toilet_realty', true);     
    $direction_realty = get_post_meta($post->ID, 'direction_realty', true);
    $contact_realty = get_post_meta($post->ID, 'contact_realty', true); 
    $floor_realty = get_post_meta($post->ID, 'floor_realty', true);
        $air_conditioner_realty = get_post_meta($post->ID, 'air_conditioner_realty', true);   
$terms = wp_get_post_terms( $post->ID, 'nha_dat_category' );
foreach($terms as $value){
    $category []= $value->name;
}
if(is_array($category)){
   $category= implode(' ,',$category); 
}else{
   $category=''; 
}


?>
<div class="information">
    <h3 class="title_single"><?php _e('Thông Tin') ?></h3>
    <ul>
        <li><span class="label_realty">Mã tin</span><span class="content"> <?php _e($code_realty) ?></span></li>
        <li><span class="label_realty">Giá</span><span class="content"> <?php echo  ($price_realty != 0)?number_money_vnd($price_realty):' Liên hệ'; ?></span></li>
        <li><span class="label_realty">Diện tích</span><span class="content"> <?php _e($area_realty) ?> m<sup>2</sup></span></li>
        <li><span class="label_realty">Ngày cập nhật</span><span class="content"> <?php _e(get_the_date( 'd-m-Y', $post->ID )) ?> </span></li>
        <li><span class="label_realty">Loại bất động sản</span><span class="content"> <?php _e($category) ?> </span></li>
        <li><span class="label_realty">Tình trạng pháp lý</span><span class="content"> <?php _e($juridical_realty) ?> </span></li>
        <li><span class="label_realty">Hướng</span><span class="content"> <?php _e($direction_realty) ?> </span></li>
        <li><span class="label_realty">Số phòng ngủ</span><span class="content"> <?php _e($bedroom_realty) ?> </span></li>
        <li><span class="label_realty">Số phòng khách</span><span class="content"> <?php _e($livingroom_realty) ?> </span></li>
        <li><span class="label_realty">Số phòng tắm</span><span class="content"> <?php _e($kitchen_realty) ?> </span></li>
        <li><span class="label_realty">Số phòng WC</span><span class="content"> <?php _e($toilet_realty) ?> </span></li>
        <li><span class="label_realty">Số tầng</span><span class="content"> <?php _e($floor_realty) ?> </span></li>
        <li><span class="label_realty">Số máy lạnh</span><span class="content"> <?php _e($air_conditioner_realty) ?> </span></li>
        
        
        
        
    </ul>
                        </div>