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
class Widget_ATN_Soluciones_Sector_Datos extends Widget_Base {
    
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
        return 'bqsolucionessectordatos';
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
        return __( 'Soluciones Sector Datos', 'plugin-name' );
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
        return [ 'atn-movistar-soluciones-sector' ];
    }
    
    protected function _register_controls() {
        
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'placeholder' => __( 'Título', 'elementor' ),
                'label_block' => true,
            ]
            );
        
       
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'numero', [
                'label' => __( 'Número', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'Número', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'slogan', [
                'label' => __( 'Slogan', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'slogan', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'autor', [
                'label' => __( 'Autor', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'Autor', 'plugin-name' ),
            ]
            );
        
        //repeater
        
        $this->add_control(
            'servicios',
            [
                'name' => 'experiencias',
                'label' => __( 'Experiencias', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ autor }}}',
            ]
            );
        
      
       
       
        $this->end_controls_section();
        
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
//         echo $settings['texto_slogan'];
        $id = "elemento_".$this->get_id();
        
//         echo "<pre>";
// // //     var_dump($this);
//         var_dump($settings['imagen_fondo_XL']['url']);
//         echo "</pre>";
        
      
        $html = '';

       $html.='<!-- Situaciones -->
        		<!-- Datos sector -->
        		<div class="datosSector">
        			<div class="container">
        				<h2 class="tituloSeccion">'.$settings["titulo"].'</h2>
                        <div class="bloqueDatos">';
       
       foreach ( $settings['servicios'] as $index => $item ) {
           $html.= '	<div class="dato">
    						<p>'.$item["numero"].'</p>
    						<p>'.$item["slogan"].'</p>
    						<p>Fuente: '.$item["autor"].'</p>
    					</div>
    					
    				';
       }
        				
        				
        				
        $html.='        </div>
        			</div>
        		</div>
        		<!-- Datos sector -->';
        
               
       echo $html;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Soluciones_Sector_Datos() );