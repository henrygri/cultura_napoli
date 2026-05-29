<?php

function dci_register_pagina_focus_options(){
    $prefix = '';

    /**
     * Opzioni di base
     * nome Comune, Regione, informazioni essenziali
     */
    $args = array(
        'id'           => 'dci_options_focus',
        'title'        => esc_html__( 'Focus', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'focus',
        'tab_title'    => __('Focus', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $header_options = new_cmb2_box( $args );

    $header_options->add_field( array(
        'id' => $prefix . 'focus_istruzioni',
        'name'        => __( 'Configurazione Focus', 'design_comuni_italia' ),
        'desc' => __( 'Area di configurazione dei testi del Focus', 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'focus_sottotitolo',
        'name'        => __( 'Sottotitolo Focus', 'design_comuni_italia' ),
        'desc' => __( 'Il Sottotitolo della pagina Focus' , 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'focus_testo',
        'name'        => __( 'Testo Focus', 'design_comuni_italia' ),
        'desc' => __( 'Il paragrafo introduttivo della pagina Focus' , 'design_comuni_italia' ),
        'type' => 'textarea',
    ) );

}