<?php

function dci_register_pagina_itinerari_options(){
    $prefix = '';

    /**
     * Opzioni di base
     * nome Comune, Regione, informazioni essenziali
     */
    $args = array(
        'id'           => 'dci_options_itinerari',
        'title'        => esc_html__( 'Itinerari', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'itinerari',
        'tab_title'    => __('Itinerari', "design_comuni_italia"),
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
        'id' => $prefix . 'itinerari_istruzioni',
        'name'        => __( 'Configurazione Itinerari', 'design_comuni_italia' ),
        'desc' => __( 'Area di configurazione dei testi degli Itinerari', 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'itinerari_sottotitolo',
        'name'        => __( 'Sottotitolo Itinerari', 'design_comuni_italia' ),
        'desc' => __( 'Il Sottotitolo della pagina Itinerari' , 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'itinerari_testo',
        'name'        => __( 'Testo Itinerari', 'design_comuni_italia' ),
        'desc' => __( 'Il paragrafo introduttivo della pagina Itinerari' , 'design_comuni_italia' ),
        'type' => 'textarea',
    ) );

}