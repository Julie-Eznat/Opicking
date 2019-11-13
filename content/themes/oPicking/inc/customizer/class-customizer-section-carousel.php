<?php

class Customizer_Delay
{
    public const SECTION_ID             = 'opicking_theme_section_delay';

    public const SETTING_CAROUSEL_DELAY  = 'opicking_carousel_delay';





    private $wp_customize;

    private $panel_id;



    public function __construct($wp_customize, $panel_id)
    {
        $this->wp_customize         = $wp_customize;
        $this->panel_id             = $panel_id;

        $this->add_section();
        $this->add_image_carousel_setting();
    }

    private function  add_section()
    {
        $this->wp_customize->add_section(
            self::SECTION_ID,
            [
                'panel'             => $this->panel_id,
                'title'             =>' &#9203; Gestion du Carousel',
                'description'       =>'Gere le delai de transition'
            ]
        );
    }

    private function add_image_carousel_setting(){
        $this->wp_customize->add_setting(
            self::SETTING_CAROUSEL_DELAY
        );

        $this->wp_customize->add_control(
            new WP_Customize_Control(
                $this->wp_customize,
                self::SETTING_CAROUSEL_DELAY,
                [
                    'section'       => self::SECTION_ID,
                    'label'         =>__('&#8722; delai de transition (min 0s ; max 10s) &#43; '),
                    'type'          => 'range',
                    'input_attrs' => array(
                        'min' => 0, 
                        'max' => 10000, '&#9321;',
                        'step' => 1000,
                      ),
                   
                ]
            )

        );
    }
    

}