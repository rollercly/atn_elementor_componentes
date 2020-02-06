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
class Widget_Atn_Contacto_Lateral_Dcho extends \Elementor\Widget_Base {
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
        return 'bqcontactolateraldcho';
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
        return __( 'ATN Contacto Lateral Derecho', 'plugin-name' );
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
        return [ 'atn-movistar-contacto' ];
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
		        'placeholder' => __( 'O bien:', 'elementor' ),
		        'label_block' => true,
		    ]
		    );
		
		$this->add_control(
		    'telefono',
		    [
		        'label' => __( 'Teléfono', 'elementor' ),
		        'type' => Controls_Manager::TEXT,
		        'dynamic' => [
		            'active' => true,
		        ],
		        'default' => __( '', 'elementor' ),
		        'placeholder' => __( '0992765812', 'elementor' ),
		        'label_block' => true,
		    ]
		    );
		
		$this->add_control(
		    'siguenos',
		    [
		        'label' => __( 'Siguenos', 'elementor' ),
		        'type' => Controls_Manager::TEXT,
		        'dynamic' => [
		            'active' => true,
		        ],
		        'default' => __( '', 'elementor' ),
		        'placeholder' => __( 'Siguenos...', 'elementor' ),
		        'label_block' => true,
		    ]
		    );
        
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
		    'nombre_red',
		    [
		        'label' => __( 'Nombre Red Social', 'elementor' ),
		        'type' => Controls_Manager::TEXT,
		        'dynamic' => [
		            'active' => true,
		        ],
		        'default' => __( '', 'elementor' ),
		        'placeholder' => __( 'Facebook', 'elementor' ),
		        'label_block' => true,
		    ]
		    );
		
		$repeater->add_control(
		    'logo_red',
		    [
		        'label' => __( 'Logo de Red Social', 'elementor' ),
		        'type' => \Elementor\Controls_Manager::MEDIA,
		        'default' => [
		            'url' => \Elementor\Utils::get_placeholder_image_src(),
		        ],
		    ]
		    );
		$repeater->add_control(
		    'enlace_red',
		    [
		        'label' => __( 'Url Red Social', 'plugin-domain' ),
		        'type' => \Elementor\Controls_Manager::URL,
		        'placeholder' => __( '', 'plugin-domain' ),
		        'show_external' => true,
		        'default' => [
		            'url' => '',
		            'is_external' => true,
		            'nofollow' => false,
		        ],
		    ]
		    );

		$this->add_control(
		    'redes',
		    [
		        'name' => 'tit_red',
		        'label' => __( 'Servicio Soluciones', 'plugin-domain' ),
		        'type' => \Elementor\Controls_Manager::REPEATER,
		        'fields' => $repeater->get_controls(),
		        'title_field' => '{{{ nombre_red }}}',
		    ]
		    );
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$html ='';
		$html.= '<div class="datosContacto">
						<p>'.$settings["titulo"].'</p>
						<a class="telefonoContacto" href="tel:0992765812" title="Llámanos">Llámanos al<span>'.$settings["telefono"].'</span></a>
						<span>'.$settings["siguenos"].'</span>
						<ul>';
		foreach (  $settings['redes'] as $item ) {
		    $html.=       '<li>
                    		    <a href="" title="icono '.$item['nombre_red'].'">
                    		      <img src="'.$item['logo_red']['url'].'" 
                                        alt="'.$item['nombre_red'].'" 
                                        title="'.$item['nombre_red'].'"/>
                    		    </a>
                		    </li>';
		}
						  	
						  
        $html.= '						  	
					  	</ul>
					</div>';
		echo $html;
	}
		

	

}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Atn_Contacto_Lateral_Dcho() );