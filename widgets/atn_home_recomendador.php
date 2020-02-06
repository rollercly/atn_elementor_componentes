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
class Widget_ATN_Home_Recomendador extends Widget_Base {
    
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
        return 'bqhomerecomendador';
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
        return __( 'Cuestionario Recomendador', 'plugin-name' );
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
        return [ 'atn-movistar-home' ];
    }
    
    /*
     * dependencias javascript
     */
    public function get_script_depends() {
        return [ 'atn-home-recomendador'];
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
            'titulo_cuestionario', [
                'label' => __( 'Título cuestionario', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'título cuestionario', 'plugin-name' ),
            ]
            );
        $this->add_control(
            'imgvolveratras',
            [
                'label' => __( 'Imagen volver atrás', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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
            'custom_html',
            [
                'label' => __( 'Custom HTML', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::CODE,
                'language' => 'html',
                'rows' => 20,
            ]
            );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'titulo_pregunta', [
                'label' => __( 'Pregunta', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( '', 'plugin-name' ),
            ]
            );
        for ($i=1 ; $i<9 ; $i++){
            $repeater->add_control(
                'respuesta_'.$i, [
                    'label' => __( 'Respuesta '.$i, 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( '' , 'plugin-domain' ),
                    'label_block' => true,
                    'placeholder' => __( 'respuesta...', 'plugin-name' ),
                ]
                );
            $repeater->add_control(
                'puntos_respuesta_'.$i, [
                    'label' => __( 'Puntos de Respuesta '.$i, 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( '0' , 'plugin-domain' ),
                    'label_block' => true,
                    'placeholder' => __( '0', 'plugin-name' ),
                ]
                );
        }
       
        
        
        $this->add_control(
            'preguntas',
            [
                'name' => 'preguntas',
                'label' => __( 'Repeater List', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ titulo_pregunta }}}',
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
       //echo "numero preguntas:" .count($settings['preguntas']);
       $html = '';

           $html.='<div class="contenidoRecomendador">
                		<!-- Cabecera -->
                		<div class="cabecera cabSector">
                			<div class="imagenCabecera">
                				<picture>
                                    <source media="(min-width: 1200px)" srcset="'.$settings['imagen_fondo_XL']['url'].'">
                					<source media="(min-width: 992px)" srcset="'.$settings['imagen_fondo_LG']['url'].'">
                					<img src="'.$settings['imagen_fondo_MD']['url'].'" alt="Fondo cabecera Recomendador" title="Fondo cabecera Recomendador">
                				</picture>
                			</div>
                			<div class="textoCabecera">
                				<h1 class="tituloCabecera">'.$settings["titulo_cuestionario"].'</h1>
                			</div>
                		</div>
                		<!-- Cabecera -->
                		<!-- Formulario del recomendador -->
                		<div class="bqRecomendador">
                			<div class="container">
                                ';
           
                               //INICIO BUCLE
                               $cont = 1;
                               foreach (  $settings['preguntas'] as $item ) {
                                   
                                   //mostradmos el primer bloque y el resto ocultamos del cuestionario
                                   if ($cont == 1){
                                       $clases = 'd-block';
                                       $atras= '<a href="'.get_home_url().'" class="enlaceatrascuestionario"><img src="'.$settings['imgvolveratras']['url'].'" 
                                            title="Enlace para volver a la página de inicio" alt="Enlace para volver a la página de inicio"> Volver a la página de inicio</a>';
                                       
                                   }else{
                                       $clases = 'd-none';
                                       $atras= '<a href="#atras" class="enlaceatrascuestionario">
                                                    <img src="'.$settings['imgvolveratras']['url'].'" title="Atrás" alt="Atrás"> Atrás</a>';
                                       
                                   }
                                   
                                   $html.= '<div class="bqpreguntacuestionario '.$clases.'">';
                                   $html.= '<div class="row">
                                                <div class="bqizda col-md-4">
                                                     <div class="atrascuestionario">'.$atras.'</div>
                                                </div>
                                                <div class="bqcentro col-md-4">';
                                                $totpreg = count($settings['preguntas']);
                                                
                                                $html.='<div class="indicator pnt-size-indicator-step-'.$cont.'"></div>';
                                                
//                                              echo "totpreg:".$totpreg;
                                               $html.=  '<ul class="bqnumerosul">';
                                                for ($z=1 ; $z <= $totpreg ; $z++){
                                                   //$html.='<div class="indicator pnt-size-indicator-step-'.$z.'"></div>';
                                                   if ($cont >= $z){
                                                       $html.='      <li class="active">'.$z.'</li>';
                                                   }else{
                                                       $html.='      <li>'.$z.'</li>';                                                       
                                                   }
                                               }
                                               $html.='</ul>';
                                               
                                   $html.='     </div>    
                                                <div class="bqdcha col-md-4"></div>
                                            </div>';
                                         
                                                                   
                                   
                                  
                                                                  
                                                         
                                   $html.= '<div class="titpreguncuestionario">'.$item['titulo_pregunta'].'</div>' ;
                                   for ($i=1 ; $i<9 ; $i++){
                                       if ($item['respuesta_'.$i] != ''){
                                           $html.= '<div class="respuestacuestionario" >';
                                           $html .= '<input id="'.'respuesta_'.$cont.'_'.$i.'" type="radio" name="'.'pregunta'.$cont.'" value="'.$item['puntos_respuesta_'.$i].'">';
                                           $html .= '<label for="'.'respuesta_'.$cont.'_'.$i.'" >'.$item['respuesta_'.$i].'</label>';
                                           $html.= '</div>';
                                       }else{
                                           continue;
                                       }
                                   }
                                   
                                   $html.= '</div>';
                                   
                                   
                                   $cont++;
                               }
                               
                                
                               $html.=$settings['custom_html'];
                               
                               $html.= '</div>';
                               
                               //fin BUCLE
                               
                              
           $html.=      '   </div>';
           $html.=      '</div>';
           
           
			$html.='</div>
		</div>
		<!-- Formulario del recomendador -->
	</div>'
               ;
       echo $html;
         

    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Home_Recomendador() );