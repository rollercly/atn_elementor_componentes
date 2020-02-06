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
class Atn_Mis_pruebas extends Widget_Base {
    
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
        return 'atnmispruebas';
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
        return __( 'Atn Mis Pruebas', 'plugin-name' );
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
//         return [ 'atn-movistar-widgets2' ];
        return [ 'atn-movistar-home' ];
//         return [ 'first-category' ];
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
            'slogan apartado',
            [
                'label' => __( 'Additional Options', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
            );
        $this->add_control(
            'slogan',
            [
                'label' => __( 'título slogan', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( '', 'plugin-domain' ),
            ]
            );
        $this->add_control(
            'more_options',
            [
                'label' => __( 'Más opciones...', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
            );
        $this->add_control(
            'parrafo',
            [
                'label' => __( 'título slogan', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( '', 'plugin-domain' ),
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

       $html = "";
       $html .= '<div>'.$settings["slogan"].'</div>';
       $html .= '<div>'.$settings["parrafo"].'</div>';
       echo $html;

    }
    
    protected function _content_template() {
        ?>
		<div>{{{ settings.slogan }}}</div>
		<div>{{{ settings.parrafo }}}</div>
		<?php
    }
    
    
   
}
Plugin::instance()->widgets_manager->register_widget_type( new Atn_Mis_pruebas() );