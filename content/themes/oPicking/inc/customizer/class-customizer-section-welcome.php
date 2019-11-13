<?php
 
class Customizer_Welcome
{
    public const SECTION_ID             = 'opicking_theme_section_welcome';

    public const SETTING_WELCOME_TITLE  = 'opicking_welcome_title';

    public const SETTING_WELCOME_TEXT   = 'opicking_welcome_text';



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
        $this->add_title_setting();
        $this->add_text_setting();
    }

    // Add section on panel (homepage)
    private function add_section()
    {
        $this->wp_customize->add_section(
            self::SECTION_ID,
            [
                'panel'             => $this->panel_id,
                'title'             => 'Article de Bienvenue',
                'description'       => 'Modifier le titre de bienvenue'
            ]
        );
    }


    // Add 'type => text' for title
    public function add_title_setting() {
        $this->wp_customize->add_setting(
            self::SETTING_WELCOME_TITLE,
            [
                'default'           => __( '', 'opicking'),
            ]
        );

        $this->wp_customize->add_control(
            new WP_Customize_Control(
                $this->wp_customize,
                self::SETTING_WELCOME_TITLE,
                [
                    'section'       => self::SECTION_ID,
                    'label'         => __( 'Modifier le titre' ),
                    'type'          => 'text',
                ]
            )
        );
    }

    // Add 'type => textarea' for paragraph
    public function add_text_setting() {
        $this->wp_customize->add_setting(
            self::SETTING_WELCOME_TEXT,
            [
                'default'           => __( '', 'opicking'),
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $this->wp_customize->add_control(
            new WP_Customize_Control(
                $this->wp_customize,
                self::SETTING_WELCOME_TEXT,
                [
                    'section'       => self::SECTION_ID,
                    'label'         => __( 'Modifier le texte' ),
                    'type'          => 'textarea',
                ]
            )
        );
    }

}