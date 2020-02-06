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
class Widget_ATN_Familias_Caracteristicassectoresdos extends Widget_Base {
    
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
        return 'bqcaracsectordos';
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
        return __( 'Familia Características Sector Dos', 'plugin-name' );
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
        return [ 'atn-movistar-familias' ];
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
            'fongris',
            [
                'label' => __( 'Fondogris', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'your-plugin' ),
                'label_off' => __( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
            );
        $this->add_control(
            'numero',
            [
                'label' => __( 'Número', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'Número', 'elementor' ),
                'label_block' => true,
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
        
        $this->add_control(
            'descripcion',
            [
                'label' => __( 'Descripción', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( 'Descripción', 'plugin-domain' ),
            ]
            );
        
        
        $this->add_control(
            'enlace',
            [
                'label' => __( 'Enlace', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( '', 'plugin-domain' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
            );
        
        
        $this->add_control(
            'imagen',
            [
                'label' => __( 'Seleccionar imagen', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
       

        ////////////////////////////////
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'tit_car', [
                'label' => __( 'Título Característica', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'Título Característica', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'desc_car', [
                'label' => __( 'Descripción Características', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( 'Descripción Características', 'plugin-domain' ),
            ]
            );
        $repeater->add_control(
            'enlace_car',
            [
                'label' => __( 'Enlace', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( '', 'plugin-domain' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
            );
        
        $repeater->add_control(
            'enlace_texto', [
                'label' => __( 'Texto del enlace', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'Texto del enlace', 'plugin-name' ),
            ]
            );
      
        $this->add_control(
            'servicios',
            [
                'name' => 'titulo_servicio',
                'label' => __( 'Servicio Soluciones', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tit_car }}}',
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
        
       $html='';
       $fongris = '';
       if ( $settings['fongris']  === 'yes'  ) {
           $fongris =  ' fongris';
       }
       $html .= '<!-- Bloque dos Columnas escritorio -->
					<div class="caracteristicaSectorDos '.$fongris.'">
						<div class="numero">'.$settings['numero'].'</div>
						<div class="bloqueCaracSector">
							<div class="descripcionCaracSector">
								<h3>'.$settings['titulo'].'</h3>
								<p>'.$settings['descripcion'].'</p>
							</div>
							<img src="'.$settings['imagen']['url'].'" alt="Imagen detalle sector" title="Imagen detalle sector">
							<ul>';
                            $cont=1;
                            foreach (  $settings['servicios'] as $item ) {
                                
                               if ($item["enlace_texto"] != ''){
                                   $html.= '
                                         <li>
    										<span>'.$cont.'. '.$item["tit_car"].'</span>
    										<p>'.$item["desc_car"];
//     										'<a href="'.$item["enlace_car"]["url"].'" title="'.$item["enlace_texto"].'">'.$item["enlace_texto"].'</a>'
                                   
                                   $target = $item['enlace_car']['is_external'] ? ' target="_blank"' : '';
                                   $nofollow = $item['enlace_car']['nofollow'] ? ' rel="nofollow"' : '';
                                   $html.= '<a href="' . $item['enlace_car']['url'] . '"' . $target . $nofollow . ' title="'.$item["enlace_texto"].'">'.$item["enlace_texto"].'</a>';
                                   
                                    $html.='
    									    </p>
                                        </li>';
                               }else{
                                   $html.= '
                                         <li>
    										<span>'.$cont.'. '.$item["tit_car"].'</span>
    										<p>'.$item["desc_car"].'</p>
    									</li>';
                               }
                               $cont++;
                            }
					
        $html.='								
							</ul>';
							
							$target = $settings['enlace']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $settings['enlace']['nofollow'] ? ' rel="nofollow"' : '';
							$html.= '<a href="' . $settings['enlace']['url'] . '"' . $target . $nofollow . ' class="boton botonVerde botonMobile">Me interesa</a>';
							
							
		$html.='				</div>
					</div>
					<!-- Bloque dos Columnas escritorio -->';
       echo $html;
 
        

    }
    
    
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Familias_Caracteristicassectoresdos() );