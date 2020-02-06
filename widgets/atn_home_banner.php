<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Widget_ATN_Home_Banner extends Widget_Base {
    
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'bqhomebanner';
    }
    
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Banner Home', 'plugin-name' );
    }
    
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fas fa-file-code';
    }
    
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
//         return [ 'atn-movistar-widgets' ];
        return [ 'atn-movistar-home' ];
    }
    
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
            );
        
        $this->add_control(
            'slogan',
            [
                'label' => __( 'título slogan', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( '', 'plugin-domain' ),
            ]
            );
        
        $this->add_control(
            'parrafo',
            [
                'label' => __( 'Parrafo', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'Texto cuentanos...', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        $this->add_control(
            'enlace_boton',
            [
                'label' => __( 'Enlace botón', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( '', 'plugin-domain' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
            );
        $this->add_control(
            'imagen_fondo_XL',
            [
                'label' => __( 'Choose Image XL', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_fondo_LG',
            [
                'label' => __( 'Choose Image LG', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_fondo_MD',
            [
                'label' => __( 'Choose Image MD', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_fondo_SM',
            [
                'label' => __( 'Choose Image SM', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_fondo_XS',
            [
                'label' => __( 'Choose Image XS', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'titulo_icono', [
                'label' => __( 'Title', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'servicio', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'icono', [
                'label' => __( 'Icono servicio', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true,
            ]
            );
        
        
        $this->add_control(
            'servicios',
            [
                'name' => 'titulo_icono',
                'label' => __( 'Repeater List', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ titulo_icono }}}',
            ]
            );
        
        
       
        
        $this->end_controls_section();
        
    }
    
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        
       $settings = $this->get_settings_for_display();
//        //debugeo
//        echo "<pre>";
//        var_dump($settings);
//        echo "</pre>";
//        //debugeo

       $html = "";
       $html.= '<!-- Cabecera -->
        		<div class="cabecera">
        			<div class="imagenCabecera">
        				<picture>
        					<source media="(min-width: 1200px)" srcset="'.$settings["imagen_fondo_XL"]["url"].'">
        					<source media="(min-width: 992px)" srcset="'.$settings["imagen_fondo_LG"]["url"].'">
        					<source media="(min-width: 768px)" srcset="'.$settings["imagen_fondo_MD"]["url"].'">
        					<source media="(min-width: 576px)" srcset="'.$settings["imagen_fondo_SM"]["url"].'">
        					<img src="'.$settings["imagen_fondo_XS"]["url"].'" alt="Fondo cabecera" title="Fondo cabecera">
        				</picture>
        			</div>
        			<div class="textoCabecera">'.$settings["slogan"].'
        				<div class="servicios">';
                           foreach ( $settings['servicios'] as $index => $item ) {
                               $html.=' <div class="servicio-item">
                                            <img src="'.$item["icono"]["url"].'" 
                                                alt="'.$item["titulo_icono"].'" 
                                                title="'.$item["titulo_icono"].'">
                                           <p>'.$item["titulo_icono"].'</p>
                                       </div>';
                           }
        					$html.='
        				</div>
        				<p>'.$settings["parrafo"].'</p>
        				<a href="'.$settings["enlace_boton"]["url"].'" 
                            class="boton botonVerde" 
                            title="Comenzar con el recomendador">Comenzar ahora</a>
        			</div>
        		</div>
        		<!-- Cabecera -->';
       echo $html;

         

    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Home_Banner() );