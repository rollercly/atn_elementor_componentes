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
class Widget_ATN_Soluciones_Pestaniasn2 extends Widget_Base {
    
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
        return 'BqSolcionespestaniasn2';
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
        return __( 'Pestañas Soluciones n2', 'plugin-name' );
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
            'titulo_seccion',
            [
                'label' => __( 'Título sección', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'título de sección', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'nombre_categoria', [
                'label' => __( 'Categoría', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
            );
        
         
        $this->add_control(
            'list',
            [
                'label' => __( 'Categorías', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ nombre_categoria }}}',
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
        
//         echo "<pre>";
//         var_dump($this);
// //         var_dump($settings);
//         echo "</pre>";
// //         echo "id:".$settings["id"];
//         $idpropio =  get_id();
        $html = '';

        $html.='
            <div class="tabsApps">
                <ul>';
        $cont=1;
        $pest='';
        if (isset($_GET["pest"])){
            $pest=$_GET["pest"];
        }
        
        foreach ( $settings['list'] as $index => $item ) {
            /*
             * Si existe pestaña, activaremos la que hemos pasado por parametro pest=X, ej.: pest=2
             */
            if ($pest != ''){
                if($cont == $pest){                    
                    $html.='<li id="tab-'.$cont.'" class="active"><h2>'.$item["nombre_categoria"].'</h2></li>';                
                }else{
                    $html.='<li id="tab-'.$cont.'" class=""><h2>'.$item["nombre_categoria"].'</h2></li>';                                    
                }
            /*
             * Si NO existe pestaña, activaremos la primera
             */
            }else{
                if ($cont == 1){
                    $html.='<li id="tab-'.$cont.'" class="active"><h2>'.$item["nombre_categoria"].'</h2></li>';
                }else{
                    $html.='<li id="tab-'.$cont.'" class=""><h2>'.$item["nombre_categoria"].'</h2></li>';                
                }
            }
            $cont++;
        }
        $html.= '</ul>
            </div>';
        echo $html;
        
    } 

}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Soluciones_Pestaniasn2() );