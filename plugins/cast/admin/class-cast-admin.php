<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.sinelogix.com/
 * @since      1.0.0
 *
 * @package    Cast
 * @subpackage Cast/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cast
 * @subpackage Cast/admin
 * @author     Rucha Parmar <rucha.parmar@sinelogix.com>
 */
class Cast_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cast_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cast_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cast-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style($this->plugin_name.'my', plugin_dir_url(__FILE__) . 'css/wp-gallery-metabox-admin.css', array(), $this->version, 'all');
        wp_enqueue_style('custm_wp_gallery_metabox', plugin_dir_url(__FILE__) . 'css/custm_wp_gallery_metabox.css', '', time());
        wp_enqueue_style('gallery-metabox_cstm_css', plugin_dir_url(__FILE__) . 'css/gallery-metabox.css', '', time());

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cast_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cast_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script($this->plugin_name.'my', plugin_dir_url(__FILE__) . 'js/wp-gallery-metabox-admin.js', array('jquery'), $this->version, false);
        wp_enqueue_script('gallery_metabox_cstm_js', plugin_dir_url(__FILE__) . 'js/gallery-metabox.js', '', time());
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cast-admin.js', array( 'jquery' ), $this->version, false );

	}


}

add_filter( 'template_include', 'my_plugin_templates' );
function my_plugin_templates( $template ) {

    $post_types = array( 'cast' );
// echo plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-cast.php';exit;
    if ( is_post_type_archive( $post_types ) && file_exists( plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-cast.php' ) ){
        $template = plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-cast.php';
    }

    if ( is_singular( $post_types ) && file_exists( plugin_dir_path(dirname(__FILE__)) . 'public/partials/single-cast.php' ) ){
        $template = plugin_dir_path(dirname(__FILE__)) . 'public/partials/single-cast.php';
    }

    return $template;
}

/*
 * Add a meta box
 */
add_action( 'admin_menu', 'misha_meta_box_add' );
 
function misha_meta_box_add() {
	add_meta_box(
			'gallery-metabox',
			'Gallery', 
			'gallery_meta_callback', 
			'cast', 
			'normal', 
			'high'
	);
}
 
/*
 * Meta Box HTML
 */
function gallery_meta_callback($post) {
	wp_nonce_field(basename(__FILE__), 'gallery_meta_nonce');
	$ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
	?>
	<table class="form-table">
		<tr>
			<td>
				<a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Add image(s)</a>
				<ul id="gallery-metabox-list">
					<?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
							<li>
								<input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
								<img class="image-preview" src="<?php echo $image[0]; ?>">
								<a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
								<small><a class="remove-image" href="#">Remove image</a></small>
							</li>
							<?php
						endforeach;
					endif;
					?>
				</ul>
			</td>
		</tr>
	</table>
	<?php
}

 
/*
 * Save Meta Box data
 */
add_action('save_post', 'gallery_meta_save');
 
function gallery_meta_save($post_id) {
	if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__)))
		return;

	if (!current_user_can('edit_post', $post_id))
		return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	if (isset($_POST['vdw_gallery_id'])) {
		update_post_meta($post_id, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
	} else {
		delete_post_meta($post_id, 'vdw_gallery_id');
	}
}