<?php

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_page_add_content_after_title' );
function dci_page_add_content_after_title($post) {
    if($post->post_type == "page")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo della Pagina</b>.</i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
* Crea i metabox del post type page
*/
add_action( 'cmb2_init', 'dci_add_page_metaboxes' );
function dci_add_page_metaboxes() {
    $prefix = '_dci_page_';

    $cmb_descrizione = new_cmb2_box( array(
    'id'           => $prefix . 'box_descrizione',
    'object_types' => array( 'page' ),
    'context'      => 'after_title',
    'priority'     => 'high',
    ) );

    $args =  array(
        'id' => $prefix . 'descrizione',
        'name'        => __( 'Descrizione *', 'design_comuni_italia' ),
        'desc'        => __( 'Una breve descrizione compare anche nella card di presentazione della pagina', 'design_comuni_italia' ),
        'type'             => 'textarea',
        'attributes' => array(
            'required' => 'required',
            'maxlength' => 255
        ),
    );

    /**
     * disabilito editor body e title per le pagine del Sito dei Comuni
     * rendo il campo descrivione_breve readonly
     */
    global $pagenow;
    if (( $pagenow == 'post.php' ) || (get_post_type() == 'post')) {

        if(isset($_GET['post']))
            $curr_page_id = $_GET['post'];
        else if(isset($_POST['post_ID']))
            $curr_page_id = $_POST['post_ID'];

        if ( ! isset( $curr_page_id ) ) {
            return;
        }

        $slug = get_post_field( 'post_name', $curr_page_id );

        // Get the name of the Page Template file.
        $template_file = get_post_meta( $curr_page_id, '_wp_page_template', true );
        $template_name = basename($template_file, ".php");
        $editable_templates = array('area-stampa');

        //se la pagina utilizza un template del Sito dei Comuni
        if (in_array($template_name, dci_get_pagine_template_names())) {

            if (!in_array($template_name, $editable_templates, true)) {
                remove_post_type_support( 'page', 'editor' );

                remove_post_type_support( 'page', 'title' );

                $args['attributes'] = array(
                    'required' => 'required',
                    'maxlength' => 255,
                    'readonly' => true
                );
            }
        }

    }

    $cmb_descrizione->add_field($args);

    /**
     * Documenti Area Stampa
     */
    $cmb_area_stampa_docs = new_cmb2_box( array(
        'id'           => $prefix . 'box_area_stampa_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_on'      => array(
            'key'   => 'page-template',
            'value' => 'page-templates/area-stampa.php',
        ),
    ) );

    $group_field_doc_id = $cmb_area_stampa_docs->add_field( array(
        'id'      => $prefix . 'area_stampa_docs',
        'type'    => 'group',
        'options' => array(
            'group_title'   => __( 'Documento {#}', 'design_comuni_italia' ),
            'add_button'    => __( 'Aggiungi un documento', 'design_comuni_italia' ),
            'remove_button' => __( 'Rimuovi il documento', 'design_comuni_italia' ),
            'sortable'      => true,
        ),
    ) );

    $cmb_area_stampa_docs->add_group_field( $group_field_doc_id, array(
        'id'      => 'docs_tipo',
        'name'    => __( 'Tipo', 'design_comuni_italia' ),
        'desc'    => __( 'Scegli se allegare un file o inserire un link esterno', 'design_comuni_italia' ),
        'type'    => 'select',
        'options' => array(
            '' => __( 'Seleziona', 'design_comuni_italia' ),
            'file' => __( 'File', 'design_comuni_italia' ),
            'link' => __( 'Link', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_area_stampa_docs->add_group_field( $group_field_doc_id, array(
        'id'   => 'docs_allegato',
        'name' => __( 'Allegato', 'design_comuni_italia' ),
        'desc' => __( 'Carica il file da rendere disponibile all\'area stampa.', 'design_comuni_italia' ),
        'type' => 'file',
        'attributes' => array(
            'data-conditional-id'    => 'docs_tipo',
            'data-conditional-value' => 'file',
        ),
    ) );

    $cmb_area_stampa_docs->add_group_field( $group_field_doc_id, array(
        'id'   => 'docs_link',
        'name' => __( 'Link', 'design_comuni_italia' ),
        'desc' => __( 'URL esterno del documento (alternativa all\'upload)', 'design_comuni_italia' ),
        'type' => 'text_url',
        'attributes' => array(
            'data-conditional-id'    => 'docs_tipo',
            'data-conditional-value' => 'link',
        ),
    ) );

    $cmb_area_stampa_docs->add_group_field( $group_field_doc_id, array(
        'id'   => 'label_allegato',
        'name' => __( 'Etichetta', 'design_comuni_italia' ),
        'type' => 'text',
    ) );


    /**
     * Spazi della cultura / luoghi (template Chi siamo)
     */
    $cmb_chi_siamo_luoghi = new_cmb2_box( array(
        'id'           => $prefix . 'box_chi_siamo_luoghi',
        'title'        => __( 'Spazi della cultura', 'design_comuni_italia' ),
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_on'      => array(
            'key'   => 'page-template',
            'value' => 'page-templates/chi-siamo.php',
        ),
    ) );
    $luoghi = $cmb_chi_siamo_luoghi->add_field( array(
      'id'            => $prefix . 'luoghi',
      'name'          => __( 'Seleziona i luoghi', 'design_comuni_italia' ),
      'desc'          => __( 'Scegli un luogo esistente o <a target="_blank" href="post-new.php?post_type=luogo">Inserisci un nuovo luogo</a>.' , 'design_comuni_italia' ),
      'type'          => 'pw_multiselect',
      'options'       => dci_get_posts_options('luogo'),
      'attributes'    => array(
        'placeholder' =>  __( ' Selezionai luoghi', 'design_comuni_italia' ),
      ),
    ) );

    /**
     * Aree tematiche (template Chi siamo)
     */
    $cmb_chi_siamo_aree = new_cmb2_box( array(
        'id'           => $prefix . 'box_chi_siamo_aree',
        'title'        => __( 'Aree tematiche', 'design_comuni_italia' ),
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_on'      => array(
            'key'   => 'page-template',
            'value' => 'page-templates/chi-siamo.php',
        ),
    ) );

    $group_field_area_id = $cmb_chi_siamo_aree->add_field( array(
        'id'      => $prefix . 'aree_tematiche',
        'type'    => 'group',
        'options' => array(
            'group_title'   => __( 'Area tematica {#}', 'design_comuni_italia' ),
            'add_button'    => __( 'Aggiungi area tematica', 'design_comuni_italia' ),
            'remove_button' => __( 'Rimuovi area tematica', 'design_comuni_italia' ),
            'sortable'      => true,
        ),
    ) );

    $cmb_chi_siamo_aree->add_group_field( $group_field_area_id, array(
        'id'         => 'titolo',
        'name'       => __( 'Titolo', 'design_comuni_italia' ),
        'type'       => 'text',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    $cmb_chi_siamo_aree->add_group_field( $group_field_area_id, array(
        'id'      => 'testo',
        'name'    => __( 'Testo', 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 6,
            'teeny'         => true,
        ),
    ) );

    $cmb_chi_siamo_aree->add_group_field( $group_field_area_id, array(
        'id'           => 'immagine',
        'name'         => __( 'Immagine', 'design_comuni_italia' ),
        'type'         => 'file',
        'options'      => array(
            'url' => false,
        ),
        'preview_size' => 'medium',
        'query_args'   => array(
            'type' => array(
                'image/jpeg',
                'image/png',
                'image/gif',
            ),
        ),
    ) );

    $cmb_chi_siamo_aree->add_group_field( $group_field_area_id, array(
        'id'               => 'argomento',
        'name'             => __( 'Argomento collegato', 'design_comuni_italia' ),
        'desc'             => __( 'Seleziona un termine della tassonomia Argomenti per il pulsante di approfondimento.', 'design_comuni_italia' ),
        'type'             => 'select',
        'options_cb'       => 'dci_get_argomenti_terms_options',
        'show_option_none' => true,
        'sanitize_cb'      => 'absint',
    ) );

    /**
     * Bandi e gare (template Chi siamo)
     */
    $cmb_chi_siamo_bandi = new_cmb2_box( array(
        'id'           => $prefix . 'box_chi_siamo_bandi',
        'title'        => __( 'Bandi e gare', 'design_comuni_italia' ),
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_on'      => array(
            'key'   => 'page-template',
            'value' => 'page-templates/chi-siamo.php',
        ),
    ) );

    $group_field_bandi_id = $cmb_chi_siamo_bandi->add_field( array(
        'id'      => $prefix . 'bandi',
        'type'    => 'group',
        'options' => array(
            'group_title'   => __( 'Bando {#}', 'design_comuni_italia' ),
            'add_button'    => __( 'Aggiungi bando', 'design_comuni_italia' ),
            'remove_button' => __( 'Rimuovi bando', 'design_comuni_italia' ),
            'sortable'      => true,
        ),
    ) );

    $cmb_chi_siamo_bandi->add_group_field( $group_field_bandi_id, array(
        'id'         => 'titolo',
        'name'       => __( 'Titolo bando', 'design_comuni_italia' ),
        'type'       => 'text',
        'attributes' => array( 'required' => 'required' ),
    ) );

    $cmb_chi_siamo_bandi->add_group_field( $group_field_bandi_id, array(
        'id'   => 'data_pubblicazione',
        'name' => __( 'Data pubblicazione', 'design_comuni_italia' ),
        'type' => 'text_date',
        'date_format' => 'd/m/Y',
    ) );

    $cmb_chi_siamo_bandi->add_group_field( $group_field_bandi_id, array(
        'id'   => 'data_chiusura',
        'name' => __( 'Data chiusura', 'design_comuni_italia' ),
        'type' => 'text_date',
        'date_format' => 'd/m/Y',
    ) );

    $cmb_chi_siamo_bandi->add_group_field( $group_field_bandi_id, array(
        'id'   => 'link',
        'name' => __( 'Link pagina esterna', 'design_comuni_italia' ),
        'type' => 'text_url',
    ) );

}

/**
 * Opzioni dinamiche per il select Argomenti (template Chi siamo)
 * @return array
 */
function dci_get_argomenti_terms_options() {
    return dci_get_terms_options( 'argomenti' );
}

/**
 * disabilito quick edit del titolo per le pagine del Sito dei Comuni
 * @param $actions
 * @param $post
 * @return mixed
 */
function dci_page_row_actions( $actions, $post ) {

    //se la pagina ha slug tra le pagine create all'attivazione del tema
    if ( 'page' === $post->post_type && in_array ($post->post_name, dci_get_pagine_slugs())) {

        // Removes the "Quick Edit" action.
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}
add_filter( 'page_row_actions', 'dci_page_row_actions', 10, 2 );
