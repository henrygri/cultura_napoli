<?php

/**
 * Definisce post type Focus (una specie di mediateca)
 */
add_action( 'init', 'dci_register_post_type_focus', 1 );

function dci_register_post_type_focus() {
    $labels = array(
        'name'                  => _x( 'Focus', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Focus', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'              => _x( 'Aggiungi un Focus', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'         => _x( 'Aggiungi un Focus ', 'Post Type Singular Name', 'design_comuni_italia' ),
        'edit_item'            => _x( 'Modifica Focus', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'            => _x( 'Visualizza il Focus', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image'   => __( 'Seleziona Immagine Focus' ),
        'remove_featured_image'=> __( 'Rimuovi Immagine Focus' , 'design_comuni_italia' ),
        'use_featured_image'   => __( 'Usa come Immagine Focus' , 'design_comuni_italia' ),
    );

    $args = array(
        'label'                 => __( 'Focus', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 34,
        'menu_icon'             => 'dashicons-welcome-view-site',
        'has_archive'           => true,
        'map_meta_cap'          => true,
        'capability_type'       => 'post',
        'description'           => __( "Sezione per la gestione di una mediateca", 'design_comuni_italia' ),
    );

    register_post_type( 'focus', $args );
}


/**
 * Crea i metabox del post type Focus
 */
add_action( 'cmb2_init', 'dci_add_focus_metaboxes' );
function dci_add_focus_metaboxes() {
    $prefix = '_dci_focus_';

    $cmb_target = new_cmb2_box(array(
        'id' => $prefix . 'box_target',
        'title' => __('Target', 'design_comuni_italia'),
        'object_types' => array('focus'),
        'context' => 'side',
        'priority' => 'high',
    ));

    $cmb_target->add_field( array(
        'id'        => $prefix . 'target',
        'name'      => __( 'Target', 'design_comuni_italia' ),
        'desc'      => __( 'Seleziona i target di riferimento', 'design_comuni_italia' ),
        'type'           => 'taxonomy_multicheck_hierarchical',
        'taxonomy'       => 'target',
        'remove_default' => 'true'
    ) );

     $cmb_apertura = new_cmb2_box( array(
        'id'           => $prefix . 'box_apertura',
        'title'        => __( 'Apertura', 'design_comuni_italia' ),
        'object_types' => array( 'focus' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'sottotitolo',
        'name'        => __( 'Sottotitolo', 'design_comuni_italia' ),
        'desc' => __( 'Eventuale sottotitolo o titolo abbreviato' , 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'maxlength'  => '255'
        )
    ) );

    $cmb_apertura->add_field( array(
        'name'       => __('Immagine', 'design_comuni_italia' ),
        'desc' => __( 'Immagine del focus' , 'design_comuni_italia' ),
        'id'             => $prefix . 'immagine',
        'type' => 'file',
        'query_args' => array( 'type' => 'image' ),
    ));

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'descrizione_breve',
        'name'        => __( 'Descrizione breve *', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione sintentica del focus, inferiore a 255 caratteri' , 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes'    => array(
            'maxlength'  => '255',
            'required'    => 'required'
        ),
    ) );

    //COS'E'
    $cmb_descrizione = new_cmb2_box( array(
        'id'           => $prefix . 'box_descrizione',
        'title'        => __( 'Cos\'è', 'design_comuni_italia' ),
        'object_types' => array( 'focus' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'descrizione_completa',
        'name'        => __( 'Descrizione completa *', 'design_comuni_italia' ),
        'desc' => __( 'Introduzione e descrizione esaustiva del focus' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => false,
        ),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );


     //MODULI
    $cms_moduli = new_cmb2_box( array(
        'id'           => $prefix . 'moduli',
        'title'        => __( 'Moduli', 'design_comuni_italia' ),
        'object_types' => array( 'focus' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    // repeater moduli
    $group_field_doc_id = $cms_moduli->add_field( array(
        'id'          => $prefix . 'modulo',
        'type'        => 'group',
        'options'     => array(
        'group_title'    => __( 'Modulo {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
        'add_button'     => __( 'Aggiungi un moduko', 'design_comuni_italia' ),
        'remove_button'  => __( 'Rimuovi il modulo', 'design_comuni_italia' ),
        'sortable'       => true,
        ),
    ) );

    $cms_moduli->add_group_field( $group_field_doc_id, array(
        'id' => 'modulo_tipo',
        'name'        => __( 'Tipo', 'design_comuni_italia' ),
        'desc'        => __( 'Scegli che tipo di modulo aggiungere', 'design_comuni_italia' ),
        'type'        => 'select',
        'options'     => array(
            '-' => '',
            'textarea' => __( 'Testo', 'design_comuni_italia' ),
            'image' => __( 'Immagine', 'design_comuni_italia' ),
            'gallery' => __( 'Gallery', 'design_comuni_italia' ),
            'youtube_video' => __( 'Video Youtube', 'design_comuni_italia' ),
            'spotify_podcast' => __( 'Spotify Podcast', 'design_comuni_italia' ),
            // 'audio' => __( 'Audio', 'design_comuni_italia' ),
            'file' => __( 'File', 'design_comuni_italia' ),
        ),
    ) );

    $cms_moduli->add_group_field( $group_field_doc_id, array(
        'id' => 'modulo_testo',
        'name' => __( 'Aggiugi testo', 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes' => array(
            'data-conditional-id'    => 'modulo_tipo',
            'data-conditional-value' => 'textarea',
        ),
    ) );

    $cms_moduli->add_group_field( $group_field_doc_id, array(
        'id' => 'modulo_file',
        'name' => __( 'Aggiungi un solo file', 'design_comuni_italia' ),
        'type' => 'file',
        'attributes' => array(
            'data-conditional-id'    => 'modulo_tipo',
            'data-conditional-value' => array('image', 'file'),
        ),
    ) );

    $cms_moduli->add_group_field( $group_field_doc_id, array(
        'id' => 'modulo_label',
        'name' => __( 'Aggiungi il nome del file', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'data-conditional-id'    => 'modulo_tipo',
            'data-conditional-value' => 'file',
        ),
    ) );

    $cms_moduli->add_group_field( $group_field_doc_id, array(
        'id' => 'modulo_gallery',
        'name' => __( 'Aggiungi più file', 'design_comuni_italia' ),
        'type' => 'file_list',
        'attributes' => array(
            'data-conditional-id'    => 'modulo_tipo',
            'data-conditional-value' => 'gallery',
        ),
    ) );

    $cms_moduli->add_group_field( $group_field_doc_id, array(
        'id' => 'modulo_youtube',
        'name' => __( 'Aggiungi shortlink', 'design_comuni_italia' ),
        'type' => 'text_url',
        'description' => 'Lo trovi cliccando "Condividi" sotto il video di Youtube. Es. https://youtu.be/7tuL-sfUU5',
        'protocols' => array('https'),
        'attributes' => array(
            'data-conditional-id'    => 'modulo_tipo',
            'data-conditional-value' => 'youtube_video',
        ),
    ) );

    $cms_moduli->add_group_field( $group_field_doc_id, array(
        'id' => 'modulo_embed',
        'name' => __( 'Aggiungi il codice di embedd', 'design_comuni_italia' ),
        'type' => 'textarea_code',
        'attributes' => array(
            'data-conditional-id'    => 'modulo_tipo',
            'data-conditional-value' => 'spotify_podcast',
        ),
    ) );

}
