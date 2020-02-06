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
class Widget_ATN_Banner_Hero_Familias_Distintos_Imgs extends Widget_Base {
    
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
        return 'bq banner hero familias distintas imagenes';
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
        return __( 'Bloque Banner Hero Familias Distintas Imagenes', 'plugin-name' );
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
            'imagen_fondo_SM',
            [
                'label' => __( 'Choose Image SM', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'imagen_fondo_XS',
            [
                'label' => __( 'Choose Image XS', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $this->add_control(
            'texto_slogan',
            [
                'label' => __( 'Slogan Banner', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'Slogan banner', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'servicio_title', [
                'label' => __( 'Title', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'servicio', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'servicio_icono', [
                'label' => __( 'Icono servicio', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true,
            ]
            );
        
      
        $this->add_control(
            'servicios',
            [
                'name' => 'titulo_servicio',
                'label' => __( 'Repeater List', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ servicio_title }}}',
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
        $html .=  '<div class="cabecera">
                        <div class="imagenCabecera">';
        $html .=            '<picture>
            					<source media="(min-width: 1200px)" srcset="'.$settings['imagen_fondo_XL']['url'].'">
            					<source media="(min-width: 992px)" srcset="'.$settings['imagen_fondo_LG']['url'].'">
            					<source media="(min-width: 768px)" srcset="'.$settings['imagen_fondo_MD']['url'].'">
            					<source media="(min-width: 576px)" srcset="'.$settings['imagen_fondo_SM']['url'].'">
            					<img src="'.$settings['imagen_fondo_XS']['url'].'" alt="Fondo cabecera">
            				</picture>';
        $html .= '      </div>';
        $html .= '      <div class="textoCabeceraFamilia">';
        $html .=             '<h1 class="tituloCabecera">'.$settings['texto_slogan'].'</h1>';
        $html .=                '<div class="servicios">';
       
                                foreach ( $settings['servicios'] as $index => $item ) {
                                    $html .=  '<div class="servicio-item">';
                                        $html .= '<img src="' . $item['servicio_icono']['url'] . '" alt="'.$item['servicio_title'].'" title="'.$item['servicio_title'].'">';
                                        $html .= '<p>'.$item['servicio_title'].'</p>';
                                    $html .= '</div>';
                                }
        $html .=        '       </div>
                        </div>';
        $html .= '</div>';
        echo $html;
 
        

    }
    
    protected function _content_template() {
        ?>
		<#
		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.thumbnail_size,
			dimension: settings.thumbnail_custom_dimension,
			model: view.getEditModel()
		};
		var image_url = elementor.imagesManager.getImageUrl( image );
		#>
		<img src="{{{ image_url }}}" />
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Banner_Hero_Familias_Distintos_Imgs() );