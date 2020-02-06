<?php
/**
 * Plugin Name:			ATN Elementor Componentes
 * Plugin URI:			https://www.soprasteria.es/sobre-nosotros/oficinas/implantation-detail/bilbao
 * Description:			Componentes específicos para ATN movistar
 * Version:				1.0.0
 * Author:				Jose Lorenzo
 * Author URI:			https://www.soprasteria.es/sobre-nosotros/oficinas/implantation-detail/bilbao
 
 *
 * @package RT_Elementor_Widgets
 * @author Rigorous Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ATN Elementor Componentes
 */
if ( ! class_exists( 'ATN_Elementor_Componentes' ) ) :

/**
 * RT Elementor Compatibility
 *
 * @since 1.0.0
 */
class ATN_Elementor_Componentes {
    
    /**
     * Member Variable
     *
     * @var object instance
     */
    private static $instance;
    
    /**
     * Initiator
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct() {

        
        add_action( 'plugins_loaded', array( $this, 'admin_notice' ), 11 );
        
        // Add locations.
        add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );
        
        add_action( 'elementor/init', [ $this, 'register_category' ] );
        
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
        
        // Register Elementor Widget Scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
        
//         // Register Elementor Widget Style
         add_action( 'elementor/frontend/after_register_styles', array( $this, 'widget_styles' ) );
    }
    

    /*
     * Función de error sino existe el plugin de elementor
     */
    public function admin_notice() {
        if( ! defined('ELEMENTOR_PATH') && ! class_exists('Elementor\Widget_Base')) { ?>
				<div class="error">
					<p><?php esc_html_e( 'Atn Elementor Widgets está activo pero al depender de elementor, no está activo. Active primero plugin de elementor para poder trabajar con el widget.', 'atn-elementor-widgets' ); ?></p>
				</div>
			<?php }
		}		


		/**
		 * Register Locations
		 *
		 * @since 1.0.0
		 * @param object $manager Location manager.
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();
		}	

		/**
		 * Register Elementor Category
		 *
		 *
		 */
		public function register_category()	{
//            // Register widget block category for Elementor section
			\Elementor\Plugin::instance()->elements_manager->add_category('atn-movistar-widgets', array('title' => esc_html__( 'ATN MOVISTAR WIDGETS GENERALES', 'atn-movistar-widgets' ),), 1 );
			\Elementor\Plugin::instance()->elements_manager->add_category('atn-movistar-home', array('title' => esc_html__( 'ATN MOVISTAR WIDGETS HOME', 'atn-movistar-home' ),), 2 );
			\Elementor\Plugin::instance()->elements_manager->add_category('atn-movistar-soluciones-sector', array('title' => esc_html__( 'ATN MOVISTAR SOLUCIONES SECTOR', 'atn-movistar-soluciones-sector' ),), 3 );
			\Elementor\Plugin::instance()->elements_manager->add_category('atn-movistar-familias', array('title' => esc_html__( 'ATN MOVISTAR FAMILIAS', 'atn-movistar-familias' ),), 4 );
			\Elementor\Plugin::instance()->elements_manager->add_category('atn-movistar-productos', array('title' => esc_html__( 'ATN MOVISTAR PRODUCTOS', 'atn-movistar-productos' ),), 5 );
			\Elementor\Plugin::instance()->elements_manager->add_category('atn-movistar-contacto', array('title' => esc_html__( 'ATN MOVISTAR CONTACTO', 'atn-movistar-contacto' ),), 6 );
			
		}


		/**
		 * Registers widgets scripts
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function widget_scripts() {
		    wp_register_script( 'atn-apps-slider', plugins_url( '/assets/js/atn-apps-slider.js', __FILE__ ), [ 'jquery' ], false, true );
		    
		    wp_register_script( 'atn-bloques-planes', plugins_url( '/assets/js/atn-bloques-planes.js', __FILE__ ), [ 'jquery' ], false, true );
		    
		    //js recomendador --> editar_cuestionario_recomendador
		    wp_register_script( 'atn-home-recomendador', plugins_url( '/assets/js/atn-home-recomendador.js', __FILE__ ), [ 'jquery' ], false, true );

		}
		/**
		 * Registers Style
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function widget_styles() {			
 			wp_enqueue_style( 'atn-caract-prod-style', plugins_url( '/assets/css/atn_caracteristicas_productos.css', __FILE__ ) );
 			
		}					

		/**
		 * Register Elementor Widget
		 *
		 */	
		public function register_widgets() {	
			//pruebas
		    require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_mis_pruebas.php' );
		    
			//home
		    require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_home_banner.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_home_puntos_movistar.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_home_recomendador.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_home_informe_recomendador.php' );
			
			//familias
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_familias_caracteristicassectortres.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_familias_caracteristicassectordos.php' );
			
			//soluciones
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_bloque_imagenes.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_enlace_simple.php' );
			
			//otros
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_banner_hero_familias_distintos_imgs.php' );
		    require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_apps_slider.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_apps_slider_pestanias.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_bloques_planes.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_caracteristicas_productos.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_productos_video.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_apps_slider_opc_productos.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_start_acordeon.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_sector.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_sector_cabecera.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_sector_medio.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_sector_datos.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_sector_todas_soluciones.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_pestaniasn2.php' );
			
			//contacto
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_contacto_cabecera.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_contacto_lateral_dcho.php' );
			
			
// 			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_soluciones_sector_3columnas.php' );
			//require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_end_acordeon.php' );
			
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_bloques_soluciones_sector.php' );
			


// 			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_banner_hero_familias.php' );
// 			require_once(plugin_dir_path( __FILE__ ) .'/widgets/atn_pruebas.php' );
			 
		}			

		
	}


endif;
