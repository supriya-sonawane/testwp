<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.sinelogix.com/
 * @since      1.0.0
 *
 * @package    Episode
 * @subpackage Episode/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Episode
 * @subpackage Episode/admin
 * @author     Rucha Parmar <rucha.parmar@sinelogix.com>
 */
class Episode_Admin {

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

		add_filter( 'template_include', array($this,'episode_arch_templates') );

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
		 * defined in Episode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Episode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/eisode-admin.css', array(), $this->version, 'all' );

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
		 * defined in Episode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Episode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/eisode-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function episode_arch_templates( $template ) {

		    $category = get_queried_object();

		    if ($category->slug  == 'eisode' && file_exists( plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-episode.php' ) ){
		        $template = plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-episode.php';
		    }

		     if ( is_singular( $post_types ) && file_exists( plugin_dir_path(dirname(__FILE__)) . 'public/partials/single-episode.php' ) ){
        		$template = plugin_dir_path(dirname(__FILE__)) . 'public/partials/single-episode.php';
  			}

		    return $template;
	}
}

// add_filter( 'template_include', 'sponsor_plugin_templates' );
// function sponsor_plugin_templates( $template ) {

//     $post_types = array( 'sponsor' );
//     	echo plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-sponsor.php';//exit;

//     if ( is_post_type_archive( 'sponsor' ) && file_exists( plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-sponsor.php' ) ){
//     	exit;

//         $template = plugin_dir_path(dirname(__FILE__)) . 'public/partials/archive-sponsor.php';
//     }

//     if ( is_singular( $post_types ) && file_exists( plugin_dir_path(dirname(__FILE__)) . 'public/partials/single-sponsor.php' ) ){
//         $template = plugin_dir_path(dirname(__FILE__)) . 'public/partials/single-sponsor.php';
//     }

//     return $template;
// }

