<?php
/**
 * Includes meta boxes. 
 */
load_template(LANDPICK_DIR . "/admin/framework/meta-boxes/meta-boxes-post-formats.php") ;
load_template(LANDPICK_DIR . "/admin/framework/meta-boxes/meta-boxes-template-settings.php") ;
load_template(LANDPICK_DIR . "/admin/framework/meta-boxes/meta-boxes-header-settings.php") ;
load_template(LANDPICK_DIR . "/admin/framework/meta-boxes/meta-boxes-footer-settings.php") ;

function landpick_metaboxes_settings_field(){
    $header_settings = landpick_header_settings_meta_boxes();
    $footer_settings = landpick_footer_settings_meta_boxes();

    return array_merge( $header_settings, $footer_settings );
}

add_filter( 'rwmb_meta_boxes', 'landpick_register_header_settings_meta_boxes' );
function landpick_register_header_settings_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array (
        'title' => esc_attr__('Landpick settings', 'landpick'),
        'id' => 'landpick-page-settings',
        'post_types' => array('page'),
        'priority' => 'high',
        'autosave' => true,
        'default_hidden' => false,        
        'fields' => landpick_metaboxes_settings_field(),
        'tab_style' => 'default',
        'tab_wrapper' => true,
        'tabs' => array(
            'General_settings' => array(
                'label' => esc_attr__('General settings', 'landpick'),
                'icon' => 'dashicons-admin-generic',
            ),
            'navbar_settings' => array(
                'label' => esc_attr__('Header settings', 'landpick'),
                'icon' => 'dashicons-admin-settings',
            ),            
            'footer_settings' => array(
                'label' => esc_attr__('Footer settings', 'landpick'),
                'icon' => 'dashicons-admin-settings',
            ),
        ),
    );
    

    return $meta_boxes;
}

add_action( 'portfolio_category_add_form_fields', 'landpick_portfolio_category_add_form_fields', 10, 2 );
function landpick_portfolio_category_add_form_fields($taxonomy) {   

    ?><div class="form-field term-group">
        <label for="custom-link"><?php _e('Custom Category link', 'landpick'); ?></label>
        <input name="custom-link" id="custom-link" value="" size="40" type="text">
        <p>Leave blank to avoid custom link. Default term link will be used.</p>
    </div><?php
}

add_action( 'created_portfolio_category', 'landpick_save_portfolio_category_meta', 10, 2 );
function landpick_save_portfolio_category_meta( $term_id, $tt_id ){

    if( isset( $_POST['custom-link'] ) && '' !== $_POST['custom-link'] ){
        $link = esc_url( $_POST['custom-link'] );
        add_term_meta( $term_id, 'custom-link', $link, true );
    }

}

add_action( 'portfolio_category_edit_form_fields', 'landpick_portfolio_category_edit_form_fields', 10, 2 );
function landpick_portfolio_category_edit_form_fields( $term, $taxonomy ){

    // get current group
    $link = get_term_meta( $term->term_id, 'custom-link', true );                

    ?><tr class="form-field term-group-wrap">
        <th scope="row"><label for="custom-link"><?php _e('Custom Category link', 'landpick'); ?></label></th>
        <td><input name="custom-link" id="custom-link" value="<?php echo esc_url($link) ?>" size="40" type="text">
       </td>
    </tr><?php
}

add_action( 'edited_portfolio_category', 'landpick_edited_portfolio_category', 10, 2 );
function landpick_edited_portfolio_category( $term_id, $tt_id ){

    if( isset( $_POST['custom-link'] ) && '' !== $_POST['custom-link'] ){
        $link = esc_url( $_POST['custom-link'] );
        update_term_meta( $term_id, 'custom-link', $link );
    }
}