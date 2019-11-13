<?php // A terminer
 
class Customizer_Jarallax
{
    public const SECTION_ID              = 'opicking_theme_section_jarallax';

    public const SETTING_JARALLAX_IMAGE  = 'opicking_jarallax_image';

    public const SETTING_JARALLAX_IMAGE2 = 'opicking_jarallax_image2';

    public const SETTING_JARALLAX_IMAGE3 = 'opicking_jarallax_image3';

    public const SETTING_JARALLAX_IMAGE4 = 'opicking_jarallax_image4';


    /**
     * @var WP_Customize_Manager
     */
    private $wp_customize;

    private $panel_id;

 
    /**
     * @param WP_Customize_Manager $wp_customize Customizer Manager
     * @param string               $panel_id Panel id where to add the section
     */
    public function __construct($wp_customize, $panel_id)
    {
        $this->wp_customize         = $wp_customize;
        $this->panel_id             = $panel_id;

        $this->add_section();
        $this->add_image_jarallax_setting();
    }


    // Add section on panel (homepage)
    private function add_section()
    {
        $this->wp_customize->add_section(
            self::SECTION_ID,
            [
                'priority'          => 1,
                'panel'             => $this->panel_id,
                'title'             => '[Jarallax] Images de background',
                'description'       => 'Option de personnalisation des images de la page d\'accueil'
            ]
        );
    }

    // Add settings for image option
    /*
    * <?php echo get_theme_mod('SETTING_JARALLAX_IMAGE#'); ?>
    */
    //
    private function add_image_jarallax_setting() {
        $this->wp_customize->add_setting(
            self::SETTING_JARALLAX_IMAGE
        );


        $this->wp_customize->add_control(
            new WP_Customize_Image_Control(
                $this->wp_customize,
                self::SETTING_JARALLAX_IMAGE,
                [
                    'section'       => self::SECTION_ID,
                    'label'         => __( 'Choisir une image', 'opicking' ),
                    'description'   => __( '1ère Image', 'opicking' ),
                ]
            )
        );

        $this->wp_customize->add_setting(
            self::SETTING_JARALLAX_IMAGE2
        );

        $this->wp_customize->add_control(
            new WP_Customize_Image_Control(
                $this->wp_customize,
                self::SETTING_JARALLAX_IMAGE2,
                [
                    'section'       => self::SECTION_ID,
                    'label'         => __( 'Choisir une image', 'opicking' ),
                    'description'   => __( '2ème Image', 'opicking' ),
                ]
            )
        );

        $this->wp_customize->add_setting(
            self::SETTING_JARALLAX_IMAGE3
        );

        $this->wp_customize->add_control(
            new WP_Customize_Image_Control(
                $this->wp_customize,
                self::SETTING_JARALLAX_IMAGE3,
                [
                    'section'       => self::SECTION_ID,
                    'label'         => __( 'Choisir une image', 'opicking' ),
                    'description'   => __( '3ème Image', 'opicking' ),
                ]
            )
        );

        $this->wp_customize->add_setting(
            self::SETTING_JARALLAX_IMAGE4
        );

        $this->wp_customize->add_control(
            new WP_Customize_Image_Control(
                $this->wp_customize,
                self::SETTING_JARALLAX_IMAGE4,
                [
                    'section'       => self::SECTION_ID,
                    'label'         => __( 'Choisir une image', 'opicking' ),
                    'description'   => __( '4ème Image', 'opicking' ),
                ]
            )
        );
    }
}