<?php
    do_action('wp_HT_realty_option');
    if(isset($_POST['savechange'])){
        foreach($_POST as $key=>$value){   
            if ( get_option( $key ) !== false && isset($value) ) {
                update_option( $key, $value );
            } else {
                add_option( $key, $value, '', 'yes' ); 
            }
        }
    }

    $area_realty = get_option('_area_realty');   
    $price_realty = get_option('_price_realty');   
    $price_realty_sales = get_option('_price_realty_sales');   
    $direction_realty = get_option('_direction_realty');   
    $colorform_realty = get_option('_colorform_realty');   
    $customstyle_realty = get_option('_customstyle_realty');   
    $number_room = get_option('_number_room');   
    $pages_search = get_option('pages_search');   
    $link_search_pages = get_option('link_search_pages');   


?>
<div class="wapper-content">
    <h2>Cài đặt BDS </h2>
    <div class="container-fluid">
        <form action="" method="post" class="example">
            <div class="form-group">
                <label for="exampleInputEmail1">Diện tích (m<sup>2</sup>): </label> 
                <input type="text" name="_area_realty" class="form-control" value="<?php _e($area_realty) ?>" data-role="tagsinput" >
                <p class="help-block">Hướng dẫn: Bạn phải nhập kiểu số và theo thứ tự tăng dần. Ví dụ: 100-200</p>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Mức giá thuê(VND): </label> 
                <input type="text" name="_price_realty" class="form-control" value="<?php _e($price_realty) ?>" data-role="tagsinput">
                <p class="help-block">Hướng dẫn: Bạn phải nhập kiểu số và theo thứ tự tăng dần. Ví dụ: 100000000-200000000</p>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Mức giá bán(VND): </label> 
                <input type="text" name="_price_realty_sales" class="form-control" value="<?php _e($price_realty_sales) ?>" data-role="tagsinput">
                <p class="help-block">Hướng dẫn: Bạn phải nhập kiểu số và theo thứ tự tăng dần. Ví dụ: 100000000-200000000</p>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Số phòng: </label> 
                <input type="number" name="_number_room" class="form-control" value="<?php _e($number_room) ?>" >
                <p class="help-block">Hướng dẫn: Bạn phải nhập kiểu số.</p>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Hướng nhà: </label> 
                <input type="text" name="_direction_realty" class="form-control" value="<?php _e($direction_realty) ?>" data-role="tagsinput">
                <p class="help-block">Hướng dẫn: Bạn phải nhập kiểu chữ.</p>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Trang tìm kiếm BDS</label>
                <div class="bfh-selectbox" data-name="pages_search" data-value="<?php echo $pages_search; ?>" data-filter="true">
                    <?php
                        $pages = get_posts(array('post_type' => 'page','post_status' => 'publish'));
                        foreach($pages as $value):
                            echo '<div data-value="'.$value->ID.'">'.$value->post_title.'</div>';
                            endforeach;
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Màu nền Form Tìm kiếm</label>
                <div class="bfh-colorpicker" id="color-button" data-name="_colorform_realty" data-color="<?php _e($colorform_realty); ?>">
                </div>





                <div class="form-group">
                    <label for="exampleInputEmail1">Custom Style</label>
                    <textarea class="form-control" name="_customstyle_realty" rows="6"> <?php _e($customstyle_realty); ?></textarea>
                </div>


            </div>

            <button type="submit" id="savechange" name="savechange"  class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

</div>
<?php
    function project_image_enqueue() {
        global $typenow;
        if( $typenow == 'portfolio' ) {
            wp_enqueue_media();

            // Registers and enqueues the required javascript.
            wp_register_script( 'meta-box-image', plugin_dir_url( __FILE__ ) . 'meta-box-image.js', array( 'jquery' ) );
            wp_localize_script( 'meta-box-image', 'meta_image');
            wp_enqueue_script( 'meta-box-image' );
        }
    }
    add_action( 'admin_enqueue_scripts', 'project_image_enqueue' );
?>
