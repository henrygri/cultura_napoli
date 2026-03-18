<?php
  global $max_posts;
  $today = current_time('timestamp');

  $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 12;
  $args = array(
      'post_type'      => 'evento',
      'post_status'    => 'publish',
      'posts_per_page' => $max_posts,
      'meta_query' => array(
          'relation' => 'AND',

          // Filtro rassegna
          array(
              'relation' => 'OR',
              array(
                  'key'     => '_dci_evento_rassegna',
                  'value'   => 'on',
                  'compare' => '!=',
              ),
              array(
                  'key'     => '_dci_evento_rassegna',
                  'compare' => 'NOT EXISTS',
              ),
          ),

          // Logica eventi attuali/futuri
          array(
              'relation' => 'OR',

              // Caso 1: ha data fine → deve essere >= oggi
              array(
                  'key'     => '_dci_evento_data_orario_fine',
                  'value'   => $today,
                  'compare' => '>=',
                  'type'    => 'NUMERIC',
              ),

              // Caso 2: NON ha data fine → uso data inizio
              array(
                  'relation' => 'AND',
                  array(
                      'key'     => '_dci_evento_data_orario_fine',
                      'compare' => 'NOT EXISTS',
                  ),
                  array(
                      'key'     => '_dci_evento_data_orario_inizio',
                      'value'   => $today,
                      'compare' => '>=',
                      'type'    => 'NUMERIC',
                  ),
              ),
          ),
      ),

      // Ordina per data di inizio crescente
      'meta_key' => '_dci_evento_data_orario_inizio',
      'orderby'  => 'meta_value_num',
      'order'          => 'ASC'
  );
  $the_query = new WP_Query( $args );
  $posts = $the_query->posts;
?>


<section class="py-5">
  <div class="container">
    <div class="row py-3">
      <div class="col-12">
        <h2>I prossimi eventi</h2>
      </div>
    </div>
    <div class="row" id="load-more">
        <?php
        foreach ( $posts as $post ) {
            get_template_part('template-parts/evento/card');
        }
        ?>
    </div>
  </div>
</section>
<?php wp_reset_query(); ?>
