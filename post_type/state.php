<?php
    if( ! function_exists( 'state_create_post_type' ) ) :
        function state_create_post_type() {
            $labels = array(
                'name' => 'State',
                'singular_name' => 'State',
                'add_new' => 'Add new',
                'all_items' => 'All items',
                'add_new_item' => 'Add State',
                'edit_item' => 'Edit',
                'new_item' => 'New State',
                'view_item' => 'View',
                'search_items' => 'Search State',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found',
                'parent_item_colon' => 'parent'
                //'menu_name' => default to 'name'
            );
            $args = array(
                'labels' => $labels,
                'public' => true,
                'has_archive' => true,
                'publicly_queryable' => true,
                'query_var' => true,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_icon'           => 'dashicons-location',
                'supports' => array(
                    'title',
                
                ),
                //   'taxonomies' => array( 'category', 'post_tag' ), // add default post categories and tags
                'menu_position' => 5,
                'exclude_from_search' => false,
                'register_meta_box_cb' => 'state_add_post_type_metabox'
            );
            register_post_type( 'state', $args );
           
        }
        add_action( 'init', 'state_create_post_type' );


        function state_add_post_type_metabox() { // add the meta box
            add_meta_box( 'state_metabox', 'District', 'state_metabox', 'state', 'normal' );
        }


        function state_metabox() {
            global $post;
            $district = get_post_meta($post->ID,'district',true); 
        ?>

        <table class="form-table">
            <tr>
                <th>
                    <label><?php _e('Enter district','realty') ?></label>
                </th>
                <td>
                    <textarea name="district" class="large-text" rows="10" required><?php echo $district; ?></textarea>
                    <p class="example"><em><?php _e('Note: enter string space by "," and write in "" example "string 1","string 2"','realty') ?></em><p>
                </td>
            </tr>
        </table>
        <?php
        }


        function state_post_save_meta( $post_id, $post ) { // save the data
            $quote_post_meta['district'] = $_POST['district'];
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
        add_action( 'save_post', 'state_post_save_meta', 1, 2 );
        endif;


    function tinh_thanhpho($name='states',$data_value=''){
        $args = array(
            'post_type'        => 'state',
            'post_status'      => 'publish',
            'suppress_filters' => true 
        );
        $tinh_thanhpho = get_posts($args);

        $string = '
        <select class="form-control state_choose" name="'.$name.'" data-value="'.$data_value.'">
         <option value>Tỉnh/Thành Phố</option>
        ';
         if($tinh_thanhpho):
            $qh='';
        foreach($tinh_thanhpho as $keys=>$values):
        $select = ($data_value ==$values->ID )?"selected":'';
        $array = get_post_meta($values->ID,'district',true);
        $string .='
        <option value="'.$values->ID.'" '.$select.'>'.$values->post_title.'</option>
        ';
        $qh .= 'qh['.$values->ID.']=['.$array.'];';
        endforeach;
        endif;
        
        $string .='</select>';
        echo $string;
          ?>
<script type="text/javascript">
jQuery(document).ready(function($){
    var qh =Array();
    <?php _e($qh); ?>
  $('.state_choose').change(function(){
      var v = $(this).val();
     html='<option value>Quận/Huyện</option>'; 
     for(x in qh[v]){
         html = html + '<option value"'+qh[v][x]+'">'+qh[v][x]+'</option>';
     }
     $('.district_choose').html(html);
  })  

    
})
</script>        
        <?php
        
    }
    
      function quan_huyen($name='district',$data_id=0,$data_value=''){
        $quan_huyen = get_post_meta($data_id,'district',true);
        $quan_huyen = str_replace('"','',$quan_huyen);
        $quan_huyen=explode(',',$quan_huyen);

        $string = '<select class="form-control district_choose" name="'.$name.'" data-value="'.$data_value.'">
         <option value>Quận/Huyện</option>';
         if($data_id!=0):
        foreach($quan_huyen as $keys=>$values):
        $select = ($data_value ==$values)?"selected":'';
        $string .='
        <option value="'.$values.'" '.$select.'>'.$values.'</option>';
        endforeach; endif;
        
        $string .='</select>';
        echo $string;
      
    }































