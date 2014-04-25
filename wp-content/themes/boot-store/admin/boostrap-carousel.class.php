<?php /* Carousel */
class BREBoostrapCarouselMetabox {
	static function init() {
		add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
	}

	static function admin_init() {
		add_action( 'post_edit_form_tag', array( __CLASS__, 'post_edit_form_tag' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post', array( __CLASS__, 'save_post' ) );
		add_action( 'delete_post', array( __CLASS__, 'delete_post' ) );
	}

	static function post_edit_form_tag() {
		echo ' enctype="multipart/form-data"';
	}

	static function add_meta_boxes() {
		$post_types = get_post_types( array( 'public' => true ) );
		foreach( $post_types as $post_type )
			add_meta_box( 'bre_carousel', __( 'Carousel', 'bre-bootstrap-ecommerce' ), array( __CLASS__, 'bre_carousel_meta_box' ), $post_type, 'side', 'high' );
	}

	static function bre_carousel_meta_box( $post ) { 
		$bre_add_to_home_carousel = bre_is_added_to_home_carousel( $post->ID );
		$bre_image_for_carousel = bre_get_image_for_carousel( $post->ID ); ?>
		<?php wp_nonce_field( 'bre_carousel_noncename', 'bre_carousel_noncename' ); ?>
		<p>
			<label for="bre_add_to_home_carousel"><?php _e( 'Add to carousel', 'bre-bootstrap-ecommerce' ); ?></label>
			<input type="checkbox" name="bre_add_to_home_carousel" id="bre_add_to_home_carousel" value="yes" <?php checked( $bre_add_to_home_carousel ); ?> />
			<p class="description"><?php _e( 'Recommended size 1170px * 320px.<br />Background img has cover value, preserving the image’s original proportions the carousel area is completely covered by the image', 'bre-bootstrap-ecommerce' ); ?></p>

		</p>
		<p>
			<label for="bre_add_to_home_carousel"><?php _e( 'Background image', 'bre-bootstrap-ecommerce' ); ?>:</label>
			<br/>
			<?php if ( isset( $bre_image_for_carousel['url'] ) ) : ?>
			<a href="<?php echo $bre_image_for_carousel['url']; ?>" target="_blank"">
				<img width="266" height="207" alt="" class="attachment-post-thumbnail" src="<?php echo $bre_image_for_carousel['url']; ?>">
			</a>
			<label><?php _e( 'Delete Image', 'bre-bootstrap-ecommerce' ); ?> <input type="checkbox" name="bre_image_for_carousel-remove" value="yes" /></label><br/>
			<?php endif; ?>
			<input name="bre_image_for_carousel" id="bre_image_for_carousel" type="file" style="width:10em" />
			<p class="description"><?php _e( 'If you upload a new file, existing one will be deleted.', 'bre-bootstrap-ecommerce' ); ?></p>
			<p class="description"><?php _e( 'Remember to Save or Update to upload or delete the image.', 'bre-bootstrap-ecommerce' ); ?></p>
		</p>
	<?php }

	static function save_post( $post_id ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
		if ( ! wp_verify_nonce( isset( $_POST['bre_carousel_noncename'] ) ? $_POST['bre_carousel_noncename'] : '', 'bre_carousel_noncename' ) ) return $post_id;
		unset( $_POST['bre_carousel_noncename'] );
		update_post_meta( $post_id, 'bre_add_to_home_carousel', isset( $_POST['bre_add_to_home_carousel'] ) );
		if ( isset( $_FILES['bre_image_for_carousel'] ) && strlen( $_FILES['bre_image_for_carousel']['tmp_name'] ) > 0 ) {
			$upload = get_post_meta( $post_id, 'bre_image_for_carousel', true );
			if ( isset( $upload['file'] ) ) unlink( $upload['file'] );
			$upload = wp_handle_upload( $_FILES['bre_image_for_carousel'], array( 'test_form' => false ) );
			if ( isset( $upload['error'] ) && '0' != $upload['error'] ) {
				wp_die( __( 'There was an error uploading the file.', 'bre-bootstrap-ecommerce' ) );
			} else {
				update_post_meta( $post_id, 'bre_image_for_carousel', $upload );
			}
		} elseif ( isset( $_REQUEST['bre_image_for_carousel-remove'] ) ) {
			$upload = get_post_meta( $post_id, 'bre_image_for_carousel', true );
			if ( isset( $upload['file'] ) ) unlink( $upload['file'] );
			delete_post_meta( $post_id, 'bre_image_for_carousel' );
		}
	}

	static function delete_post( $post_id ) {
		if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;
		delete_post_meta( $post_id, 'bre_add_to_home_carousel' );
		delete_post_meta( $post_id, 'bre_image_for_carousel' );
	}
}

BREBoostrapCarouselMetabox::init();

function bre_is_added_to_home_carousel( $post_id ) {
	$bre_add_to_home_carousel = get_post_meta( $post_id, 'bre_add_to_home_carousel', true );
	if ( $bre_add_to_home_carousel == '' ) $bre_add_to_home_carousel = false;
	return $bre_add_to_home_carousel;
}

function bre_get_image_for_carousel( $post_id ) {
	$bre_image_for_carousel = get_post_meta( $post_id, 'bre_image_for_carousel', true );
	if ( $bre_image_for_carousel == '' ) $bre_image_for_carousel = false;
	return $bre_image_for_carousel;
}
