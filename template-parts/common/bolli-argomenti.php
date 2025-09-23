<section class="bolli-argomenti py-4">
  <div class="container">
    <div class="row">
      <?php
      $terms = get_terms( array(
        'taxonomy'   => 'argomenti',
        'hide_empty' => false,
      ) );
      foreach ( $terms as $term ) {
        $term_link = get_term_link( $term );
        $img = dci_get_term_meta('immagine', "dci_term_", $term->term_id); // recupero immagine
        if ( ! is_wp_error( $term_link ) ) {
        ?>
        <div class="col-6 col-md-3 col-lg mb-3 mb-lg-0">
          <a href="<?php echo esc_url( $term_link ); ?>" class="icona-argomento clash-display-medium ">
            <figure class="rounded-circle">
              <?php if ( !empty($img) ) : ?>
                <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="img-fluid">
              <?php endif; ?>
            </figure>
            <div class="label"><?php echo esc_html( $term->name ); ?></div>
          </a>
        </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
</section>
