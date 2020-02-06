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
class Widget_ATN_Soluciones_Sector_Todas_Soluciones extends Widget_Base {
    
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
        return 'bqsolucionessectortodassoluciones';
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
        return __( 'Soluciones Sector Todas las Soluciones', 'plugin-name' );
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
            'titulo_solucion', [
                'label' => __( 'Título solución', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( '', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'parrafo', [
                'label' => __( 'Slogan', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'slogan', 'plugin-name' ),
            ]
            );
        
        $repeater->add_control(
            'icono',
            [
                'label' => __( 'Seleccionar icono', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
                'title_field' => '{{{ titulo_solucion }}}',
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

        $html.='<!-- Todas las soluciones -->
        		<div class="todasSoluciones">
        			<h2 class="tituloSeccion">'.$settings["titulo"].'</h2>
        			<div class="container">
        				<div class="row">';
        foreach ( $settings['servicios'] as $index => $item ) {
            $html.=         '	<div class="bloqueSolucion col-sm-6 col-md-4 col-lg-3">
        						  <div class="solucion">
                                        <img src="'.$item["icono"]["url"].'" alt="'.$item["titulo_solucion"].'">
                                        <p>'.$item["titulo_solucion"].'</p>
        							     <p>'.$item["parrafo"].'</p>
                                  	</div>						
        					     </div>  
                            ';
        }
        					
        					
        $html.= '        					
        				</div>
        			</div>
        		</div>
        		<!-- Todas las soluciones -->';
        
      
               
       echo $html;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Soluciones_Sector_Todas_Soluciones() );