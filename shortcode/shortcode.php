<?php

 function get_search_bds($alt,$content=''){
 	ob_start();
   include_once('search.php');   

   $resulf = ob_get_contents();
   ob_end_clean();
   return $resulf;
 } 
 add_shortcode('search_bds','get_search_bds');
 
 
 function post_news_bds($alt,$content=''){
   include_once('post_news.php');   
 } 
 add_shortcode('Postnews','post_news_bds');



 add_shortcode('show_kind_realty','f_show_kind_realty');
 function f_show_kind_realty(){
 	global $post;
 		ob_start();
$kind_realty = get_post_meta($post->ID,'kind_realty',true);
if($kind_realty == 'bds_sales'){
	_e('For sale','wa_real_estate');
}else{
	_e('For hire','wa_real_estate');
}

   $resulf = ob_get_contents();
   ob_end_clean();
   return $resulf;
 }


 add_shortcode('show_price_realty','f_show_price_realty');
 function f_show_price_realty(){
 	global $post;
 		ob_start();
  $price_realty = (int)get_post_meta($post->ID, 'price_realty', true);
if($price_realty){
	echo ($price_realty != 0) ? (number_format((int)$price_realty, 0, '', '.') . ' VND ') : ' Liên hệ'; 
}

   $resulf = ob_get_contents();
   ob_end_clean();
   return $resulf;
 }


  add_shortcode('show_address_realty','f_show_address_realty');
 function f_show_address_realty(){
   global $post;
      ob_start();
    $address_realty = get_post_meta($post->ID, 'address_realty', true);
if($address_realty){
   echo $address_realty; 
}

   $resulf = ob_get_contents();
   ob_end_clean();
   return $resulf;
 }

  add_shortcode('show_number_realty','f_show_number_realty');
 function f_show_number_realty($alt,$content){
   global $post;
      ob_start();
    $number = get_post_meta($post->ID, $alt['type'], true);
   echo ($number) ? $number: "NULL" ; 

   $resulf = ob_get_contents();
   ob_end_clean();
   return $resulf;
 }


 add_shortcode('get_category_realestate','f_get_category_realestate');

 function f_get_category_realestate($alt,$content){
      ob_start();
?>
    <div class="content-sidebar">
        <div class="taxomony-nha-dat">
            <h3 class="uk-panel-title"><?php _e('Danh Mục','wa_real_estate') ?></h3>
            <ul id="lct-widget-bat_dong_san">
            <?php
            $bat_dong_san = get_terms( array(
                'taxonomy' => 'bat_dong_san',
                'hide_empty' => true,
            ) );
            if($bat_dong_san): foreach ($bat_dong_san as $value ):
            ?>
                <li class="cat-item cat-item-<?php echo $value->term_id ?>"><a href="<?php echo get_term_link( $value->term_id) ?>"><?php echo $value->name; ?></a> (<?php echo $value->count ?>)
                </li>
            <?php
            endforeach; endif;
            ?>
            </ul>
        </div>
    </div>
<?php
 $resulf = ob_get_contents();
   ob_end_clean();
   return $resulf;
 }


 add_filter('filter_realsestate','f_resulf_realestate');
 function f_resulf_realestate($query_args){
  if($_GET){
   include(FILE_URL.'/templates/template-archive-search.php');  
   $query_args['s'] = $args['s'];
$query_args['tax_query'] = $args['tax_query'];
$query_args['meta_query'] = $args['meta_query']; 
  }
return $query_args;
 }

?>
