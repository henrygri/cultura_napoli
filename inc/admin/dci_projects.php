<?php

/**
 * Definisce post type Projects (per gestire i progetti del Comune)
 */
add_action( 'init', 'dci_register_post_type_project', 1 );

function dci_register_post_type_project() {
    $labels = array(
        'name'                  => _x( 'Progetti', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Progetto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'              => _x( 'Aggiungi un Progetto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'         => _x( 'Aggiungi un Progetto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'edit_item'            => _x( 'Modifica Progetto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'            => _x( 'Visualizza il Progetto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image'   => __( 'Seleziona Immagine Progetto' ),
        'remove_featured_image'=> __( 'Rimuovi Immagine Progetto' , 'design_comuni_italia' ),
        'use_featured_image'   => __( 'Usa come Immagine Progetto' , 'design_comuni_italia' ),
    );
    
    $args = array(
        'label'                 => __( 'Progetti', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 34,
        'menu_icon'             => 'dashicons-grid-view',
        'has_archive'           => true,
        'map_meta_cap'          => true,
        'capability_type'       => 'post',
        'description'           => __( "Sezione per la gestione dei progetti culturali di lungo corso", 'design_comuni_italia' ),
    );
    
    register_post_type( 'progetto', $args );
}


/**
 * Crea i metabox del post type Project
 */
add_action( 'cmb2_init', 'dci_add_project_metaboxes' );
function dci_add_project_metaboxes() {
    $prefix = '_dci_project_';

    $cmb_target = new_cmb2_box(array(
        'id' => $prefix . 'box_target',
        'title' => __('Target', 'design_comuni_italia'),
        'object_types' => array('progetto'),
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
        'object_types' => array( 'progetto' ),
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
        'id' => $prefix . 'data_orario_inizio',
        'name'    => __( 'Data e orario di inizio', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'data_orario_fine',
        'name'    => __( 'Data e orario di fine', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
    ) );
    

    $cmb_apertura->add_field( array(
        'name'       => __('Immagine', 'design_comuni_italia' ),
        'desc' => __( 'Immagine del progetto' , 'design_comuni_italia' ),
        'id'             => $prefix . 'immagine',
        'type' => 'file',
        'query_args' => array( 'type' => 'image' ),
    ));

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'descrizione_breve',
        'name'        => __( 'Descrizione breve *', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione sintentica del progetto, inferiore a 255 caratteri' , 'design_comuni_italia' ),
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
        'object_types' => array( 'progetto' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'descrizione_completa',
        'name'        => __( 'Descrizione completa *', 'design_comuni_italia' ),
        'desc' => __( 'Introduzione e descrizione esaustiva del progetto' , 'design_comuni_italia' ),
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

    /*$cmb_descrizione->add_field( array(
        'id' => $prefix . 'a_chi_e_rivolto',
        'name'        => __( 'A chi è rivolto', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione testuale dei principali destinatari del progetto' , 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => false,
        ),
    ) );*/

    $cmb_gallerie_multimediali = new_cmb2_box( array(
        'id'           => $prefix . 'box_gallerie_multimediali',
        'title'        => __( 'Gallerie multimediali', 'design_comuni_italia' ),
        'object_types' => array( 'progetto' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'gallery',
        'name'       => __( 'Galleria di immagini', 'design_comuni_italia' ),
        'desc'       => __( 'Una o più immagini corredate da didascalie', 'design_comuni_italia' ),
        'type' => 'file_list',
        'query_args' => array( 'type' => 'image' ),
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'video',
        'name'       => __( 'Video', 'design_comuni_italia' ),
        'desc'       => __( 'Un video rappresentativo del progetto (è possibile insirerire un url esterno).', 'design_comuni_italia' ),
        'type' => 'file',
        'query_args' => array( 'type' => 'video' ),
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'trascrizione',
        'name'       => __( 'Trascrizione', 'design_comuni_italia' ),
        'desc'       => __( 'Trascrizione del video', 'design_comuni_italia' ),
        'type' => 'textarea'
    ) );

     //DOCUMENTI
    $cmb_documenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'progetto' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    // repeater Documenti
    $group_field_doc_id = $cmb_documenti->add_field( array(
        'id'          => $prefix . 'docs',
        'type'        => 'group',
        'options'     => array(
        'group_title'    => __( 'Documento {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
        'add_button'     => __( 'Aggiungi un documento', 'design_comuni_italia' ),
        'remove_button'  => __( 'Rimuovi il documento', 'design_comuni_italia' ),
        'sortable'       => true,
        ),
    ) );

    $cmb_documenti->add_group_field( $group_field_doc_id, array(
        'id' => 'docs_tipo',
        'name'        => __( 'Tipo', 'design_comuni_italia' ),
        'desc'        => __( 'Scegli se allegare un file o inserire un link esterno', 'design_comuni_italia' ),
        'type'        => 'radio_inline',
        'default_cb'  => function() { return 'file'; },
        'options'     => array(
            'file' => __( 'File', 'design_comuni_italia' ),
            'link' => __( 'Link', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_documenti->add_group_field( $group_field_doc_id, array(
        'id' => 'docs_allegato',
        'name'        => __( 'Allegato', 'design_comuni_italia' ),
        'desc' => __( 'Eventuali documenti in allegato' , 'design_comuni_italia' ),
        'type' => 'file',
        'attributes' => array(
            'data-conditional-id'    => 'docs_tipo',
            'data-conditional-value' => 'file',
        ),
    ) );

    $cmb_documenti->add_group_field( $group_field_doc_id, array(
        'id' => 'docs_link',
        'name'        => __( 'Link', 'design_comuni_italia' ),
        'desc' => __( 'URL esterno del documento (alternativa all\'upload)', 'design_comuni_italia' ),
        'type' => 'text_url',
        'attributes' => array(
            'data-conditional-id'    => 'docs_tipo',
            'data-conditional-value' => 'link',
        ),
    ) );

    $cmb_documenti->add_group_field( $group_field_doc_id, array(
        'id' => 'label_allegato',
        'name'        => __( 'Etichetta', 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    //CONTATTI
    $cmb_contatti = new_cmb2_box( array(
        'id'           => $prefix . 'box_contatti',
        'title'        => __( 'Contatti', 'design_comuni_italia' ),
        'object_types' => array( 'progetto' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'punti_contatto',
        'name'        => __( 'Punti di contatto', 'design_comuni_italia' ),
        'desc' => __( 'Telefono, mail o altri punti di contatto<br><a href="post-new.php?post_type=punto_contatto">Inserisci Punto di Contatto</a>' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('punto_contatto'),
        'attributes'    => array(
            'placeholder' =>  __( ' Seleziona i Punti di Contatto', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'specifica_contatti',
        'name'        => __( 'Specifica contatti', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione testuale' , 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => false,
        ),
    ) );


}





