<?php
/**
 * Definisce la tassonomia Target
 */
add_action( 'init', 'dci_register_taxonomy_target', -15 );

/**
 * Register the 'target' taxonomy for the 'luogo' post type.
 *
 * This function sets labels, visibility and custom capabilities for
 * managing target terms in the admin area.
 */
function dci_register_taxonomy_target() {

    $labels = array(
        'name'              => _x( 'Target', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Target', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Target', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Target', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica Target', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna Target', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi Target', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Target', 'design_comuni_italia' ),
        'menu_name'         => __( 'Target', 'design_comuni_italia' ),
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
            'manage_terms'  => 'manage_target',
            'edit_terms'    => 'edit_target',
            'delete_terms'  => 'delete_target',
            'assign_terms'  => 'assign_target'
        )
    );

    register_taxonomy( 'target', array('luogo','itinerario','evento','progetto'), $args );

}