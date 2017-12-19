<?php
/**
 * Displays Footer
 *
 */

?>

<div class="row">
 <?php if(cs_get_option('eds_top_bar_active') == true):?>
       
<div class="col-md-7 col-sm-7">
    <div class="header-contact">
	
 <ul id="top_contact_info">
<?php
echo (cs_get_option('eds_top_location') != "")? '<li><i class="fa fa-map-marker"></i>'.cs_get_option( 'eds_top_location').' </li><li>/</li>' : '';

echo (cs_get_option('eds_top_email') != "")? '<li><i class="fa fa-envelope"></i>'.cs_get_option('eds_top_email').' </li><li>/</li>' : '';

echo (cs_get_option('eds_top_phone') != "")? '<li><i class="fa fa-phone"></i>'.cs_get_option('eds_top_phone').' </li><li>/</li>' : '';
?>
</ul>    
    </div>
</div>
 <?php endif;?>

<div class="col-md-5 col-sm-5">
    <div class="currency-language">
        
        
        <div class="account-menu">
        
            	 <?php
                    wp_nav_menu(
                        array(
                           'theme_location' => is_user_logged_in() ? 'account_after_log' : 'account_before_log',
                            'fallback_cb'    => false,
							'container' 	 => '',
                           
                        )
                    );
                  ?>
            
        </div>
        
        
    </div>
</div>
</div>