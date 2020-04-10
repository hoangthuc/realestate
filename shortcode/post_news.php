<?php
    $area_realty = get_option('_area_realty');   
    $price_realty = get_option('_price_realty');   
    $direction_realty = get_option('_direction_realty');
    $colorform_realty = get_option('_colorform_realty');   
    $customstyle_realty = get_option('_customstyle_realty'); 
    $livingroom_realty = get_option('_number_room');
    $userID = get_current_user_id();
    $author = get_userdata($userID);
    $name_author = $author->data->display_name; 

    $image = new Securimage();
    $errors=array();
    if (isset($_POST['captcha_code'])&& $image->check($_POST['captcha_code']) == false) {
        $errors[]= "Mã xác nhận không đúng xin vui lòng nhập lại.";
    }
    if( $_POST  && empty($errors) ):
        $my_post = array(
            'post_type'    => 'nha_dat',
            'post_title'    => $_POST['title'],
            'post_content'  => $_POST['content'],
            'post_status'   => 'pending',
            'post_author'   => $userID,
            'post_category' => array($_POST['cat'],$_POST['project'])
        );
        $post_id=  wp_insert_post( $my_post ); 

        $data_post = $_POST;
        $data_post['code_realty'] = 'BDS-'.$post_id;
        $bat_dong_san = (int)$data_post['cat'];
        $project = (int)$data_post['project'];
        foreach($data_post as $key => $values){
            update_post_meta($post_id, $key, $values);
        }
        wp_set_object_terms($post_id,$bat_dong_san , 'bat_dong_san', true);
        wp_set_object_terms($post_id, $project, 'project_category', true);
       
            $gallery_images = $_FILES['files_album'];
      $thumnail_images = $_FILES['files_thumbnail'];

        if($gallery_images)$gallery =   upload_file_multiple($gallery_images);
        if($gallery)update_post_meta($post_id, 'fg_perm_metadata', $gallery);

        if($thumnail_images)$thumnail =   upload_images($thumnail_images);
       set_post_thumbnail( $post_id, $thumnail ); 
        
 
        endif;
    $title=$_POST['title'];
    $cat = $_POST['cat'];       
    $states = $_POST['states_realty'];       
    $district = $_POST['district_realty'];       
    $area = $_POST['area_realty'];       
    $price = $_POST['price_realty'];       
    $bedroom = $_POST['bedroom_realty'];       
    $direction = $_POST['direction'];       
    $project = $_POST['project'];  

    if(!empty($errors) && isset($_POST['captcha_code'])): ?>
    <div class="alert alert-warning" role="alert"><?php _e(implode('<br/>',$errors)) ?></div>
    <?php  endif; ?>

<form enctype="multipart/form-data" id="post_realty" method="post" action="" >
    <div class="step1"><p class="bg-primary" style="padding: 15px;"><?php _e('Thông tin cơ bản','realty') ?></p></div>
    <div class="form-group col-md-12">
        <label for="exampleInputtitle" class="col-sm-2 control-label" ><?php _e('Tiêu đề','realty') ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="title" value="<?php echo $title; ?>"  placeholder="<?php _e('Tiêu đề','realty') ?>" required>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="exampleInputkind"  class="col-sm-2 control-label"><?php _e('Hình thức','realty') ?></label>
        <div class="col-sm-9">
            <select id="kind_realty" class="form-control" name="kind_realty" >
                <option value="bds_sales"><?php _e('Bất động sản bán','realty') ?></option>
                <option value="bds_buy"><?php _e('Bất động sản thuê','realty') ?></option>
            </select>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Loại','realty') ?></label>
        <div class="col-sm-9">
            <div class="bds_sales kind_realty"><?php  list_category_realty('bat_dong_san',$cat,'Loại bất động sản bán','cat','bds_sales')  ?></div>
            <div class="bds_buy kind_realty" style="display: none;"><?php  list_category_realty('bat_dong_san',$cat,'Loại bất động sản thuê','cat','bds_buy')  ?></div>
        </div>
    </div>


    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Tỉnh/Thành Phố','realty') ?></label>
        <div class="col-sm-9">
            <?php
                tinh_thanhpho('states_realty',$states);
            ?>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Quận/Huyện','realty') ?></label>
        <div class="col-sm-9">
            <?php
                quan_huyen('district',$states,$district);
            ?>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Dự án','realty') ?></label>
        <div class="col-sm-9">
            <?php list_category_realty('project_category',$project,'Dự án','project') ?>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Diện tích','realty') ?></label>
        <div class="col-sm-9">
            <div class="input-group"> 
                <div class="input-group-addon">Mét vuông</div> 
            <input type="number" class="form-control" step="0.1" data-min="0" name="area_realty" placeholder="Diện tích" value="<?php _e($area) ?>" required> <div class="input-group-addon">m2</div> </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Giá','realty') ?></label>
        <div class="col-sm-9">
            <div class="input-group"> 
                <div class="input-group-addon">VND</div> 
                <input type="number" step="1000" id="demo6" class="form-control" data-max="9999999999999999999"  name="price_realty" placeholder="Mức giá" value="<?php _e($price) ?>" data-thousands="." data-decimal="."  data-precision="0" required>
            </div>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="exampleInputtitle" class="col-sm-2 control-label"><?php _e('Địa chỉ','realty') ?></label>
        <div class="col-sm-9">
            <textarea name="address_realty" class="form-control large-text" required><?php echo $_POST['address_realty']; ?></textarea>
        </div>
    </div>


    <div class="clearfix"></div>
    <div class="step2"><p class="bg-primary" style="padding: 15px;"><?php _e('Thông tin mô tả','realty') ?></p></div> 
    <div class="form-group col-md-12">
        <div class="col-sm-8">
            <textarea class="form-control" name="content" rows="10" required><?php _e($_POST['content']) ?></textarea>
        </div>
        <label for="exampleInputtitle" class="col-sm-3 control-label"><?php _e('Giới thiệu chung về bất động sản của bạn.<br/><em>Ví dụ: Khu nhà có vị trí thuận lợi: Gần công viên, gần trường học ... Tổng diện tích 52m2, đường đi ô tô vào tận cửa.</em>','realty') ?></label>
    </div>
    <div class="clearfix"></div>
    <div class="step3"><p class="bg-primary" style="padding: 15px;"><?php _e('Thông tin khác','realty') ?></p></div>    
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Hướng nhà','realty') ?></label>
        <div class="col-sm-9">
            <?php _e(string_to_select_realty($direction_realty,'Hướng nhà',array('class'=>' bfh-selectbox','data-name'=>"direction",'data-filter'=>'true',"data-value"=>$direction),'')) ?>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Pháp lý','realty') ?></label>
        <div class="col-sm-9">
            <div class="bfh-selectbox" data-name="juridical_realty" data-value="<?php _e($juridical_realty) ?>">
                <div data-value="Không xác định">Không xác định</div>
                <div data-value="Sổ đỏ/Sổ hồng">Sổ đỏ/Sổ hồng</div>
                <div data-value="Giấy tờ hợp lệ">Giấy tờ hợp lệ</div>
                <div data-value="Giấy phép XD">Giấy phép XD</div>
                <div data-value="Giấy phép KD">Giấy phép KD</div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Số tầng','realty') ?></label>
        <div class="col-sm-9">
            <div class="input-group"> 
                <div class="input-group-addon">Tầng</div> 
                <input type="text" class="form-control bfh-number" data-min="0" name="floor_realty" placeholder="Số tầng" value="<?php _e($floor_realty) ?>">
            </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Số phòng ngủ','realty') ?></label>
        <div class="col-sm-9">
            <div class="input-group"> 
                <div class="input-group-addon">Phòng</div> 
                <input type="text" class="form-control bfh-number" data-min="0" name="bedroom_realty" placeholder="Số phòng ngủ" value="<?php _e($bedroom_realty) ?>">
            </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Số phòng bếp','realty') ?></label>
        <div class="col-sm-9">
            <div class="input-group"> 
                <div class="input-group-addon">Phòng</div> 
                <input type="text" class="form-control bfh-number" data-min="0" name="kitchen_realty" placeholder="Số phòng bếp" value="<?php _e($kitchen_realty) ?>">
            </div>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Số phòng tolet','realty') ?></label>
        <div class="col-sm-9">
            <div class="input-group"> 
                <div class="input-group-addon">Phòng</div> 
                <input type="text" class="form-control bfh-number" data-min="0" name="toilet_realty" placeholder="Số phòng toilet" value="<?php _e($toilet_realty) ?>">
            </div>
        </div>
    </div>



    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Máy lạnh','realty') ?></label>
        <div class="col-sm-9">
            <div class="input-group"> 
                <div class="input-group-addon">Máy</div> 
                <input type="text" class="form-control bfh-number" data-min="0" name="air_conditioner_realty" placeholder="Số máy" value="<?php _e($air_conditioner_realty) ?>">
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="step4"><p class="bg-primary" style="padding: 15px;"><?php _e('Hình ảnh','realty') ?></p></div>
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Ảnh đại diện','realty') ?></label>
        <div class="col-sm-9">
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?php _e('Thêm ảnh','realty') ?></span>
                <input type="file" name="files_thumbnail" required>
            </span> 
            <p id="files_thumbnail"></p>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Ảnh mô tả','realty') ?></label>
        <div class="col-sm-9">
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?php _e('Thêm ảnh','realty') ?></span>
                <input type="file" name="files_album[]"  multiple required>
            </span> 

        </div>
    </div>



    <div class="clearfix"></div> 
    <div class="step5"><p class="bg-primary" style="padding: 15px;"><?php _e('Xác thực người dùng','realty') ?></p></div> 
    <div class="form-group col-md-12">
        <label for="inputEmail3" class="col-sm-2 control-label"><?php _e('Mã xác thực','realty') ?></label>
        <div class="col-sm-9">
            <div class="capcha"> <?php echo Securimage::getCaptchaHtml(); ?></div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary"><?php _e('Đăng tin','realty') ?></button>
</form>  
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Chào bạn <?php _e($name_author) ?> !</h4>
            </div>
            <div class="modal-body">
                <p>Tin bất động sản của bạn đã được gửi thành công. <br/> 
                    Tin của bạn sẽ được đăng lên website sau khi được ban biên tập duyệt.<br/>
                    Bạn vui lòng quay lại trang chính để xem thông tin khác hoặc có thể tiếp tục đăng tin tiếp theo.<br/>
                    Xin chân thành cảm ơn.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tiếp tục đăng tin</button>
                <button type="button" class="btn btn-default" onclick="window.location='<?php _e(get_site_url()) ?>'">Đến trang chủ</button>
            </div>
        </div>
    </div>
</div>  
<?php 
if( $_POST  && empty($errors) ):
	?>
 <script type=" text/javascript">
         $('#myModal').modal('show');
            $('#myModal').on('hidden.bs.modal', function (e) {
                location.href=location;
            })  
    </script>   
<?php
endif;



    function upload_images($images){
        global $wpdb;
        $upload_dir = wp_upload_dir(); // Set upload folder
        $filename = $images["name"];
        $image_data = file_get_contents($images["tmp_name"]);
        if( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }
        file_put_contents( $file, $image_data );
        $wp_filetype = wp_check_filetype( $filename, null );

        // Set attachment data
        $attachment = array(
            'guid'           => $upload_dir['url'] . '/' . sanitize_file_name( $filename ), 
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        $attach_id = wp_insert_attachment( $attachment, $file );
         require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
        return $attach_id;
    }


    function upload_file_multiple($files){
        if (!function_exists('wp_generate_attachment_metadata')){
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
}
if ( $files) { 

    foreach ($files['name'] as $key => $value) {            
            if ($files['name'][$key]) { 
                $file = array( 
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key], 
                    'tmp_name' => $files['tmp_name'][$key], 
                    'error' => $files['error'][$key],
                    'size' => $files['size'][$key]
                ); 

                $_FILES = array ("files_album" => $file); 
                foreach ($_FILES as $file => $array) {      
                 if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) __return_false();
                 $attach_id = media_handle_upload( $file, $pid );
                    if ( is_numeric( $attach_id ) ) {
                         update_post_meta( $pid, '_files_album', $attach_id );
                         }
                    $images[] = $attach_id;
       
                }
               
            } 
        } 
 return implode(',', $images);

    }

}






 ?>
