<?php
/**
 * Definisce post type Itinerari
 */
add_action( 'init', 'dci_register_post_type_itinerario', 1 );

function dci_register_post_type_itinerario() {
    $labels = array(
        'name'                  => _x( 'Itinerari', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Itinerario', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Itinerario', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'          => _x( 'Aggiungi un Itinerario', 'Post Type Singular Name', 'design_comuni_italia' ),
        'edit_item'             => _x( 'Modifica Itinerario', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'             => _x( 'Visualizza l’Itinerario', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image'    => __( 'Seleziona Immagine Itinerario', 'design_comuni_italia' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Itinerario' , 'design_comuni_italia' ),
        'use_featured_image'    => __( 'Usa come Immagine Itinerario' , 'design_comuni_italia' ),
    );

    $args = array(
        'label'                 => __( 'Itinerari', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-location-alt', // 🧭 più coerente con itinerari
        'has_archive'           => true,
        'map_meta_cap'          => true,
        'capability_type'       => 'post',
        'description'           => __( "Sezione per la gestione degli itinerari culturali di lungo corso", 'design_comuni_italia' ),
        'show_in_rest'          => true,
    );

    register_post_type( 'itinerario', $args );
}

/**
 * Crea i metabox del post type Itinerario
 */
add_action( 'cmb2_init', 'dci_add_itinerario_metaboxes' );
function dci_add_itinerario_metaboxes() {
    $prefix = '_dci_itinerario_';

    // APERTURA
    $cmb_apertura = new_cmb2_box( array(
        'id'           => $prefix . 'box_apertura',
        'title'        => __( 'Apertura', 'design_comuni_italia' ),
        'object_types' => array( 'itinerario' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'sottotitolo',
        'name' => __( 'Sottotitolo', 'design_comuni_italia' ),
        'desc' => __( 'Eventuale sottotitolo o titolo abbreviato', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array( 'maxlength' => '255' ),
    ) );

    $cmb_apertura->add_field( array(
        'id'          => $prefix . 'data_orario_inizio',
        'name'        => __( 'Data e orario di inizio', 'design_comuni_italia' ),
        'type'        => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
    ) );

    $cmb_apertura->add_field( array(
        'id'          => $prefix . 'data_orario_fine',
        'name'        => __( 'Data e orario di fine', 'design_comuni_italia' ),
        'type'        => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
    ) );

    $cmb_apertura->add_field( array(
        'name'       => __( 'Immagine', 'design_comuni_italia' ),
        'desc'       => __( 'Immagine rappresentativa dell’itinerario', 'design_comuni_italia' ),
        'id'         => $prefix . 'immagine',
        'type'       => 'file',
        'query_args' => array( 'type' => 'image' ),
    ));

    $cmb_apertura->add_field( array(
        'id'   => $prefix . 'descrizione_breve',
        'name' => __( 'Descrizione breve *', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione sintetica dell’itinerario, inferiore a 255 caratteri', 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes' => array(
            'maxlength' => '255',
            'required'  => 'required',
        ),
    ) );

    //argomenti
    $cmb_argomenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_argomenti',
        'title'        => __( 'Argomenti', 'design_comuni_italia' ),
        'object_types' => array( 'itinerario' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );

    $cmb_argomenti->add_field( array(
        'id' => $prefix . 'argomenti',
        'type'             => 'taxonomy_multicheck_hierarchical',
        'taxonomy'       => 'argomenti',
        'show_option_none' => false,
        'remove_default' => 'true',
    ) );

    // COS'E'
    $cmb_descrizione = new_cmb2_box( array(
        'id'           => $prefix . 'box_descrizione',
        'title'        => __( 'Cos\'è', 'design_comuni_italia' ),
        'object_types' => array( 'itinerario' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_descrizione->add_field( array(
        'id'      => $prefix . 'descrizione_completa',
        'name'    => __( 'Descrizione completa *', 'design_comuni_italia' ),
        'desc'    => __( 'Introduzione e descrizione esaustiva dell’itinerario', 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny'         => false,
        ),
        'attributes' => array( 'required' => 'required' ),
    ) );

    $cmb_descrizione->add_field( array(
        'id'      => $prefix . 'a_chi_e_rivolto',
        'name'    => __( 'A chi è rivolto', 'design_comuni_italia' ),
        'desc'    => __( 'Descrizione dei principali destinatari dell’itinerario', 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny'         => false,
        ),
    ) );

    // GALLERIE MULTIMEDIALI
    $cmb_gallerie_multimediali = new_cmb2_box( array(
        'id'           => $prefix . 'box_gallerie_multimediali',
        'title'        => __( 'Gallerie multimediali', 'design_comuni_italia' ),
        'object_types' => array( 'itinerario' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'gallery',
        'name'       => __( 'Galleria di immagini', 'design_comuni_italia' ),
        'desc'       => __( 'Una o più immagini corredate da didascalie', 'design_comuni_italia' ),
        'type'       => 'file_list',
        'query_args' => array( 'type' => 'image' ),
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'video',
        'name'       => __( 'Video', 'design_comuni_italia' ),
        'desc'       => __( 'Un video rappresentativo dell’itinerario (è possibile inserire un URL esterno).', 'design_comuni_italia' ),
        'type'       => 'file',
        'query_args' => array( 'type' => 'video' ),
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'    => $prefix . 'trascrizione',
        'name'  => __( 'Trascrizione', 'design_comuni_italia' ),
        'desc'  => __( 'Trascrizione del video', 'design_comuni_italia' ),
        'type'  => 'textarea',
    ) );

    // DOCUMENTI
    $cmb_documenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'itinerario' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_documenti->add_field( array(
        'id'   => $prefix . 'allegati',
        'name' => __( 'Allegati', 'design_comuni_italia' ),
        'desc' => __( 'Eventuali documenti in allegato', 'design_comuni_italia' ),
        'type' => 'file',
    ) );

    // LUOGHI
    $cmb_luoghi = new_cmb2_box( array(
        'id'           => $prefix . 'box_luoghi',
        'title'        => __( 'Luoghi', 'design_comuni_italia' ),
        'object_types' => array( 'itinerario' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_luoghi->add_field( array(
        'id'      => $prefix . 'luoghi',
        'name'    => __( 'Luoghi', 'design_comuni_italia' ),
        'desc'    => __( 'Seleziona gli luoghi percorsi durante l\' itinerario.', 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options( 'luogo' ),
        'attributes' => array(
            'placeholder' => __( ' Seleziona luoghi', 'design_comuni_italia' ),
        ),
    ) );


    // CONTATTI
    $cmb_contatti = new_cmb2_box( array(
        'id'           => $prefix . 'box_contatti',
        'title'        => __( 'Contatti', 'design_comuni_italia' ),
        'object_types' => array( 'itinerario' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_contatti->add_field( array(
        'id'      => $prefix . 'punti_contatto',
        'name'    => __( 'Punti di contatto', 'design_comuni_italia' ),
        'desc'    => __( 'Telefono, mail o altri punti di contatto<br><a href="post-new.php?post_type=punto_contatto">Inserisci Punto di Contatto</a>', 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options( 'punto_contatto' ),
        'attributes' => array(
            'placeholder' => __( ' Seleziona i Punti di Contatto', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_contatti->add_field( array(
        'id'      => $prefix . 'specifica_contatti',
        'name'    => __( 'Specifica contatti', 'design_comuni_italia' ),
        'desc'    => __( 'Descrizione testuale', 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny'         => false,
        ),
    ) );
}
