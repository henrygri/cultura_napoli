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
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-grid-view',
        'has_archive'           => true,
        'capability_type'       => 'post',
        'description'           => __( "Struttura per la gestione dei progetti del Comune", 'design_comuni_italia' ),
    );
    
    register_post_type( 'progetto', $args );
}


/**
 * Crea i metabox del post type Project
 */
add_action( 'cmb2_init', 'dci_add_project_metaboxes' );
function dci_add_project_metaboxes() {
    $prefix = '_dci_project_';
}





