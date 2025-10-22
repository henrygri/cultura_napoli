<?php

function dci_register_pagina_home_options(){
    $prefix = '';

    /**
     * Opzioni Home
     */
    $args = array(
        'id'           => 'dci_options_home',
        'title'        => esc_html__( 'Home Page', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'homepage',
        'capability'    => 'manage_options',
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'tab_title'    => __('Home Page', "design_comuni_italia"),	);

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $home_options = new_cmb2_box( $args );

    $home_options->add_field( array(
        'id' => $prefix . 'contenuti_evidenziati_title',
        'name'        => __( 'Sezione Contenuti in Evidenza', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione Contenuti in Evidenza.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $home_options->add_field( array(
		    'name'        => __('Schede in evidenza', 'design_comuni_italia'),
		    'desc' => __( 'Definisci il contenuto delle Schede in evidenza' , 'design_comuni_italia' ),
            'id' => $prefix . 'schede_evidenziate',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array('evento','luogo','unita_organizzativa','documento_pubblico','servizio','notizia','dataset'),
                ), // override the get_posts args
            ),
            'attributes' => array(
                'data-max-items' => 6, //change the value here to how many posts may be attached.
            ),
        )
    );

}
