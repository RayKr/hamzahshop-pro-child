<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HamzahShop
 */

?>
<div class="single-blog no-margin">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
<div class="post-thumbnail">
    <?php
      // The following determines what the post format is and shows the correct file accordingly
      $format = get_post_format();

      if ($format) {
      get_template_part( 'template-parts/postformats/'.$format );
      } else {
      get_template_part( 'template-parts/postformats/standard' );
      }
    ?>
 </div> 

    
  
        

    <?php $options = cs_get_option( 'eds_meta' ); ?>
        <?php if(!empty($options) && in_array("date", $options)): ?>
           <div class="postinfo-wrapper">
        <div class="post-date">
            <span class="day"><?php echo get_the_date('d'); ?></span><span class="month"><?php echo get_the_date('M'); ?></span>
        </div>
        
         <?php else:?>
           <div class="postinfo-wrapper" style="padding-left:0px;">
          
        <?php endif;?>
        

      <?php if(isset($options) && in_array("auth", $options) || in_array("cat", $options) ){ ?>
          <?php if ( 'post' === get_post_type() ) : ?>
          <div class="entry-meta">
              <?php hamzahshop_posted_on();?>
          </div>
          <?php endif;?>
        <?php }?>  

        



          <div class="entry-summary">
                <?php
                // 修复post内容只能输出无格式纯文本的bug
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links">' . __( 'Pages:', 'hamzahshop' ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ) );
                ?>
          </div>
  
    
  
   
  
  
    </div><!-- #post-## -->





<?php if(isset($options) && in_array("tag", $options)){ ?>
<?php if ( is_single() ) : ?>
    <div class="row">
        <div class="tag_clould">
          <?php hamzahshop_entry_footer(); ?>
        </div>
    </div>
<?php endif; ?>
<?php }?>


 <div class="row">

    <?php
     if(cs_get_option('eds_blog_share_post')!=""){
     get_template_part( 'template-parts/parts/shareicon');
     }
     ?>
    
    <div class="single-prev-next col-md-5">
        <?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> '.__('Prev Article','hamzahshop')); ?>
        <?php next_post_link('%link', __('Next Article','hamzahshop').' <i class="fa fa-long-arrow-right"></i>'); ?>
    </div>
 </div>

 
</article><!-- #post-## -->
</div>


