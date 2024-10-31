<?php
/**
 * To change this license header, choose License Headers in Project Properties.
 */
?>

<li>

    <?php do_action( 'ress_before_post_sharing_link', $name, $label, $href, $post_type ); ?>
    
    <a class="<?php echo esc_attr( 'klink ' . $name ); ?>" href="<?php echo esc_url( $href ); ?>" title="<?php echo esc_attr( sprintf( 'Share on %s', $label ) ); ?>" target="_blank">
        
        <span class="kicon"><i class="<?php echo esc_attr( 'zocial ' . $name ); ?>"></i></span>
        
        <span class="kname"><?php echo esc_html( $label ); ?></span>
            
    </a>
    
    <?php do_action( 'ress_after_post_sharing_link', $name, $label, $href, $post_type ); ?>

</li>
