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
class Widget_ATN_Soluciones_Bloque_Imagenes extends Widget_Base {
    
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
        return 'solucionesbqimagenes';
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
        return __( 'Soluciones Bloque Imagenes', 'plugin-name' );
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
        return [ 'atn-movistar-soluciones-sector' ];
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
            'more_options',
            [
                'label' => __( 'Opciones del Widget', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'title' => "título del widget,"
            ]
            );
        
        
        $this->add_control(
            'titulo',
            [
                'label' => __( 'Título', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'título', 'elementor' ),
                'label_block' => true,
            ]
            );
       
        $this->add_control(
            'descripcion',
            [
                'label' => __( 'Descripción', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( '', 'plugin-domain' ),
            ]
            );
        //repeater
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'enlace',
            [
                'label' => __( 'URL to embed', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'input_type' => 'url',
                'placeholder' => __( '', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'titulo_texto',
            [
                'label' => __( 'Título', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'Enter your title', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        $repeater->add_control(
            'slogan_texto',
            [
                'label' => __( 'Slogan', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '' ),
                'placeholder' => __( '', 'elementor' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => true,
            ]
            );
        
        $repeater->add_control(
            'imagen_fondo_XL',
            [
                'label' => __( 'Choose Image XL', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_fondo_LG',
            [
                'label' => __( 'Choose Image LG', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_fondo_MD',
            [
                'label' => __( 'Choose Image MD', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_fondo_SM',
            [
                'label' => __( 'Choose Image SM', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_fondo_XM',
            [
                'label' => __( 'Choose Image XM', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_fondo_XS',
            [
                'label' => __( 'Choose Image XS', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        
        $this->add_control(
            'list',
            [
                'name' => 'titulo_servicio',
                'label' => __( 'Servicio Soluciones', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ titulo_texto }}}',
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
       $html.= '<!-- Soluciones por sector -->
        		<div class="soluciones">
        			<h2 class="tituloSeccion">'.$settings["titulo"].'</h2>
        			<div class="container">
        				<p>'.$settings["descripcion"].'</p>
        				<div class="row">';
       foreach ( $settings['list'] as $index => $item ) {
         
           $html.= '<div class="fichaSector col-lg-6">';
        						
//         						<a href="'.$item["enlace"]["url"].'" title="'.$item["titulo_texto"].'">
			
        	$target = $item['enlace']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $item['enlace']['nofollow'] ? ' rel="nofollow"' : '';
			$html.= '<a href="' . $item['enlace']['url'] . '"' . $target . $nofollow . ' title="'.$item["titulo_texto"].'">';
        						
            $html.= '   			<picture>
        								<source media="(min-width: 1200px)" srcset="'.$item["imagen_fondo_XL"]["url"].'">
        								<source media="(min-width: 992px)" srcset="'.$item["imagen_fondo_LG"]["url"].'">
        								<source media="(min-width: 768px)" srcset="'.$item["imagen_fondo_MD"]["url"].'">
        								<source media="(min-width: 576px)" srcset="'.$item["imagen_fondo_SM"]["url"].'">
        								<source media="(min-width: 376px)" srcset="'.$item["imagen_fondo_XM"]["url"].'">
        								<img src="'.$item["imagen_fondo_XS"]["url"].'" alt="'.$item["titulo_texto"].'" title="'.$item["titulo_texto"].'">
        							</picture>
        							<div class="descripcionSector">
        								<p>'.$item["titulo_texto"].'</p>
        								<h3>'.$item["slogan_texto"].'</h3>
        							</div>							
        						</a>
        					</div>';
       }

        					
        					
        $html.='					
        				</div>
        			</div>
        		</div>
        		<!-- Soluciones por sector -->';
       echo $html;

    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Soluciones_Bloque_Imagenes() );