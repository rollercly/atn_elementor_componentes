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
class Widget_ATN_Home_Puntos_Movistar extends Widget_Base {
    
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
        return 'bqhomepuntosmovistar';
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
        return __( 'Home Puntos Movistar', 'plugin-name' );
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
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( '', 'plugin-domain' ),
            ]
            );
             
        
        $this->add_control(
            'imagenfondo',
            [
                'label' => __( 'Elegir imagen de fondo', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
       
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'titulo_apartado', [
                'label' => __( 'Título apartado', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'título apartado', 'plugin-name' ),
            ]
            );
        
        $repeater->add_control(
            'caracteristicas', [
                'label' => __( 'Características', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'características', 'plugin-name' ),
            ]
            );
        
        $this->add_control(
            'list',
            [
                'label' => __( 'Servicios', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ titulo_apartado }}}',
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
       $html.= '<!-- Movistar acompaña -->
        		<!--
                <div class="destacadoVerde" style="background-image: url(https://cnnespanol2.files.wordpress.com/2019/12/s_64a163f……3cbbfcf…_1573501883482_ap_19001106049831-1.jpg);">
                -->
        		<div class="destacadoVerde">
        			<div class="container">
        				<h2 class="tituloSeccion">'.$settings["slogan"].'</h2>
        				<div class="row">
        					<div class="col-lg-8">
        						<div class="row">';
       $cont = 1;
//        //
//        echo "<pre>";
//        var_dump($settings['list']);
//        echo "</pre>";
//        //
       
       foreach ( $settings['list'] as $index => $item ) {
           $html.= '
        							<div class="bloqueDestacado col-sm-6">
        								<div class="num">'.$cont.'</div>
        								<div class="acciones">
        									<p>'.$item["titulo_apartado"].'</p>
        									<p>'.$item["caracteristicas"].'</p>
        								</div>
        							</div>
                    ';
           $cont++;
       }
        
        
//         if ( $settings['list'] ) {
//             foreach (  $settings['list'] as $item ) {
//                 $html.= '   <div class="bloqueDestacado col-sm-6">
//                                 <div class="num">n</div>
//                                 <div class="acciones">
//                                    <p>'.$item["titulo_apartado"].'</p>
//          						   <p>'.$item["caracteristicas"].'</p>
//          						</div>
//          					</div>';
            
//             }
            
//         }
       
        $html.= '
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        		<!-- Movistar acompaña -->';
        echo $html;

    }
    
    
   
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Home_Puntos_Movistar() );