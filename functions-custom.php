<?php

class ThemeFunctions extends StarterSite
{
    public function __construct()
    {
		// $this->register_styles();
		// $this->register_scripts();
		// $this->register_menu();
		// $this->register_sidebar();
		// $this->add_box_to_dashboard();
		// $this->add_option_page();
    }

    private function register_menu()
    {
        register_nav_menus([
            'primary_navigation' => 'primary_navigation',
        ]);
    }

    private function register_sidebar()
    {
        $sidebars = [
            'footer1' => 'Stopka1',
        ];
        foreach( $sidebars as $sidebar_id => $sidebar_name ) {
            register_sidebar([
                'name' => __($sidebar_name, 'sidebar'),
                'id' => $sidebar_id,
                'before_widget' => '<div class="wrapper %1$s %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3>',
                'after_title' => '</h3>'
            ]);
        }
    }

    private function register_styles(){
        function theme_custom_styles() {
            wp_enqueue_style( 'style', get_template_directory_uri() . '/resources/dist/main.css' );
        }
        add_action('wp_enqueue_scripts', 'theme_custom_styles');
    }

    private function register_scripts(){
        function theme_custom_scripts() {
            wp_enqueue_script( 'jquery', get_template_directory_uri() . '/resources/node_modules/jquery/dist/jquery.min.js' );
            wp_enqueue_script( 'popper', get_template_directory_uri() . '/resources/node_modules/popper.js/dist/umd/popper.min.js' );
            wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/resources/node_modules/bootstrap/dist/js/bootstrap.min.js' );
            wp_enqueue_script( 'scripts', get_template_directory_uri() . '/resources/dist/boundle.js', [], false, true );
        }
        add_action('wp_enqueue_scripts', 'theme_custom_scripts');
    }

    private function add_box_to_dashboard()
    {
        add_action('wp_dashboard_setup', 'custom_dashboard_widgets');

        function custom_dashboard_widgets() {
            global $wp_meta_boxes;
            wp_add_dashboard_widget('help_widget', 'Szybki dostęp', 'dashboard_help');
        }

        function dashboard_help() {
            $btn_style = 'style="width: 100%; text-align: center; margin: 10px 0"';

            echo '<a '. $btn_style .' href="/wp-admin/post-new.php" class="button button-primary">Nowy Wpis</a>';
            echo '<a '. $btn_style .' href="/wp-admin/post-new.php?post_type=page" class="button button-primary">Nowa Strona</a>';
            echo '<a '. $btn_style .' href="/wp-admin/edit.php?post_type=acf-field-group" class="button button-primary">ACF</a>';
        }
    }

    private function add_option_page()
    {
        if( function_exists('acf_add_options_page') )
        {
            acf_add_options_page('Ustawienia Strony');
        }
    }

}