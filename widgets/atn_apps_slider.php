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
class Widget_ATN_Apps_Slider extends Widget_Base {
    
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
        return 'bqappsslideropciones';
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
        return __( 'Bloque Apps Slider Opciones', 'plugin-name' );
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
    
   /*
    * dependencias javascript
    */
    public function get_script_depends() {
        return [ 'atn-apps-slider'];
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
            'id_opcion_slider',
            [
                'label' => __( 'id opción slider', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'opcionesSlider-1', 'elementor' ),
                'label_block' => true,
            ]
            );
        $this->add_control(
            'texto_enlace',
            [
                'label' => __( 'texto enlace', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'Ver todas las soluciones >', 'elementor' ),
                'label_block' => true,
            ]
            );
        $this->add_control(
            'url_enlace',
            [
                'label' => __( 'url enlace', 'elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => true,
                ],
                'placeholder' => __( '', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'titulo_card', [
                'label' => __( 'Título Tarjeta', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
            );
        
        $repeater->add_control(
            'descripcion_card', [
                'label' => __( 'Descripción Tarjeta', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
            );
        
        $repeater->add_control(
            'precio', [
                'label' => __( 'Precio', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
            );
        
        $repeater->add_control(
            'loquiero', [
                'label' => __( 'Lo quiero', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
            );
        
        $repeater->add_control(
            'ver_detalle', [
                'label' => __( 'ver detalle', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
            );
        
         
        $this->add_control(
            'list',
            [
                'label' => __( 'Tarjetas', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ titulo_card }}}',
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
        $id = "elemento_".$this->get_id();
        $html ='';
        $clases = "";
        if ($settings["id_opcion_slider"] == "opcionesSlider-1"){
            $clases = "active" ;
        }
        $html .='<div id="'.$settings["id_opcion_slider"].'" class="mistarjeteros slide '.$clases.'">
        			<div class="container">
        				<div class="template-carousel-owl owl-carousel owl-theme owl-loaded owl-drag">
        				    <div class="owl-stage-outer">
        				        <div class="owl-stage" style="width: 1280px; transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
        				            ';
        
        
        foreach (  $settings['list'] as $item ) {
                   // echo "<pre>".var_dump($item)."</pre>";
                    
                    $html.= '<div class="owl-item active" style="width: auto;">';
                    $html .= '<div class="card-item">';
                    $html .= '  <h3>'.$item["titulo_card"].'</h3>';
                    $html .= '  <div class="detalleCard">
        							<div>
        								<p class="descripcion-item">';
                    $html .=                $item["descripcion_card"];
                    $html .=            '</p>
                                    </div>
                                    <div>
                                         <p class="precio-item">';
                                              $html .= $item["precio"];
                    $html.=             '</p>';
                    $html.=         '
                                        <button data-toggle="modal" data-target="#modalContratacion" 
                                            data-producto="'.$item["titulo_card"].'" 
                                            data-precio="'.$item["precio"].'">Lo quiero</button>
                                     ';
//                     $html.=             '<a href="'.$item["ver_detalle"]["url"].'" title="Ver detalle">Ver detalle &gt;</a>';
                    
                    $target = $item['ver_detalle']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $item['ver_detalle']['nofollow'] ? ' rel="nofollow"' : '';
                    $html.= '<a href="' . $item['ver_detalle']['url'] . '"' . $target . $nofollow . ' title="Ver detalle">Ver detalle &gt;</a>';
                    
                    $html.=         '</div>';
                    $html.=     '</div>';
                    $html.= '</div>';
                    $html .= '  </div>';
             
        }
                            
                        
                        $html .= '  </div>';
                    $html .= '  </div>';
                $html.=     '</div>';
                
                $target = $settings['url_enlace']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $settings['url_enlace']['nofollow'] ? ' rel="nofollow"' : '';
                $html.= '<a href="' . $settings['url_enlace']['url'] . '"' . $target . $nofollow . ' title="'.$settings["texto_enlace"].'">'.$settings["texto_enlace"].'</a>';
    
//                 $html.='<a href="'.$settings["url_enlace"]["url"].'" title="'.$settings["texto_enlace"].'">'.$settings["texto_enlace"].'</a>	';
            $html.=     '</div>';
        $html.=     '</div>';
        echo $html;
       
        
    } 

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Apps_Slider() );