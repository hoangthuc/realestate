<?php
    /* Template Name: Custom Search */        
    get_header(); 
    
    $area_realty = get_option('_area_realty');   
    $price_realty = get_option('_price_realty');   
    $direction_realty = get_option('_direction_realty');
    $colorform_realty = get_option('_colorform_realty');   
    $customstyle_realty = get_option('_customstyle_realty');  
    $livingroom_realty = get_option('_number_room'); 


?>
<div class="container category-bat-dong-san">
    <div id="content" class="content_right col-md-12 col-lg-8">
        <h3 class="title-category-nha-dat"> <?php single_term_title(); ?> </h3>
        <?php while ( have_posts() ) : the_post(); 
     $ID = get_the_ID();             
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
            ?>            
            <div id="post-<?php the_ID(); ?>" class="posts col-md-6">        


                <article>  
                 <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4> 
    
                    <div class="content">
                     <div class="post_thumnai col-md-6">
                        <a href="<?php the_permalink() ?>">
                            <div class="img">
                                <?php
                                echo (get_the_post_thumbnail(null, 'thumbnail', array('class' => 'img-responsive'))) ? get_the_post_thumbnail(null, 'thumbnail', array('class' => 'img-responsive')) : '<img class="img-responsive" src="' . real_URL . '/bootstrap/images/no-pre.png' . '">';
                                echo ($kind_realty=='bds_buy')?'<span>Thuê</span>':'<span>Bán</span>';
                                ?>
                            </div>
                        </a>
                    </div> 
                    
                        <div class="deription col-md-6">
                         <div class="container-fluid"> 
                            <div class="price"><label>Mức giá :</label><?php  echo  ($price_realty != 0)?number_money_vnd($price_realty):' Liên hệ'; ?></div>
                            <div class="address"><?php _e($address_realty) ?></div>
                            <a href="<?php the_permalink() ?>">Xem chi tiết</a>
                        </div> 
                                    
                        
                            
                        </div>
                        
                        <div class="bottom-content">  
               <!-- <div class="date">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                       <span class="entry-date"><?php echo get_the_date('d-m-Y'); ?></span>
                    </div>-->
                            <div class="area"><label>Diện tích </label><i class="icon-area"></i> <?php _e($area_realty) ?> m<sup>2</sup></div>
                            <div class="bedroom"><label>Phòng ngủ </label><i class="icon-bed"></i> <?php _e((int)$bedroom_realty ) ?> Phòng</div>
                           
                            <div class="bedroom"><label>WC </label><i class="icon-bed"></i> <?php _e($toilet_realty) ?> wc</div>
                          
                            <div class="Floor"><label>Số tầng </label><i class="icon-bath"></i> <?php _e($floor_realty) ?> Tầng</div>
                            

                      

                        </div>
                       
                    </div>



                </article><!-- #post -->    
            </div>
            <?php endwhile; ?>


<div class="pagination">
        
            <?php
            global $wp_query;
            
            $big = 999999999; // need an unlikely integer
            
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages
            ) );
            ?>
            
        </div>

    </div><!-- content -->
    <div class="content-sidebar col-md-12 col-lg-4">
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
        <?php // get_sidebar(); ?>
        <?php get_footer(); ?>
        
      