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
class Widget_Atn_Enlace_Simple extends \Elementor\Widget_Base {
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
        return 'bqATNenlace';
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
        return __( 'Bloque ATN Enlace', 'plugin-name' );
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
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
		    'texto_enlace',
		    [
		        'label' => __( 'Texto del enlace', 'plugin-domain' ),
		        'type' => \Elementor\Controls_Manager::TEXT,
		        'default' => __( '', 'plugin-domain' ),
		        'placeholder' => __( 'texto del enlace', 'plugin-domain' ),
		    ]
		    );
		$this->add_control(
		    'enlace',
		    [
		        'label' => __( 'Link', 'plugin-domain' ),
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

		$this->end_controls_section();

	}

	protected function render() {
	    $settings = $this->get_settings_for_display();
	    $target = $settings['enlace']['is_external'] ? ' target="_blank"' : '';
	    $nofollow = $settings['enlace']['nofollow'] ? ' rel="nofollow"' : '';
	    echo '<a href="' . $settings['enlace']['url']. ' " class="atras" title="Volver al sector"' . $target . $nofollow . '><div class="triangulo"></div>'.$settings['texto_enlace'] .'</a>';
	    
	}
	
	protected function _content_template() {
	    ?>
		<#
		var target = settings.website_link.is_external ? ' target="_blank"' : '';
		var nofollow = settings.website_link.nofollow ? ' rel="nofollow"' : '';
		#>
		<a href="{{settings.enlace.url}}"{{ target }}{{ nofollow }}>{{{ settings.texto_enlace }}}</a>
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_Atn_Enlace_Simple() );