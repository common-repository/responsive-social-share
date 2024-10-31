<?php
/* 
 * Plugin Dashboard and WP Admin Dashboard Widgets
 */

/**
 * TODO:
 * 1) Look at how we have used translation functions. Should the text be so fragmented into many functions?
 * 2) Should the text be inside paragraph tags?
 */


/**
 * Output 'Welcome' Widget
 */
function ress_dashboard_widget_welcome() {
    
    global $current_user;
    
    $title = __( 'Welcome', 'ress' );
    
    // Begin Output Buffering
    ob_start();
    ?>

    <p>
        <?php
        echo sprintf( __( 'Hi %s, welcome to your Responsive Social Share dashboard.', 'ress' ), $current_user->display_name );
        ?>
    </p>
    
    <p>
        <?php
        echo sprintf( __( 'You can add Social Share Links to your posts from <a href="%s">here</a>.', 'ress' ), admin_url( 'options-general.php?page=responsive-social-share&tab=sharing' ) );
        ?>
    </p>

    <?php
    // End Output Buffering and Clear Buffer
    $content = ob_get_contents();
    ob_end_clean();
    
    ress_dashboard_widget_render( $title, $content, $sortable = false );
    
}
add_action( 'ress_dashboard_column_one', 'ress_dashboard_widget_welcome' );

/**
 * Output 'Feature Control' Widget
 */
function ress_dashboard_widget_feature_control() {
    
    $title = __( 'Feature Control', 'ress' );
    
    // Begin Output Buffering
    ob_start();
    ?>
    
    <form method="post" action="options.php" class="feature-control">
        <?php
        settings_fields( 'ress_options' );
        do_settings_sections( 'ress-settings' );
        submit_button();
        ?>
    </form>
    
    <?php
    /*
     * Add variable data to the page ready for use.
     */
    $data = array(
        'url' => admin_url( 'options-general.php?page=responsive-social-share&tab=' ),
        'action' => 'ress_feature_control_update',
        'nonce' => wp_create_nonce( 'ress_feature_control' ),
    );
    
    wp_localize_script( 'ress-feature-control', 'socialFeatures', $data );
    
    // End Output Buffering and Clear Buffer
    $content = ob_get_contents();
    ob_end_clean();
    
    ress_dashboard_widget_render( $title, $content, $sortable = false );
    
}
add_action( 'ress_dashboard_column_one', 'ress_dashboard_widget_feature_control' );

/**
 * Output 'Getting Started' Widget
 */
function ress_dashboard_widget_getting_started() {
    
    $title = __( 'Developer Note', 'ress' );
    
    // Begin Output Buffering
    ob_start();
    ?>
    
    <p>
        <?php
        echo __( 'This plugin is the culmination of many, many hours of hard work and dedication; and a vast presence in the WordPress community.' , 'ress' );
        ?>
    </p>
    
    <p>
        <?php
        echo sprintf( __( 'If you enjoy this plugin, please show your appreciation via a <a href="%s" target="%s">PayPal Donation</a>.', 'ress' ), 'https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=admin%40wpspec%2ecom&lc=US&item_name=WPSpec&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest','_blank');
        ?>
    </p>
    
    <?php
    // End Output Buffering and Clear Buffer
    $content = ob_get_contents();
    ob_end_clean();
    
    ress_dashboard_widget_render( $title, $content, $sortable = false );
    
}
add_action( 'ress_dashboard_column_one', 'ress_dashboard_widget_getting_started' );

/**
 * Output 'Subscribe' Widget
 */
function ress_dashboard_widget_coming_soon() {
    
    $title = __( 'Get Exclusive Email Updates!', 'ress' );
    
    // Begin Output Buffering
    ob_start();
    ?>
    
    <p>
        <?php
        echo __( 'Join our email newsletter to get exclusive add-ons and other cool WordPress related resources.' , 'ress' );
        ?>
    </p>
    
    <div class="planned-features">
        
        <style>.inbFrm{font-size:11px; font-family:Arial, Helvetica, sans-serif; width:300px; padding:0px; background:; border:1px solid #FFFFFF; padding-bottom:25px; margin: 0 auto;}
.inbBtn{margin-left:105px; background:#4db2ec; color:; border:none; padding:8px 3px; cursor:pointer; margin-top:15px; margin-bottom:15px}
.field{width:100%; color:#000000; margin-bottom:5px;}
.field .label-area{width:85px; float:left; clear:left; margin:3px 10px 0 10px; font-family:Arial, Helvetica, sans-serif; font-size:10px; line-height:22px; font-weight:normal; font-style:normal; margin-top:5px}
.field .label-name{color:;}
.field .field-required{color: red;display: inline-block;font-weight: bold;line-height: 13px;margin-left: 3px;}
.field .element-area{float:left; font-size:12px; margin-top:5px}
.field .element-area input, .field .element-area select, .field .element-area textarea{border:1px solid #868686; width:100%; font-size:14px; min-height:22px; height:auto; padding:8px 12px; font-family:Arial, Helvetica, sans-serif; margin-top:2px; color:#000000; font-weight:normal; font-style:normal;}

.field .element-area textarea{height:70px; width:150px;}
.field .element-area select{width:150px; padding-top:1px; padding-left:1px}
.field .element-area select.multi{height:auto; width:150px;}
.field .element-area input[type=radio], .field .element-area input[type=checkbox]{width:20px; margin:0 0 5px 0; padding:0; vertical-align:middle; border:1px solid}
.field .element-area span.sub-lable{display:block; font-size:10px; margin-top:3px;}
.field .element-area .input-radio{ width:22px !important; margin-top:-2px; margin-bottom:3px; border:0}
.field .element-area .input-checkbox{}
.field .element-area .cus_chk_options{display:block; margin:0 auto; float: none; width: 230px; text-align:left; padding:3px 0;}

.field .element-area-1{text-align:center}
.field .element-area-1 .headline{color:#00A2E8; text-align:center; font-size:15px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-style:normal;}
.field .element-area-1 .submit_btn_txt{margin-left:105px; display:inline-block; padding-top:15px; float:left; cursor:pointer}
.field .element-area-1 .privacy{font-style:italic; color:#000000; text-align:center; display:inline-block; margin-top:10px;}
.field .element-area-1 img{margin-right:8px;}
.field .element-area-1 .logo-small{color:#000000; text-align:center; display:block; margin-top:10px;font-weight:bold;}
.field .element-area-1 .logo-small img{margin-left:10px; vertical-align:middle}

.field .label-area{padding:0; float:none; } 
.field .element-area {width:100%; margin-top:0}
.inbFrm .field .label-area{ width:150px; float:none; margin:3px auto; text-align:left; display:block;}
.field .element-area-1 .submit_btn_txt {float:none; text-align:center; margin-left:12px;}
.inbBtn {margin-left:0; text-align:center; }
.field {text-align:center; }</style><!--[if IE]>
	<link rel="stylesheet" type="text/css" href="http://www.ininbox.com/style/ie.css" />
<![endif]--><form  name="addContact" method="post" action="http://www.ininbox.com/webform_contact_add.html" target="_blank"  class="inbFrm"><input type="hidden" name="mid" value="MTM2NzI="><input type="hidden" name="lid" value="NTQ2MQ=="><input type="hidden" name="wid" value="MjU5Nw=="><div class="field"><input value="vEmail" id="fd_type" type="hidden"><div class="label-area"><span class="label-name">Enter your email...</span><span class="field-required">*</span></div><div class="element-area"><input id="sys_vEmail" name="sys_vEmail" type="text"><span class="sub-lable" style="display:none;">eg.xyz@gmail.com</span></div></div><div class="field"><input type="hidden" id="fd_type_n" value="submit_btn"><!-- submit_starts --><input type="submit" value="Subscribe" class="inbBtn" style='font-size:15px;font-family:Arial, Helvetica, sans-serif;font-style:normal;font-weight:normal;color:#fff;height:auto;width:200px;'><!-- submit_ends --></div><input type="hidden" id="submit_txt" value="Subscribe"></form>
<script type="text/javascript" language="javascript" src="http://www.ininbox.com/js/jquery.js"></script>	
<script>
var site_url = "http://www.ininbox.com/";
isPlaceHolder = 1;
</script>
<script type="text/javascript" language="javascript" src="http://www.ininbox.com/js/webformcode.js"></script>	

        
    </div>
    
    <?php
    // End Output Buffering and Clear Buffer
    $content = ob_get_contents();
    ob_end_clean();
    
    ress_dashboard_widget_render( $title, $content, $sortable = false );
    
}
add_action( 'ress_dashboard_column_two', 'ress_dashboard_widget_coming_soon' );

/**
 * Output 'Follow' Widget
 */
function ress_dashboard_widget_support() {
    
    $title = __( 'About', 'ress' );
    
    // Begin Output Buffering
    ob_start();
    ?>
    
     <p>
        <?php
        echo sprintf( __( '<b>Responsive Social Share</b> by <a href="%s" target="%s">WPSpec</a>.', 'ress' ), 'http://wpspec.com/','_blank');
        ?>
    </p>
    
    <p>
        <?php
        echo sprintf( 'Follow Us on:', 'ress' );
        ?>
    </p>
    
    <a href="https://twitter.com/WPSpecMag" class="twitter-follow-button" data-show-count="true">Follow @WPSpecMag</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
   
   <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FWPSpecMag&amp;width=150&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=400649370066310" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
    
    <?php
    // End Output Buffering and Clear Buffer
    $content = ob_get_contents();
    ob_end_clean();
    
    ress_dashboard_widget_render( $title, $content, $sortable = false );
    
}
add_action( 'ress_dashboard_column_three', 'ress_dashboard_widget_support' );

/**
 * Output 'Support' Widget
 */
function ress_dashboard_widget_get_involved() {
    
    $title = __( 'More', 'ress' );
    
    // Begin Output Buffering
    ob_start();
    ?>
    
    <p>
        <?php
        echo sprintf( 'Coming soon', 'ress' );
        ?>
    </p>
    
    
    <?php
    // End Output Buffering and Clear Buffer
    $content = ob_get_contents();
    ob_end_clean();
    
    ress_dashboard_widget_render( $title, $content, $sortable = false );
    
}
add_action( 'ress_dashboard_column_three', 'ress_dashboard_widget_get_involved' );