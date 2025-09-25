<?php
  global $max_posts;
  
  $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 12;
  $args = array(
      'post_type'      => 'evento',
      'post_status'    => 'publish',
      'posts_per_page' => $max_posts,
      'orderby'        => 'post_title',
      'order'          => 'ASC'
      //TO TO: meta query per prendere eventi con e data di fine evento superiore alla data odierna, ordinati per data di inizio crescente
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
