<?php
/**
 * Date: 5/13/19
 * Time: 4:48 PM
 */
get_header();
$user_id     = get_current_user_id();
$profile_img = @json_decode( get_user_meta( $user_id, 'profile_image', true ) );
$profile_img = ! $profile_img ? '' : $profile_img;
?>
<div class="profile-picture">
    <div class="upload-thumb profile_image">
        <img src="<?php echo isset( $profile_img->thumb ) ? $profile_img->thumb : ''; ?>">
    </div>
    <div>
        <div class="file-upload button">
            <span>Upload</span>
            <input data-type="image" type="file" data-ajaxed="Y" data-cont=".profile_image" name="image"
                   class="upload"/>
            <input type="hidden" name="image_aid" value=""/>
        </div>
    </div>
</div>


<?php
get_footer();
?>

