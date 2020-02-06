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
class Widget_ATN_Soluciones_Sector_Medio extends Widget_Base {
    
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
        return 'bqsolucionessectormedio';
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
        return __( 'Soluciones Sector Medio', 'plugin-name' );
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
            'frase', [
                'label' => __( 'Frase', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'Frase', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'parrafo',
            [
                'label' => __( 'Parrafo', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( 'Introduce tu texto aquí...', 'plugin-domain' ),
            ]
            );
        $repeater->add_control(
            'enlace',
            [
                'label' => __( 'Enlace', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( '', 'plugin-domain' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
            );
        //repeater imagnes
        $repeater->add_control(
            'imagen_XL',
            [
                'label' => __( 'Choose Image XL', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_LG',
            [
                'label' => __( 'Choose Image LG', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_MD',
            [
                'label' => __( 'Choose Image MD', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_SM',
            [
                'label' => __( 'Choose Image SM', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_XS',
            [
                'label' => __( 'Choose Image XS', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        //repeater imagnes
        
        $this->add_control(
            'servicios',
            [
                'name' => 'experiencias',
                'label' => __( 'Experiencias', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ frase }}}',
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
		          <div class="situacionesSector">
			         <div class="container">
                        <h2 class="tituloSeccion">'.$settings["titulo"].'</h2>';
        foreach ( $settings['servicios'] as $index => $item ) {
            $html.=     '<div class="caracteristicaProducto">
    					   <div class="row">
    						  <div class="col-lg-5 col-md-6 descripcionProducto">
    							 <h3>'.$item['frase'].'</h3>';
            $html.=               '<p>'.$item['parrafo'].'</p>';
            $html.=               '<a href="'.$item['enlace']['url'].'" title="Soluciones relacionadas">Soluciones relacionadas</a>
                                </div>
                             <div class="col-lg-7 col-md-6">
    							<picture>
                                    <source media="(min-width: 1200px)" srcset="'.$item['imagen_XL']['url'].'">
    								<source media="(min-width: 992px)" srcset="'.$item['imagen_LG']['url'].'">
    								<source media="(min-width: 768px)" srcset="'.$item['imagen_MD']['url'].'">
    								<img src="'.$item['imagen_SM']['url'].'" alt="Primera caracteristica" title="Primera caracteristica">
    							</picture>
        					</div>
        				</div>
                      </div>
                   ';
        }
        $html.= '       </div>
                    </div>
                    <!--FIN Situaciones -->';
		
        echo $html;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Soluciones_Sector_Medio() );