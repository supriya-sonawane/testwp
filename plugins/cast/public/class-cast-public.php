<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.sinelogix.com/
 * @since      1.0.0
 *
 * @package    Cast
 * @subpackage Cast/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cast
 * @subpackage Cast/public
 * @author     Rucha Parmar <rucha.parmar@sinelogix.com>
 */
class Cast_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		/* Filter the single_template with our custom function*/
		add_filter('single_template', array($this,'my_custom_template'));

		add_filter( 'template_include', array($this,'cast_arch_templates' ));

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( 'carousel', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'carousel-theme', plugin_dir_url( __FILE__ ) . 'css/owl.theme.default.min.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cast-public.css', array(), $this->version, 'all' );
		
		//$bootstrap = locate_template( 'bootstrap.min.css' );
		//$carousel = locate_template( 'owl.carousel.min.css' );
	    //if ($bootstrap != '' ) {
			// wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), 1.0, 'all' );
		//}
		
		
	   // if ($carousel != '' ) {
			
		//}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		wp_enqueue_script( 'carousel', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'carousel-init', plugin_dir_url( __FILE__ ) . 'js/owl_init.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cast-public.js', array('jquery','carousel' ), $this->version, false );
		
	}


	public function my_custom_template($template) {
	    global $post;


	    if ( 'cast' === $post->post_type && locate_template( array( 'single-cast.php' ) ) !== $template ) {
	        /*
	         * This is a 'cast' post
	         * AND a 'single cast template' is not found on
	         * theme or child theme directories, so load it
	         * from our plugin directory.
	         */
	        return plugin_dir_path( __FILE__ ) . '/partials/single-cast.php';
	    }

    	return $template;
	}

	public function cast_arch_templates( $template ) {
	    $post_types = array( 'cast' );

	    if ( is_post_type_archive( $post_types ) && file_exists( plugin_dir_path(__FILE__) . '/partials/archive-cast.php' ) ){
	        $template = plugin_dir_path(__FILE__) . '/partials/archive-cast.php';
	    }

	    return $template;
	}

}

