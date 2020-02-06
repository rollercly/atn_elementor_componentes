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
       $html .= '<div id="bqcuestionario">
                <div id="titquestionario">'.$settings["titulo_cuestionario"].'</div>';
       $cont = 1;
       foreach (  $settings['preguntas'] as $item ) {
//             //debugger
//             echo "<pre>";
//             var_dump($item);
//             echo "</pre>";  
//             //debugger
               
               //mostradmos el primer bloque y el resto ocultamos del cuestionario
               if ($cont == 1){
                   $clases = 'd-block';
                   $atras= '';
                   
               }else{
                   $clases = 'd-none';
                   $atras= '<a href="#atras" class="enlaceatrascuestionario">< Atrás</a>';
                   
               }
               
               $html.= '<div class="bqpreguntacuestionario '.$clases.'">';
                    $html.= '<div class="barracuestionario d-flex justify-content-between align-items-stretch">
                                    <div class="atrascuestionario">'.$atras.'</div> 
                                    <div class="numeracioncuestionario d-flex justify-content-center">';
                    for ($z=1 ; $z <= count($settings['preguntas']); $z++){
                        if ($cont >= $z){
                            $html.=      '<div class="numero numactivo">'.$z.'</div>';                            
                        }else{
                            $html.=      '<div class="numero ">'.$z.'</div>';
                        }
                    }
                                                
                    $html.='                
                                    </div> 
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
       
       $html.= '</div>';
     
       echo $html;
       
       if (isset($_POST['fname'])){
           
           $nombre     = sanitize_text_field( $_POST['fname'] );
           $email     = sanitize_text_field( $_POST['femail'] );
           
           $html.= "nombre:".$nombre."<br>";
           $html.= "email:".$email."<br>";
           
           //        echo "nombre: " + nombre;
           
           foreach($_POST as $campo => $valor){
               $html.= "<br />- ". $campo ." = ". $valor;
           }
       }
       
         

    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Home_Recomendador() );