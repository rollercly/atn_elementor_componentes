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
class Widget_ATN_Caracteristicas_Productos extends Widget_Base {
    
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
        return 'bqcaracteristicasproductos';
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
        return __( 'Bloque Características Productos', 'plugin-name' );
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
        return [ 'atn-movistar-productos' ];
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
        
        $this->add_control(
            'descripcion',
            [
                'label' => __( 'Descripción', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( 'Introduce aquí la descripción del producto', 'plugin-domain' ),
            ]
        );
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'caracteristica', [
                'label' => __( 'Característica', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
            );
        
        $this->add_control(
            'caracteristicas',
            [
                'label' => __( 'Características Producto', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ caracteristica }}}',
            ]
            );
        
        $this->add_control(
            'imagen_XL',
            [
                'label' => __( 'Choose Image XL', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_LG',
            [
                'label' => __( 'Choose Image LG', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_MD',
            [
                'label' => __( 'Choose Image MD', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_SM',
            [
                'label' => __( 'Choose Image SM', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_XS',
            [
                'label' => __( 'Choose Image XS', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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


       $html = '';
       $html.= '<div class="caracteristicaProducto">';
            $html.= '<div class="row">';
                $html.= '<div class="col-lg-5 descripcionProducto">';
                    $html.= '<h3>'.$settings["titulo_texto"].'</h3>';
                    $html.= '<p>'.$settings["descripcion"].'</p>';
                    $html.= '<ul>';
                    foreach (  $settings['caracteristicas'] as $item ) {
                        $html.= '<li>'.$item['caracteristica'] .'</li>';
                    }
                    $html.= '</ul>';
                $html.= '</div>';
                $html.= '<div class="col-lg-7">';
                        $html.= '<picture>
        						<source media="(min-width: 1200px)" srcset="'.$settings['imagen_XL']['url'].'">
        						<source media="(min-width: 992px)" ssrcset="'.$settings['imagen_LG']['url'].'">
        						<source media="(min-width: 768px)" srcset="'.$settings['imagen_MD']['url'].'">
        						<source media="(min-width: 576px)" srcset="'.$settings['imagen_SM']['url'].'">
        						<img src="'.$settings['imagen_XS']['url'].'" alt="'.$settings["titulo_texto"].'" title="'.$settings["titulo_texto"].'">
        					</picture>';
                $html.= '</div>';
            $html.= '</div>';
       $html.= '</div>';
       echo $html;
         

    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Caracteristicas_Productos() );