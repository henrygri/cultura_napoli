<?php
/**
 * Definisce la tassonomia Quartieri
 */
add_action( 'init', 'dci_register_taxonomy_quartieri', -10 );
function dci_register_taxonomy_quartieri() {

    $labels = array(
        'name'              => _x( 'Quartieri', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Quartiere', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Quartiere', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Quartieri', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica Quartiere', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna Quartiere', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi Quartiere', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Quartiere', 'design_comuni_italia' ),
        'menu_name'         => __( 'Quartieri', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'capabilities'      => array(
            'manage_terms'  => 'manage_quartieri',
            'edit_terms'    => 'edit_quartieri',
            'delete_terms'  => 'delete_quartieri',
            'assign_terms'  => 'assign_quartieri'
        )
    );

    register_taxonomy( 'quartieri', array( 'luogo' ), $args );

}



