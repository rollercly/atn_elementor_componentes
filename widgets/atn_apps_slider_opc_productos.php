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
class Widget_ATN_Apps_Slider_Opc_Productos extends Widget_Base {
    
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
        return 'bqappsslideropcionesproductos';
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
        return __( 'Bloque Apps Opciones Productos', 'plugin-name' );
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
                'default' => __( 'opcionesSlider-', 'elementor' ),
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
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => __( '', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'tipo_producto',
            [
                'label' => __( 'Tipo de Producto', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( '---', 'plugin-domain' ),
                    'Recomendado' => __( 'Recomendado', 'plugin-domain' ),
                ],
            ]
            );
        $repeater->add_control(
            'titulo_card', [
                'label' => __( 'Título Tarjeta', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
            );
        
        $repeater->add_control(
            'caracteristicas',
            [
                'label' => __( 'Características', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'Default description', 'plugin-domain' ),
                'placeholder' => __( 'Introduce las características en modo lista (ul/li)', 'plugin-domain' ),
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
//         echo "<pre>";
//         var_dump($settings);
//         echo "</pre>";
//         die();
        
        $id = "elemento_".$this->get_id();
        $cont = 0;

		$html = "";
		$claseactivo ="";
		if ($settings["id_opcion_slider"] == 'opcionesSlider-1'){
		    $claseactivo = 'active';
		}
		$html.= '
			<div id="'.$settings["id_opcion_slider"].'" class="mistarjeteros slide '.$claseactivo.'">
				<div class="container">
					<div class="template-carousel-owl owl-carousel owl-theme owl-loaded">
						<div class="owl-stage-outer">
							<div class="owl-stage">
								';
								foreach ( $settings['list'] as $index => $item ) {
								    $cont++;
    		                        $unico = $id.$cont;
// 								    echo "<pre>";
// 								    var_dump($item['caracteristicas']);
// 								    echo "</pre>";
								    // call function to convert
								   
								    								    
									$html.='<div class="owl-item active">';
    									$classes = '';
    									if ($item["tipo_producto"] == 'Recomendado'){
    										$classes = 'recomendado';
    									}
    									$html.= '<div class="'.$classes.' card-item">';
        									$html.= '<h3>
        												';
        									if ($item["tipo_producto"] == 'Recomendado'){
        										$html.= '<span>recomendado</span>';
        									}
        									$html.=$item["titulo_card"].'</h3>
        										<div class="detalleCard">
        											<div>';
        											//$html.=$item['caracteristicas'];
        											$elementos =ul_to_array($item['caracteristicas']);
        											$html.='<ul>';
        											for($i = 0; $i < count($elementos); $i++) {
            											if ($i > 3){
//             											    $html.= '<div class="collapse" id="'.$unico.'">';
            											    $html.= '<div class="collapse" id="todascaracteristicas">';
            											}
        											    $html.= "<li>".$elementos[$i]."</li>";
        											}
        											if ($i > 3){
        											     $html.= '</div>';
        											}
        											$html.= '</ul>';
        											//$html.=''<a class="triggerCaract" href="#'.$unico.'"';
        											$html.='
             												
            												<a class="triggerCaract" href="#todascaracteristicas"';
        											$html.='
            													data-toggle="collapse" 
            													aria-expanded="false" 
            													aria-controls="caracteristicasOcultas" 
            													title="Todas las características">
            														<span class="collapsed">Mostrar todo</span>
            														<span class="expanded">Mostrar menos</span>
            												</a>
        											</div>
            										<div>
        												<p class="precio-item">'.$item['precio'].'</p>
        												<!-- Al hacer click se vería la modal para cada producto -->
        												<button data-toggle="modal" data-target="#modalContratacion">Lo quiero</button>
            										</div>
    										  </div>
        										
        									</div>
    								</div>';
								}
                                
									
		$html.='
							</div>
						</div>
					</div>	
				</div>
			</div>	
        ';
       
        

        echo $html;
       
        
    } 

}

/*
 * Función propia para convertir un ul a una array, para poder tratarlo más tarde
 */
// convert html > ul > li to a PHP array
function ul_to_array ($ul) {
    if (is_string($ul)) {
        // encode ampersand appropiately to avoid parsing warnings
        $ul=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $ul);
        if (!$ul = simplexml_load_string($ul)) {
            trigger_error("Syntax error in UL/LI structure");
            return FALSE;
        }
        return ul_to_array($ul);
    } else if (is_object($ul)) {
        $output = array();
        foreach ($ul->li as $li) {
            $output[] = (isset($li->ul)) ? ul_to_array($li->ul) : (string) $li;
        }
        return $output;
    } else return FALSE;
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Apps_Slider_Opc_Productos() );