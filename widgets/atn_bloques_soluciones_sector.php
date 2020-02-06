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
class Widget_ATN_Bloques_Soluciones_Sector extends Widget_Base {
    
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
        return 'bq lassoluciones sector';
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
        return __( 'Bloque Soluciones Sector', 'plugin-name' );
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
            'url',
            [
                'label' => __( 'URL to embed', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'https://your-link.com', 'plugin-name' ),
            ]
            );
        
        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
            );
        
        $this->add_control(
            'titulo_texto',
            [
                'label' => __( 'Título', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'This is the heading', 'elementor' ),
                'placeholder' => __( 'Enter your title', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        $this->add_control(
            'slogan_texto',
            [
                'label' => __( 'Slogan', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Slogan...' ),
                'placeholder' => __( 'Introduce tú slogan', 'elementor' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => true,
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
        
        //////////////////////////////////////////
        /*
         * Comprobar titulo texto
         */
        if ( ! empty( $settings['titulo_texto']) ) {
            $contenido = '<div class="fichaSector">';
            if ( ! empty( $settings['url']) ) {
                $url = $settings['url'];
                
                if ( ! Utils::is_empty( $settings['titulo_texto'] ) ) {
                    $title_html = $settings['titulo_texto'];
                    $contenido .= '<a href="'.$url.'" title="'.$title_html.'">';
                }
                /*
                 * Controlar imagen
                 */
                if ( ! empty( $settings['image']['url'] ) ) {
                    $this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
                    $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
                    $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
                    
                    
                    $image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
                    
                    
                    $contenido .= '<figure class="elementor-image-box-img">' . $image_html . '</figure>';
                    $contenido .= '<div class="descripcionSector">';
                        $title_html = $settings['titulo_texto'];
                        $contenido .= sprintf( '<p %1$s %2$s>%3$s</p>', $settings['title_size'], $this->get_render_attribute_string( 'titulo_texto' ), $title_html );
                        if ( ! Utils::is_empty( $settings['slogan_texto'] ) ) {
                            $this->add_render_attribute( 'slogan_texto', 'class', 'elementor-image-box-description' );
                            
                            $this->add_inline_editing_attributes( 'slogan_texto' );
                            
                            $contenido .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'slogan_texto' ), $settings['slogan_texto'] );
                        }
                        $contenido .= '      </div>
                                       </a>
                                    </div>';
                }
            }
            echo $contenido;
        }
    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Bloques_Soluciones_Sector() );