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
class Widget_Atn_Contacto_Cabecera extends \Elementor\Widget_Base {
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
        return 'bqcontactocabecera';
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
        return __( 'ATN Contacto Cabecera', 'plugin-name' );
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
		        'placeholder' => __( 'Título', 'elementor' ),
		        'label_block' => true,
		    ]
		    );

		$this->add_control(
		    'imagen_fondo_XL',
		    [
		        'label' => __( 'Seleccionar Imagen XL', 'elementor' ),
		        'type' => \Elementor\Controls_Manager::MEDIA,
		        'default' => [
		            'url' => \Elementor\Utils::get_placeholder_image_src(),
		        ],
		    ]
		    );
		$this->add_control(
		    'imagen_fondo_LG',
		    [
		        'label' => __( 'Seleccionar Imagen LG', 'elementor' ),
		        'type' => \Elementor\Controls_Manager::MEDIA,
		        'default' => [
		            'url' => \Elementor\Utils::get_placeholder_image_src(),
		        ],
		    ]
		    );
		$this->add_control(
		    'imagen_fondo_MD',
		    [
		        'label' => __( 'Seleccionar Imagen MD', 'elementor' ),
		        'type' => \Elementor\Controls_Manager::MEDIA,
		        'default' => [
		            'url' => \Elementor\Utils::get_placeholder_image_src(),
		        ],
		    ]
		    );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$html ='';
		$html.= '<!-- Cabecera -->
		<div class="cabecera cabSector">
			<div class="imagenCabecera">
				<picture>
					<source media="(min-width: 1200px)" srcset="'.$settings ['imagen_fondo_XL']['url'].'">
					<source media="(min-width: 992px)" srcset="'.$settings ['imagen_fondo_LG']['url'].'">
					<img src="'.$settings ['imagen_fondo_MD']['url'].'" alt="Fondo cabecera Contacto" title="Fondo cabecera Contacto">
				</picture>
			</div>
			<div class="textoCabecera">
				<h1 class="tituloCabecera">'.$settings ['titulo'].'</h1>
			</div>
		</div>
		<!-- Cabecera -->';
		echo $html;
	}
		

	

}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Atn_Contacto_Cabecera() );