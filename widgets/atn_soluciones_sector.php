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
class Widget_ATN_Soluciones_Sector extends Widget_Base {
    
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
        return 'bqsolucionessector';
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
        return __( 'Soluciones Sector', 'plugin-name' );
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
                'label' => __( 'Título Servicio', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
                'placeholder' => __( 'Título del servicio', 'plugin-name' ),
            ]
            );
        $repeater->add_control(
            'servicio_texto', [
                'label' => __( 'Servicio Parrafo', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( '', 'plugin-domain' ),
                'placeholder' => __( 'Introduce aquí el texto del parrafo del servicio', 'plugin-domain' ),
            ]
            );
        $repeater->add_control(
            'servicio_url',
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
            'imagen_servicio_XL',
            [
                'label' => __( 'Choose Image XL', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_servicio_LG',
            [
                'label' => __( 'Choose Image LG', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_servicio_MD',
            [
                'label' => __( 'Choose Image MD', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_servicio_SM',
            [
                'label' => __( 'Choose Image SM', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
            );
        $repeater->add_control(
            'imagen_servicio_XS',
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
                'name' => 'titulo_servicio',
                'label' => __( 'Servicio Soluciones', 'plugin-domain' ),
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
        $html.= '<!-- Cabecera -->
		<div class="cabecera cabSector">
			<div class="imagenCabecera">
				<picture>
					<source media="(min-width: 1200px)" srcset="'.$settings["imagen_fondo_XL"]["url"].'">
					<source media="(min-width: 992px)" srcset="'.$settings["imagen_fondo_LG"]["url"].'">
					<source media="(min-width: 768px)" srcset="'.$settings["imagen_fondo_MD"]["url"].'">
					<source media="(min-width: 576px)" srcset="'.$settings['imagen_fondo_SM']['url'].'">
					<img src="'.$settings['imagen_fondo_XS']['url'].'" alt="'.$settings["titulo"].'" title="'.$settings["titulo"].'">
				</picture>
			</div>
			<div class="textoCabecera">
				<h1 class="tituloCabecera">'.$settings["titulo"].'</h1>
				<p>'.$settings["texto_slogan"].'</p>
			</div>
		</div>
		<!-- Cabecera -->';
        $html.= '<div class="descubrirSector">
            			<div class="container">
            				<div class="row">';
        foreach ( $settings['servicios'] as $index => $item ) {
            $html.= '
					<div class="bloqueDescubre col-lg-4">
						<div class="detalleDescubre">
							<div class="imgDescubre">
								<h2 class="tituloSeccion">'.$item['servicio_title'].'</h2>
								<picture>
									<source media="(min-width: 1200px)" srcset="'.$item['imagen_servicio_XL']['url'].'">
									<source media="(min-width: 992px)" srcset="'.$item['imagen_servicio_LG']['url'].'">
									<source media="(min-width: 768px)" srcset="'.$item['imagen_servicio_MD']['url'].'">
									<source media="(min-width: 576px)" srcset="'.$item['imagen_servicio_SM']['url'].'">
									<img src="'.$item['imagen_servicio_XS']['url'].'" alt="'.$item['servicio_title'].'" title="'.$item['servicio_title'].'">
								</picture>
							</div>
							<div class="textoDescubre">
								<p>Las herramientas digitales te permiten llegar a millones de potenciales clientes y diferenciarte de tus competidores. Si no cuentas con una web profesional y bien posicionada en buscadores, estás dejando pasar miles de oportunidades. Tus futuros clientes te quieren conocer, te están buscando en Internet y no te encuentran.</p>';
								
// 								<a href="'.$item['servicio_url']['url'].'" title="Descubrir cómo">Descubrir cómo</a>
            
            $target = $item['servicio_url']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $item['servicio_url']['nofollow'] ? ' rel="nofollow"' : '';
            $html.= '<a href="' . $item['servicio_url']['url'] . '"' . $target . $nofollow . ' title="Descubrir cómo">Descubrir cómo</a>';
								    
			$html.= '				</div>							
						</div>
					</div>
				';
        }
        $html.= '           </div>
            			</div>
            		</div>';
		
        echo $html;
 
        

    }
    
    
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Soluciones_Sector() );