<?php

function dci_register_pagina_progetti_options(){
    $prefix = '';

    /**
     * Opzioni di base
     * nome Comune, Regione, informazioni essenziali
     */
    $args = array(
        'id'           => 'dci_options_progetti',
        'title'        => esc_html__( 'Progetti', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'progetti',
        'tab_title'    => __('Progetti', "design_comuni_italia"),
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
        'id' => $prefix . 'progetti_istruzioni',
        'name'        => __( 'Configurazione Progetti', 'design_comuni_italia' ),
        'desc' => __( 'Area di configurazione dei testi dei Progetti', 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'progetti_sottotitolo',
        'name'        => __( 'Sottotitolo Progetti', 'design_comuni_italia' ),
        'desc' => __( 'Il Sottotitolo della pagina Progetti' , 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'progetti_testo',
        'name'        => __( 'Testo Progetti', 'design_comuni_italia' ),
        'desc' => __( 'Il paragrafo introduttivo della pagina Progetti' , 'design_comuni_italia' ),
        'type' => 'textarea',
    ) );

}