<?php

    if( ! function_exists( 'nha_dat_create_post_type' ) ) :
        function nha_dat_create_post_type() {
            $labels = array(
                'name' => 'Tin bất dộng sản',
                'singular_name' => 'Tin bất dộng sản',
                'add_new' => 'Thêm tin mới',
                'all_items' => 'Tất cả tin',
                'add_new_item' => 'Tạo tin',
                'edit_item' => 'Chỉnh sửa',
                'new_item' => 'Tin mới',
                'view_item' => 'Xem tin',
                'search_items' => 'Tìm tin bất dộng sản',
                'not_found' => 'Không có tin nào',
                'not_found_in_trash' => 'Không có tin nào trong thùng rác',
                'parent_item_colon' => 'Tin cha'
                //'menu_name' => default to 'name'
            );
            $args = array(
                'labels' => $labels,
                'public' => true,
                'has_archive' => true,
                'publicly_queryable' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'nha-dat'),
                'capability_type' => 'post',
                'hierarchical' => false,
                'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                    //'author',
                    //'trackbacks',
                    'custom-fields',
                    'comments',
                    'revisions',
                    //'page-attributes', // (menu order, hierarchical must be true to show Parent option)
                    //'post-formats',
                ),
                // 'taxonomies' => array( 'category', 'post_tag' ), // add default post categories and tags
                'menu_position' => 5,
                'exclude_from_search' => false,
                'register_meta_box_cb' => 'nha_dat_add_post_type_metabox'
            );
            register_post_type( 'nha_dat', $args );
            //flush_rewrite_rules();

            register_taxonomy( 'bat_dong_san', // register custom taxonomy - category
                'nha_dat',
                array(
                    'hierarchical' => true,
                    'rewrite' => array( 'slug' => 'bat-dong-san'),
                    'labels' => array(
                        'name' => 'Loại bất dộng sản',
                        'singular_name' => 'Loại bất dộng sản',
                    )
                )
            );

            register_taxonomy( 'project_category', // register custom taxonomy - category
                'nha_dat',
                array(
                    'hierarchical' => true,
                    'labels' => array(
                        'name' => 'Dự án bất dộng sản',
                        'singular_name' => 'Dự án bất dộng sản',
                    )
                )
            );

            register_taxonomy( 'nha_dat_tag', // register custom taxonomy - tag
                'nha_dat',
                array(
                    'hierarchical' => false,
                    'labels' => array(
                        'name' => 'Từ khóa bất dộng sản',
                        'singular_name' => 'Từ khóa bất dộng sản',
                    )
                )
            );
        }
        add_action( 'init', 'nha_dat_create_post_type' );


        function nha_dat_add_post_type_metabox() { // add the meta box
            add_meta_box( 'quote_metabox', 'Thông tin bất động sản', 'quote_metabox', 'nha_dat', 'normal' );
        }


        function quote_metabox() {
            global $post;
            do_action('wp_HT_realty_admin');
            // Noncename needed to verify where the data originated
            echo '<input type="hidden" name="quote_post_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

            // Get the data if its already been entered

            $kind_realty = get_post_meta($post->ID, 'kind_realty', true);
            $code_realty = get_post_meta($post->ID, 'code_realty', true);
            $states_realty = get_post_meta($post->ID, 'states_realty', true);
            $district = get_post_meta($post->ID, 'district', true);
            $address_realty = get_post_meta($post->ID, 'address_realty', true);
            $area_realty = get_post_meta($post->ID, 'area_realty', true);
            $price_realty = get_post_meta($post->ID, 'price_realty', true);
            $juridical_realty = get_post_meta($post->ID, 'juridical_realty', true);
            $bedroom_realty = get_post_meta($post->ID, 'bedroom_realty', true);
            $livingroom_realty = get_post_meta($post->ID, 'livingroom_realty', true);
            $kitchen_realty = get_post_meta($post->ID, 'kitchen_realty', true);
            $toilet_realty = get_post_meta($post->ID, 'toilet_realty', true);     
            $direction = get_post_meta($post->ID, 'direction', true);
            $contact_realty = get_post_meta($post->ID, 'contact_realty', true);
            $floor_realty = get_post_meta($post->ID, 'floor_realty', true);
            $air_conditioner_realty = get_post_meta($post->ID, 'air_conditioner_realty', true);
            if($price_realty==''){$price_realty=0;}
            $direction_realty = get_option('_direction_realty');
            
            // Echo out the field
        ?>

        <table class="form-table">
            <tr>
                <th>
                    <label>Loại hình </label>
                </th>
                <td>
                    <div class="bfh-selectbox" data-name="kind_realty" data-value="<?php echo ($kind_realty)?$kind_realty:'bds_sales'; ?>">
                        <div data-value="bds_sales">Bất động sản bán</div>
                        <div data-value="bds_buy">Bất động sản cho thuê</div>
                    </div>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Mã bất động sản </label>
                </th>
                <td>   
                    <div class="input-group"> <input type="text" class="form-control" name="code_realty" placeholder="Mã BDS" value="<?php _e($code_realty) ?>"></div>
                </td>
            </tr>


            <tr>
                <th>
                    <label>Tỉnh/Thành Phố </label>
                </th>
                <td>
                    <?php
                        tinh_thanhpho('states_realty',$states_realty);
                    ?>
                    <!--<select class="form-control bfh-states" name="states_realty" data-country="VN" data-state="<?php _e($states_realty) ?>"></select>-->
                </td>
            </tr>
               <tr>
                <th>
                    <label>Quận/Huyện </label>
                </th>
                <td>
                    <?php
                        quan_huyen('district',$states_realty,$district);
                    ?>
                    <!--<select class="form-control bfh-states" name="states_realty" data-country="VN" data-state="<?php _e($states_realty) ?>"></select>-->
                </td>
            </tr>
            
            <tr>
                <th>
                    <label>Địa chỉ </label>
                </th>
                <td>   
                    <textarea name="address_realty" class="large-text"><?php echo $address_realty; ?></textarea>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Diện tích</label>
                </th>
                <td>  
                    <div class="input-group"> <div class="input-group-addon">Mét vuông</div> <input type="text" class="form-control" data-min="0" name="area_realty" placeholder="Diện tích" value="<?php _e($area_realty) ?>"> <div class="input-group-addon">m2</div> </div>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Mức giá </label>
                </th>
                <td>
                    <div class="input-group"> <div class="input-group-addon">VND</div> <input type="text" id="demo6" class="form-control" data-max="9999999999999999999"  name="price_realty" placeholder="Mức giá" value="<?php _e(number_format($price_realty,0,'','.')) ?>" data-thousands="." data-decimal="."  data-precision="0"></div>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Pháp lý </label>
                </th>
                <td> 
                    <div class="bfh-selectbox" data-name="juridical_realty" data-value="<?php _e($juridical_realty) ?>">
                        <div data-value="Không xác định">Không xác định</div>
                        <div data-value="Sổ đỏ/Sổ hồng">Sổ đỏ/Sổ hồng</div>
                        <div data-value="Giấy tờ hợp lệ">Giấy tờ hợp lệ</div>
                        <div data-value="Giấy phép XD">Giấy phép XD</div>
                        <div data-value="Giấy phép KD">Giấy phép KD</div>
                    </div>
                </td>
            </tr>



            <tr>
                <th>
                    <label>Số phòng ngủ </label>
                </th>
                <td>   
                    <div class="input-group"> <div class="input-group-addon">Phòng</div> <input type="text" class="form-control bfh-number" data-min="0" name="bedroom_realty" placeholder="Số phòng ngủ" value="<?php _e($bedroom_realty) ?>"></div>
                </td>
            </tr>


            <tr>
                <th>
                    <label>Số phòng khách </label>
                </th>
                <td>   
                    <div class="input-group"> <div class="input-group-addon">Phòng</div> <input type="text" class="form-control bfh-number" data-min="0" name="livingroom_realty" placeholder="Số phòng khách" value="<?php _e($livingroom_realty) ?>"></div>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Số phòng bếp </label>
                </th>
                <td>   
                    <div class="input-group"> <div class="input-group-addon">Phòng</div> <input type="text" class="form-control bfh-number" data-min="0" name="kitchen_realty" placeholder="Số phòng bếp" value="<?php _e($kitchen_realty) ?>"></div>
                </td>
            </tr>


            <tr>
                <th>
                    <label>Số phòng toilet </label>
                </th>
                <td>   
                    <div class="input-group"> <div class="input-group-addon">Phòng</div> <input type="text" class="form-control bfh-number" data-min="0" name="toilet_realty" placeholder="Số phòng toilet" value="<?php _e($toilet_realty) ?>"></div>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Số tầng</label>
                </th>
                <td>  
                    <div class="input-group"> <div class="input-group-addon">Tầng</div> <input type="text" class="form-control bfh-number" data-min="0" name="floor_realty" placeholder="Số tầng" value="<?php _e($floor_realty) ?>"></div>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Máy lạnh</label>
                </th>
                <td>  
                    <div class="input-group"> <div class="input-group-addon">Máy</div> <input type="text" class="form-control bfh-number" data-min="0" name="air_conditioner_realty" placeholder="Số máy" value="<?php _e($air_conditioner_realty) ?>"></div>
                </td>
            </tr>





            <tr>
                <th>
                    <label>Hướng nhà </label>
                </th>
                <td>
                   <?php _e(string_to_select_realty($direction_realty,'Hướng nhà',array('class'=>' bfh-selectbox','data-name'=>"direction",'data-filter'=>'true',"data-value"=>$direction),'')) ?>
                </td>
            </tr>

            <tr>
                <th>
                    <label>Thông tin liên hệ </label>
                </th>
                <td>   
                    <textarea name="contact_realty" rows="3" class="large-text"><?php echo $contact_realty; ?></textarea>
                </td>
            </tr>




        </table>
        <?php
        }


        function quote_post_save_meta( $post_id, $post ) { // save the data

            /*
            * We need to verify this came from our screen and with proper authorization,
            * because the save_post action can be triggered at other times.
            */

            if ( ! isset( $_POST['quote_post_noncename'] ) ) { // Check if our nonce is set.
                return;
            }

            // verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times
            if( !wp_verify_nonce( $_POST['quote_post_noncename'], plugin_basename(__FILE__) ) ) {
                return $post->ID;
            }

            // is the user allowed to edit the post or page?
            if( ! current_user_can( 'edit_post', $post->ID )){
                return $post->ID;
            }
            // ok, we're authenticated: we need to find and save the data
            // we'll put it into an array to make it easier to loop though
            $quote_post_meta['kind_realty'] = $_POST['kind_realty'];
            $quote_post_meta['code_realty'] = $_POST['code_realty'];
            $quote_post_meta['states_realty'] = $_POST['states_realty'];
            $quote_post_meta['address_realty'] = $_POST['address_realty'];
            $quote_post_meta['area_realty'] = $_POST['area_realty'];
            $quote_post_meta['price_realty'] =str_replace('.','',$_POST['price_realty']);
            $quote_post_meta['juridical_realty'] = $_POST['juridical_realty'];
            $quote_post_meta['bedroom_realty'] = $_POST['bedroom_realty'];
            $quote_post_meta['livingroom_realty'] = $_POST['livingroom_realty'];
            $quote_post_meta['kitchen_realty'] = $_POST['kitchen_realty'];
            $quote_post_meta['toilet_realty'] = $_POST['toilet_realty'];
            $quote_post_meta['direction_realty'] = $_POST['direction_realty'];
            $quote_post_meta['contact_realty'] = $_POST['contact_realty'];
            $quote_post_meta['floor_realty'] = $_POST['floor_realty'];
            $quote_post_meta['air_conditioner_realty'] = $_POST['air_conditioner_realty'];
            if($quote_post_meta['price_realty']==''){$quote_post_meta['price_realty']=0;}
            // add values as custom fields
            foreach( $quote_post_meta as $key => $value ) { // cycle through the $quote_post_meta array
                // if( $post->post_type == 'revision' ) return; // don't store custom data twice
                $value = implode(',', (array)$value); // if $value is an array, make it a CSV (unlikely)
                if( get_post_meta( $post->ID, $key, FALSE ) ) { // if the custom field already has a value
                    update_post_meta($post->ID, $key, $value);
                } else { // if the custom field doesn't have a value
                    add_post_meta( $post->ID, $key, $value );
                }
                if( !$value ) { // delete if blank
                    delete_post_meta( $post->ID, $key );
                }
            }
        }
        add_action( 'save_post', 'quote_post_save_meta', 1, 2 ); // save the custom fields
        endif; // end of function_exists()


    function realty_single_breadcrumbs() {
        $delimiter = '';
        $home = __('Home', 'enigma-parallax' ); // text for the 'Home' link
        $before = '<li>'; // tag before the current crumb
        $after = '</li>'; // tag after the current crumb
        echo '<ul class="breadcrumb">';
        global $post;
        $homeLink = home_url();
        echo '<li><a href="' . esc_url($homeLink). '">' . $home . '</a></li>' . $delimiter . ' ';
        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $before . ' _e("Archive by category","enigma-parallax") "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_day()) {
            echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
            echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<li><a href="' . esc_url($homeLink . '/' . $slug['slug']) . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo $before . get_the_title() . $after;
            }

        } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            echo '<li><a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb)
                echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before . _e("Search results for","enigma-parallax")  . get_search_query() . '"' . $after;

        } elseif (is_tag()) {        
            echo $before . _e('Tag','enigma-parallax') . single_tag_title('', false) . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . _e("Articles posted by","enigma-parallax") . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . _e("Error 404","enigma-parallax") . $after;
        }

        echo '</ul>';
    }
















    if( ! function_exists( 'view_quotes_posts' ) ) : // output
        function view_quotes_posts($do_shortcode = 1, $strip_shortcodes = 0 ) {

            $args = array(
                'posts_per_page'     => 100,
                'offset'          => 0,
                //'category'        => ,
                'orderby'         => 'menu_order, post_title', // post_date, rand
                'order'           => 'DESC',
                //'include'         => ,
                //'exclude'         => ,
                //'meta_key'        => ,
                //'meta_value'      => ,
                'post_type'       => 'quote',
                //'post_mime_type'  => ,
                //'post_parent'     => ,
                'post_status'     => 'publish',
                'suppress_filters' => true
            );

            $posts = get_posts( $args );

            $html = '';
            foreach ( $posts as $post ) {
                $meta_name = get_post_meta( $post->ID, '_quote_post_name', true );
                $meta_desc = get_post_meta( $post->ID, '_quote_post_desc', true );
                $img = get_the_post_thumbnail( $post->ID, 'medium' );
                if( empty( $img ) ) {
                    $img = '<img src="'.plugins_url( '/img/default.png', __FILE__ ).'">';
                }


                if( has_post_thumbnail( $post->ID ) ) {
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
                    $img_url = $img[0];

                    //the_post_thumbnail( 'thumbnail' ); /* thumbnail, medium, large, full, thumb-100, thumb-200, thumb-400, array(100,100) */
                }

                $content = $post->post_content;
                if( $do_shortcode == 1 ) {
                    $content = do_shortcode( $content );
                }
                if( $strip_shortcodes == 1 ) {
                    $content = strip_shortcodes( $content );
                }
                $content = wp_trim_words( $content, 30, '...');
                $content = wpautop( $content );

                $html .= '
                <div>
                <h3>'.$post->post_title.'</h3>
                <div>
                <p>Name: '.$meta_name.'</p>
                <p>Description: '.$meta_desc.'</p>
                </div>
                <div>'.$img.'</div>
                <div>'.$content.'</div>
                </div>
                ';
            }
            $html = '<div class="wrapper">'.$html.'</div>';
            return $html;
        }
        endif; // end of function_exists()

    include_once('shortcode/shortcode.php');





    function list_category_realty($category,$kind=0,$option='Tất cả',$name='categories',$loai='bds_sales'){
    
    if($category == 'project_category'):
        $args = array(
            'show_option_all'    => $option,
            'show_option_none'   => '',
            'option_none_value'  => '-1',
            'orderby'            => 'ID', 
            'order'              => 'ASC',
            'show_count'         => 0,
            'hide_empty'         => 1, 
            'child_of'           => 0,
            'exclude'            => '',
            'echo'               => 1,
            'selected'           => $kind,
            'hierarchical'       => 0, 
            'name'               => $name,
            'id'                 => 'categories',
            'class'              => 'postform form-control',
            'depth'              => 0,
            'tab_index'          => 0,
            'taxonomy'           => $category,
            'hide_if_empty'      => false,
            'value_field'         => 'term_id'
        ); 
 return wp_dropdown_categories( $args );
endif;

$categories = get_terms( $category, array(
    'orderby'    => 'count',
    'hide_empty' => 0
) );
?>

<select name="<?php _e($name) ?>" id="categories" class="postform form-control">
    <option value="0"><?php _e($option) ?></option>
    <?php foreach($categories as $key=>$value):
    $term_id = $value->term_id;
    $loai_hinh = get_option('bat_dong_san_'.$term_id);
    if($loai_hinh['custom_term_meta'] == $loai):
     ?>
    <option class="level-0" value="<?php _e($term_id)?>" <?php  echo ($term_id == $kind)?'selected':''; ?>><?php _e($value->name); ?></option>
    <?php endif;  endforeach; ?>
</select>
<?php
       
    }


    function string_to_select_realty($string,$option='',$arrays=array(),$symbol = ' '){
        $array = explode(',',$string);
        $s = $o ='';
        foreach($arrays as $key => $value){
            $s.=$key.'="'.$value.'" ';
        }
        $select = '<div '.$s.' >';
        $select .='<div data-value="">'.$option.'</div>';
        foreach($array as $key => $value){
            if($symbol !=''){
                $vnd  = explode('-',$value);
                if($symbol==" "){
                 $vnd[0]= number_money_vnd($vnd[0]);
                $vnd[1]= number_money_vnd($vnd[1]);                    
                }else{
                    $vnd[0]= number_money_vnd($vnd[0]);
                    $vnd[1]= number_money_vnd($vnd[1]);
                }

                $o .='<div data-value="'.$value.'" > Từ '.$vnd[0].$symbol.' đến '.$vnd[1].$symbol.'</div>'; 
            }else{
                $o .='<div data-value="'.$value.'" >'.$value.'</div>';     
            }



        } 
        $select .= $o.'</div>';
        return $select;
    }

    function int_to_string_realty($int,$option='',$arrays=array(),$symbol = ' Phòng '){    
    $string = $s = $o ='';    
        for($i=0;$i<$int;$i++){
            $string .= $i.','; 
        } 
        $array = explode(',',$string.$int);
        foreach($arrays as $key => $value){
            $s.=$key.'="'.$value.'" ';
        }
        $select = '<div '.$s.' >';
        $select .='<div>'.$option.'</div>';
        foreach($array as $key => $value){
            $o .='<div data-value="'.$value.'" >'.$value.$symbol.'</div>'; 
        } 
        $select .= $o.'</div>';
        return $select;



    }



    require 'widgets/search_realty_widget.php';


    /**
    * Register Reales custom widgets
    */
    if( !function_exists('realty_register_widgets') ): 
        function realty_register_widgets() {
            register_widget('Search_Realty_Widget');
        }
        endif;
    add_action( 'widgets_init', 'realty_register_widgets' );


    function realty_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Sidebar Search', 'realty' ),
            'id'            => 'sidebar-search',
            'description'   => __( 'Xuất hiện trong tìm kiếm bất động sản.', 'realty' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'realty_widgets_init' );

    function shortcode_realty($alt,$content=''){
        ob_start();
        if(isset($alt)&&is_array($alt)){
            $cat = $alt['cat'];            
            $project = $alt['project'];       
            $kind = $alt['kind']; 
            $number_post = $alt['number_post']; 
        }else{
            $cat = 0;            
            $project = '';       
            $kind = ''; 
            $number_post = 3;
        }


        // category    
        if(isset($cat)&&$cat!=0&&is_numeric($cat)){
            $cats =  array(
                'taxonomy' => 'bat_dong_san',
                'field'    => 'id',
                'terms'    => array($cat),
            );    
        }else{$cats='';}
        // du an
        if(isset($project)&&$project!=0&&is_numeric($project)){
            $projects =  array(
                'taxonomy' => 'project_category',
                'field'    => 'id',
                'terms'    => array($project),
            );    
        }else{$projects='';}
        // loai
        if(isset($kind)&&$kind!=''){
            $kinds=  array(
                'key' => 'kind_realty',
                'value' => $kind,
                'compare' => '=',
            );   
        }else{$kinds='';}

        $args = array(
            'posts_per_page'   => $number_post,
            'post_type' => 'nha_dat',
            'orderby' =>'date',
            'order' =>'desc',
            'tax_query' => array(
                'relation' => 'AND',
                $cats,
                $projects,
            ),
            'meta_query' => array(
                'relation' => 'AND',
                $kinds,
            ),
        );   
        $the_query = new WP_Query( $args );
        $count = $the_query->post_count;

    ?>
    <div id="content" class="content_right">         


        <?php if($the_query->have_posts()):  while ( $the_query->have_posts() ) : $the_query->the_post();
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
            <div id="post-<?php the_ID(); ?>" class="posts col-md-4">        


                <article>  
                    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4> 

                    <div class="content">
                    <div class="post_thumnai col-md-6">
                        <a href="<?php the_permalink() ?>">
                            <div class="img">
                                <?php
                                echo (get_the_post_thumbnail(null,'large',array('class'=>'img-responsive')) )? get_the_post_thumbnail(null,'large',array('class'=>'img-responsive')) : '<img src="'.real_URL.'/bootstrap/images/no-pre.png'.'">';
                                    echo ($kind_realty=='bds_buy')?'<span>Thuê</span>':'<span>Bán</span>';
                                ?>
                            </div>
                        </a>
                    </div> 

                    <div class="deription col-md-6">
                        <div class="container-fluid"> 
                            <div class="price"><label>Mức giá: </label> <?php   echo ($price_realty != 0)?number_money_vnd($price_realty):' Liên hệ'; ?></div>
                            <div class="address"><?php _e($address_realty) ?></div>
                            <a href="<?php the_permalink() ?>">Xem chi tiết</a>
                        </div> 



                    </div>

                    <div class="bottom-content">
                        <div class="area"><label>Diện tích </label><i class="icon-area"></i> <?php _e($area_realty) ?> m<sup>2</sup></div>
                        <div class="bedroom"><label>Phòng ngủ </label><i class="icon-bed"></i> <?php _e((int)$bedroom_realty) ?> Phòng</div>

                        <div class="bedroom"><label>WC </label><i class="icon-bed"></i> <?php _e($toilet_realty) ?> wc</div>

                        <div class="Floor"><label>Số tầng </label><i class="icon-bath"></i> <?php _e($floor_realty) ?> Tầng</div>




                    </div>



                </article><!-- #post -->    
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>




    </div><!-- content -->
    <?php

        $string = ob_get_contents();
        ob_end_clean();
        return $string;

    }

    add_shortcode('WP_realty','shortcode_realty');




    function get_realty_part( $slug, $name = null ) {

        do_action( "get_template_part_{$slug}", $slug, $name );

        $templates = array();
        $name = (string) $name;
        if ( '' !== $name )
            $templates = "{$slug}-{$name}.php";

        $templates = "{$slug}.php";

        include_once ($templates);
    }



    function number_money_vnd($number){
        if( !is_numeric($number) )return $number;
        if($number/1000000000 >= 1){
            $bi = $number/1000000000;
            return round($bi,2).' tỷ'; 
        }else if($number/1000000 >= 1){
            $mi = $number/1000000;
            return round($mi,2).' triệu'; 
        }else{
            return number_format($number,0,'','.').' VND';  
        }
    }
    
    

function pippin_taxonomy_add_new_meta_field() {
    // this will add the custom meta field to the add new term page
    ?>
    <div class="form-field">
        <label for="term_meta[custom_term_meta]"><?php _e( 'Loại hình bất động sản', 'pippin' ); ?></label>
       <select name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" >
       <option value="bds_sales">Bất động sản bán</option>
       <option value="bds_buy">Bất động sản cho thuê</option>
       </select>
        <p class="description"><?php _e( 'Chọn 1 loại hình bất động sản','pippin' ); ?></p>
    </div>
<?php
}
function pippin_taxonomy_edit_meta_field($term) {
 
    // put the term ID into a variable
    $t_id = $term->term_id;
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option( "bat_dong_san_$t_id" ); ?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Loại hình bất động sản', 'pippin' ) ?></label></th>
        <td>
         <select name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" >
       <option value="bds_sales">Bất động sản bán</option>
       <option value="bds_buy" <?php echo $term_meta['custom_term_meta'] == 'bds_buy'  ? 'selected' : ''; ?> >Bất động sản cho thuê</option>
       </select>
            
           <p class="description"><?php _e( 'Chọn 1 loại hình bất động sản','pippin' ); ?></p>
        </td>
    </tr>
<?php

$categories = get_terms( 'bat_dong_san', array(
    'orderby'    => 'count',
    'hide_empty' => 0
) );
?>

<select name="cat" id="categories" class="postform form-control">
    <option value="0">Loại bất động sản</option>
    <?php foreach($categories as $key=>$value): ?>
    <option class="level-0" value="<?php _e($value->term_id )?>"><?php _e($value->name); ?></option>
    <?php endforeach; ?>
</select>
<?php

}
add_action( 'bat_dong_san_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );
add_action( 'bat_dong_san_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );
function save_taxonomy_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "bat_dong_san_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option( "bat_dong_san_$t_id", $term_meta );
    }
}  
add_action( 'edited_bat_dong_san', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_bat_dong_san', 'save_taxonomy_custom_meta', 10, 2 );

function pippin_add_taxonomy_filters() {
    global $typenow;
 
    // an array of all the taxonomyies you want to display. Use the taxonomy name or slug
    $taxonomies = array('bat_dong_san');
 
    // must set this to the post type you want the filter(s) displayed on
    if( $typenow == 'nha_dat' ){
 
        foreach ($taxonomies as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;
            $terms = get_terms($tax_slug);
            if(count($terms) > 0) {
                echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                echo "<option value=''>Hiển thị $tax_name</option>";
                foreach ($terms as $term) { 
                    echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
                }
                echo "</select>";
            }
        }
    }
}
add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters' );




