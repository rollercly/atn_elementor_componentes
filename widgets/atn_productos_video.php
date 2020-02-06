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
class Widget_ATN_Productos_Video extends Widget_Base {
    
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
        return 'bqproductosvideo';
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
        return __( 'Bloque Productos Vídeo', 'plugin-name' );
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
        return [ 'atn-movistar-widgets' ];
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
            'url_video',
            [
                'label' => __( 'Url de vídeo', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://www.youtube.com/embed/t--HyNmyonY', 'plugin-domain' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
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
     
        

        $html ='';
        $html .='<div class="row">
					<div class="col-lg-6 descripcionProducto">
						<h2 class="tituloSeccion">'.$settings["titulo_texto"].'</h2>
						<p>'.$settings["descripcion"].'</p>';
                        $html.= '<ul>';
                        foreach (  $settings['caracteristicas'] as $item ) {
                            $html.= '<li>'.$item['caracteristica'] .'</li>';
                        }
                        $html.= '</ul>';
          $html.='</div>
					<div class="col-lg-6">
						<iframe title="'.$settings["titulo_texto"].'" 
                            width="560" height="315" src="'.$settings["url_video"]["url"].'" 
                            frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
                        </iframe>
					</div>
				</div>';
       
       
       echo $html;
         

    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Productos_Video() );