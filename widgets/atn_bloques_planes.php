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
class Widget_ATN_Bloques_Planes extends Widget_Base {
    
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
        return 'bq planes';
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
        return __( 'Bloque Planes', 'plugin-name' );
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
    
    /*
     * dependencias javascript
     */
    public function get_script_depends() {
        return [ 'atn-bloques-planes'];
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
            'tipo_producto',
            [
                'label' => __( 'Tipo de Producto', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( '---', 'plugin-domain' ),
                    'Recomendado' => __( 'Recomendado', 'plugin-domain' ),
                ],
            ]
            );
        
        $this->add_control(
            'nombre_producto',
            [
                'label' => __( 'Nombre Producto', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'Nombre del producto', 'elementor' ),
                'label_block' => true,
            ]
            );
        $this->add_control(
            'enlace_boton',
            [
                'label' => __( 'enlace', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::URL,
                'input_type' => 'url',
                'placeholder' => __( '', 'plugin-name' ),
            ]
            );
//         $this->add_control(
//             'boton',
//             [
//                 'label' => __( 'botón', 'plugin-name' ),
//                 'type' => \Elementor\Controls_Manager::BUTTON,
//                 'input_type' => 'url',
//                 'placeholder' => __( 'boton', 'plugin-name' ),
//             ]
//             );
//         $this->add_control(
//             'delete_content',
//             [
//                 'label' => __( 'boton con trigger', 'plugin-name' ),
//                 'type' => \Elementor\Controls_Manager::BUTTON,
//                 'separator' => 'before',
//                 'button_type' => 'success',
//                 'text' => __( 'texto de boton', 'plugin-domain' ),
//                 'event' => 'namespace:editor:textoboton',
//             ]
//             );
        
        
        $this->add_control(
            'precio_producto',
            [
                'label' => __( 'Precio Producto', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'elementor' ),
                'placeholder' => __( 'Precio producto', 'elementor' ),
                'label_block' => true,
            ]
            );
        
        $this->add_control(
            'list',
            [
                'label' => __( 'List', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => __( 'Text', 'plugin-name' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => __( 'List Item', 'plugin-name' ),
                        'default' => __( 'List Item', 'plugin-name' ),
                    ],
                   
                ],
                'default' => [
                    [
                        'text' => __( '', 'plugin-name' ),
                    ],
                    
                ],
                'title_field' => '{{{ text }}}',
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
        
//         echo "idpropio".$idpropio."<br>";
        
        
        ?>
        <div id="pestanaPlan">
        	<?php
             $tipoprod = $settings['tipo_producto'];
             $clases = "";
             if ($tipoprod == "Recomendado"){
                 $clases = "recomendado";
             }
             ?>
            <div class="<?php echo $clases;?> card-item">
                <h3>
                	<?php
                	$tipoprod = $settings['tipo_producto'];
                	if ($tipoprod == "Recomendado"){
                	    echo "<span>".$tipoprod."</span>";
                	}
                	?>
                	
                	<?php echo $settings['nombre_producto'];?>
                </h3>
                <div class="detalleCard">
                	<div>
                		<ul>
                		<?php 
                		$cont = 0;
                		foreach ( $settings['list'] as $index => $item ) : ?>
                			<?php 
                			if ($cont == 4){
                			    echo '<div class="collapse" id="'.$id.'">';
                			}
                			?>
                			<li>
                				<?php
            					echo $item['text'];
                 				?>
                			</li>
                		<?php 
                		  $cont++;
                		endforeach; ?>
                		<?php 
            			if ($cont > 4){
            			    echo '</div>';
            			}
            			?>
                		</ul>
                		
                		<a class="triggerCaract" 
                        			href="#<?php echo $id;?>" 
                        			data-toggle="collapse" 
                        			aria-expanded="false" 
                        			aria-controls="<?php echo $id;?>" 
                        			title="Todas las características">
    			        	<span class="collapsed">Mostrar todo</span>
    			        	<span class="expanded">Mostrar menos</span>
    			      	</a>
                	</div>
                	<div>
    					<p class="precio-item"><?php echo $settings['precio_producto'];?></p>
    					<button data-toggle="modal" data-target="#modalContratacion"
    						 data-producto="<?php echo $settings['nombre_producto'];?>"
    						 data-precio="<?php echo $settings['precio_producto'];?>"
    						 >Lo quiero</button>
    				</div>
                </div>
                
        	</div>	
        </div>    
    		<?php
    } 
}
Plugin::instance()->widgets_manager->register_widget_type( new Widget_ATN_Bloques_Planes() );