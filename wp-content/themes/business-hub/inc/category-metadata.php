<?php
/* Category custom field */
add_action( 'category_add_form_fields', 'businesshub_extra_category_fields', 10 );
add_action ( 'edit_category_form_fields', 'businesshub_extra_category_fields');
function businesshub_extra_category_fields( $tag ) {    //check for existing featured ID
	$t_id 							= is_object($tag) && $tag->term_id?$tag->term_id:'';
    $cat_sidebar		 			= get_option( "cat_sidebar$t_id") ? get_option( "cat_sidebar$t_id"):'';
    $cat_text_heading_style			= get_option( "cat_text_heading_style$t_id") ? get_option( "cat_text_heading_style$t_id"):'';
    $cat_text_heading_icon			= get_option( "cat_text_heading_icon$t_id") ? get_option( "cat_text_heading_icon$t_id"):'';
    $cat_heading_sub_text			= get_option( "cat_heading_sub_text$t_id") ? get_option( "cat_heading_sub_text$t_id"):'';
    $cat_header_background 			= get_option( "cat_header_background$t_id") ? get_option( "cat_header_background$t_id"):'';
	$cat_header_background_color	= get_option( "cat_header_background_color$t_id") ? get_option( "cat_header_background_color$t_id"):'';
    $cat_footer_cta		 			= get_option( "cat_footer_cta$t_id") ? get_option( "cat_footer_cta$t_id"):'';
    $cat_footer_cta_height		 	= get_option( "cat_footer_cta_height$t_id") ? get_option( "cat_footer_cta_height$t_id"):'';
    $cat_footer_cta_fullwidth		= get_option( "cat_footer_cta_fullwidth$t_id") ? get_option( "cat_footer_cta_fullwidth$t_id"):'';
    $cat_footer_cta_background		= get_option( "cat_footer_cta_background$t_id") ? get_option( "cat_footer_cta_background$t_id"):'';
	$cat_footer_cta_background_color = get_option( "cat_footer_cta_background_color$t_id") ? get_option( "cat_footer_cta_background_color$t_id"):'';
?>
<!-- Category Sidebar-->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_sidebar"><?php esc_html_e('Sidebar','cactus'); ?></label>
		</th>
		<td>
			<select name="cat_sidebar">
				<option value="default" <?php echo  esc_attr($cat_sidebar == 'default' ? 'selected="selected"' : '');?>><?php esc_html_e('Default','cactus'); ?></option>
				<option value="left" <?php echo  esc_attr($cat_sidebar == 'left' ? 'selected="selected"' : '');?>><?php esc_html_e('Left','cactus'); ?></option>
				<option value="right" <?php echo  esc_attr($cat_sidebar == 'right' ? 'selected="selected"' : '');?>><?php esc_html_e('Right','cactus'); ?></option>
				<option value="hidden" <?php echo  esc_attr($cat_sidebar == 'hidden' ? 'selected="selected"' : '');?>><?php esc_html_e('Hidden','cactus'); ?></option>
			</select>
			<p class="description"><?php esc_html_e('Select "Default" to use settings in Theme Options','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Sidebar-->

<!-- Category Text Heading Style -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_text_heading_style"><?php esc_html_e('Text Heading - Style','cactus'); ?></label>
		</th>
		<td>
			<select name="cat_text_heading_style">
				<option value="default" <?php echo  esc_attr($cat_text_heading_style == 'default' ? 'selected="selected"' : '');?>><?php esc_html_e('Default','cactus'); ?></option>
				<option value="simple" <?php echo  esc_attr($cat_text_heading_style == 'simple' ? 'selected="selected"' : '');?>><?php esc_html_e('Simple','cactus'); ?></option>
				<option value="big_center" <?php echo  esc_attr($cat_text_heading_style == 'big_center' ? 'selected="selected"' : '');?>><?php esc_html_e('Big Center Heading','cactus'); ?></option>
				<option value="icon_left" <?php echo  esc_attr($cat_text_heading_style == 'icon_left' ? 'selected="selected"' : '');?>><?php esc_html_e('Icon Left','cactus'); ?></option>
                <option value="center_sub_line" <?php echo  esc_attr($cat_text_heading_style == 'center_sub_line' ? 'selected="selected"' : '');?>><?php esc_html_e('Center with Sub-Line','cactus'); ?></option>
			</select>
			<p class="description"><?php esc_html_e('Select "Default" to use settings in Theme Options','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Text Heading Style -->

<!-- Category Text Heding Icon -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_text_heading_icon"><?php esc_html_e('Text Heading -  Icon','cactus'); ?></label>
		</th>
		<td>
            <input type="text" name="cat_text_heading_icon" value="<?php echo esc_attr($cat_text_heading_icon);?>" />
			<p class="description"><?php esc_html_e('Leave blank to use settings in Theme Options','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Text Heading Icon -->

<!-- Category Heading Sub Text -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_heading_sub_text"><?php esc_html_e('Heading Sub-Text','cactus'); ?></label>
		</th>
		<td>
            <input type="text" name="cat_heading_sub_text" value="<?php echo esc_attr($cat_heading_sub_text);?>" />
			<p class="description"><?php esc_html_e('Leave blank to use settings in Theme Options','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Heading Sub Text -->

<!-- Category Header Background -->
    <tr>
		<th>
			<label for="cat_header_background"><?php esc_html_e('Header Background','cactus') ?></label></th>
		<td>
        	<label for="cat_header_background">
                <input id="cat_header_background" type="text" size="40" name="cat_header_background" value="<?php echo esc_attr($cat_header_background);?>" />
                <input id="upload_cat_header_background_button" data-ref="#cat_header_background" data-img-scr="#img-preview-header-bg" class="button" type="button" value="Upload/Add image" />
                <?php echo parse_str($_SERVER['QUERY_STRING'])?>
                <?php if(isset($action) && $action == 'edit'):?>
                	<input id="remove_image_cat_header_background_button" class="button" type="button" value="Remove image" /></br>
            	<?php endif;?>
            </labe
            ><p class="description"><?php esc_html_e('Choose background for this category','cactus')?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th>
		</th>
	    <td>
        	<?php if(isset($action) && $action == 'edit'):?>
	        <img id="img-preview-header-bg" src="<?php if ($cat_header_background != ''){ echo esc_attr($cat_header_background); }else{ echo 'https://placeholdit.imgix.net/~text?txtsize=48&txt=No%20Image&w=350&h=129';}?>" style="width:300px; height:auto;">
            <?php endif;?>
	    </td>
	</tr>

<!-- Category Header Background -->

<!-- Category Header Background Color -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_header_background_color"><?php esc_html_e('Header Background Color','cactus'); ?></label>
		</th>
		<td>
            <input type="text" class="colorpicker" value="<?php echo esc_attr($cat_header_background_color == '' ? '444444' : $cat_header_background_color);?>" name="cat_header_background_color"/>
			<p class="description"><?php esc_html_e('Choose background color for this category.','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Header Color -->

<!-- Category Footer CTA Content -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_footer_cta"><?php esc_html_e('Footer CTA - Content','cactus'); ?></label>
		</th>
		<td>
            <textarea name="cat_footer_cta"  rows="2"><?php echo esc_attr($cat_footer_cta); ?></textarea>
			<p class="description"><?php esc_html_e('Custom Footer CTA content for this page','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Footer CTA Content -->

<!-- Category Footer CTA Height -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_footer_cta_height"><?php esc_html_e('Footer CTA - Height','cactus'); ?></label>
		</th>
		<td>
            <input type="text" name="cat_footer_cta_height" value="<?php echo esc_attr($cat_footer_cta_height);?>" />
			<p class="description"><?php esc_html_e('Height (in pixels) of Footer CTA','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Footer CTA Height -->

<!-- Category Footer CTA Fullwidth -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_footer_cta_fullwidth"><?php esc_html_e('Footer CTA - Fullwidth','cactus'); ?></label>
		</th>
		<td>
			<select name="cat_footer_cta_fullwidth">
            	<option value="default" <?php echo esc_attr( $cat_footer_cta_fullwidth == 'default' ? 'selected="selected"' : '');?>><?php esc_html_e('Default','cactus'); ?></option>
				<option value="on" <?php echo  esc_attr($cat_footer_cta_fullwidth == 'on' ? 'selected="selected"' : '');?>><?php esc_html_e('On','cactus'); ?></option>
				<option value="off" <?php echo  esc_attr($cat_footer_cta_fullwidth == 'off' ? 'selected="selected"' : '');?>><?php esc_html_e('Off','cactus'); ?></option>
			</select>
			<p class="description"><?php esc_html_e('Enable fullwidth for Footer CTA','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Footer CTA Fullwidth -->

<!-- Category Footer CTA Background -->
    <tr>
		<th>
			<label for="cat_footer_cta_background"><?php esc_html_e('Footer CTA - Background','cactus') ?></label></th>
		<td>
        	<label for="cat_footer_cta_background">
                <input id="cat_footer_cta_background" type="text" size="40" name="cat_footer_cta_background" value="<?php echo esc_attr($cat_footer_cta_background);?>" />
                <input id="upload_footer_cta_background" data-ref="#cat_footer_cta_background" data-img-scr="#img-preview-footer-cta" class="button" type="button" value="Upload/Add image" />
                <?php echo parse_str($_SERVER['QUERY_STRING'])?>
                <?php if(isset($action) && $action == 'edit'):?>
                	<input id="remove_cta_background" class="button" type="button" value="Remove image" /></br>
            	<?php endif;?>
            </label>
            <p class="description"><?php esc_html_e('Choose background for Footer CTA','cactus')?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th>
		</th>
	    <td>
        	<?php if(isset($action) && $action == 'edit'):?>
	        <img id="img-preview-footer-cta" src="<?php if ($cat_footer_cta_background != ''){ echo esc_attr($cat_footer_cta_background); }else{ echo 'https://placeholdit.imgix.net/~text?txtsize=48&txt=No%20Image&w=350&h=129';}?>"  style="width:300px; height:auto;">
            <?php endif;?>
	    </td>
	</tr>
<!-- Category Footer CTA Background -->

<!-- Category Footer CTA Background Color -->
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat_footer_cta_background_color"><?php esc_html_e('Footer CTA - Background Color','cactus'); ?></label>
		</th>
		<td>
            <input type="text" class="colorpicker" value="<?php echo esc_attr($cat_footer_cta_background_color == '' ? '444444' : $cat_footer_cta_background_color);?>" name="cat_footer_cta_background_color"/>
			<p class="description"><?php esc_html_e('Choose background color for this category.','cactus'); ?></p>
		</td>
	</tr>
<!-- Category Footer CTA Background Color -->


<?php
}
//save extra category extra fields hook
add_action ( 'edited_category', 'businesshub_save_extra_category_fileds');
add_action( 'created_category', 'businesshub_save_extra_category_fileds', 10, 2 );
function businesshub_save_extra_category_fileds( $term_id ) {

    if ( isset( $_POST['cat_sidebar'])) {
        $cat_sidebar = $_POST['cat_sidebar'];
        update_option( "cat_sidebar$term_id", $cat_sidebar );
    }

    if ( isset( $_POST['cat_text_heading_style'])) {
        $cat_text_heading_style = $_POST['cat_text_heading_style'];
        update_option( "cat_text_heading_style$term_id", $cat_text_heading_style );
    }

    if ( isset( $_POST[sanitize_key('cat_text_heading_icon')] ) ) {
        $cat_text_heading_icon = $_POST['cat_text_heading_icon'];
        update_option( "cat_text_heading_icon$term_id", $cat_text_heading_icon );

    }

    if ( isset( $_POST['cat_heading_sub_text'] ) ) {
        $cat_heading_sub_text = $_POST['cat_heading_sub_text'];
        update_option( "cat_heading_sub_text$term_id", $cat_heading_sub_text );
    }

    if ( isset( $_POST['cat_header_background'] ) ) {
        $cat_header_background = $_POST['cat_header_background'];
        update_option( "cat_header_background$term_id", $cat_header_background );
    }
	
	if ( isset( $_POST['cat_header_background_color'] ) ) {
        $cat_header_background_color = $_POST['cat_header_background_color'];
        update_option( "cat_header_background_color$term_id", $cat_header_background_color );
    }

    if ( isset( $_POST['cat_footer_cta'] ) ) {
        $cat_footer_cta = $_POST['cat_footer_cta'];
        update_option( "cat_footer_cta$term_id", $cat_footer_cta );
    }

    if ( isset( $_POST['cat_footer_cta_height'] ) ) {
        $cat_footer_cta_height = $_POST['cat_footer_cta_height'];
        update_option( "cat_footer_cta_height$term_id", $cat_footer_cta_height );
    }

    if ( isset( $_POST['cat_footer_cta_fullwidth'] ) ) {
        $cat_footer_cta_fullwidth = $_POST['cat_footer_cta_fullwidth'];
        update_option( "cat_footer_cta_fullwidth$term_id", $cat_footer_cta_fullwidth );
    }

    if ( isset( $_POST['cat_footer_cta_background'] ) ) {
        $cat_footer_cta_background = $_POST['cat_footer_cta_background'];
        update_option( "cat_footer_cta_background$term_id", $cat_footer_cta_background );
    }
	
	if ( isset( $_POST['cat_footer_cta_background_color'] ) ) {
        $cat_footer_cta_background_color = $_POST['cat_footer_cta_background_color'];
        update_option( "cat_footer_cta_background_color$term_id", $cat_footer_cta_background_color );
    }

}