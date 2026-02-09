<?php
    global $post;

        $description = dci_get_meta('descrizione_breve');
        $arrdata = dci_get_data_pubblicazione_arr("data_pubblicazione", '_dci_notizia_', $post->ID);
        $pubblicazione = dci_get_meta('data_pubblicazione');
        $scadenza = dci_get_meta('data_scadenza');
        $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
        $img = dci_get_meta('immagine');
        $tipo = get_the_terms($post->term_id, 'tipi_notizia')[0];
        if ($img) {
?>
  <div class="card-wrapper h-100 border rounded-3 ">
    <a class="card card-novita no-after rounded-3" href="<?php echo get_permalink(); ?>">

      <div class="img-responsive-wrapper">
        <div class="img-responsive img-responsive-panoramic">
          <figure class="img-wrapper">
            <?php dci_get_img($img, ''); ?>
          </figure>
        </div>
      </div>

      <div class="card-body <?php echo($pubblicazione || $scadenza) ?: 'no-footer'; ?>">
        <div class="category-top">
          <?php /*
          <a class="category text-decoration-none" href="<?php echo get_term_link($tipo->term_id); ?>">
            <?php echo strtoupper($tipo->name); ?>
          </a>
          */ ?>
          <span class="category text-decoration-none">
            <?php echo strtoupper($tipo->name); ?>
          </span>
          <span class="data"><?php echo $arrdata[0].' '.strtoupper($monthName).' '.$arrdata[2] ?></span>
        </div>
        <h3 class="h4 card-title"><?php echo the_title(); ?></h3>
        <p class="card-text text-secondary">
          <?php echo $description; ?>
        </p>
      </div>
      <?php if ( $pubblicazione || $scadenza ) : ?>
        <div class="card-footer text-secondary">
          <?php if ( $pubblicazione ) : ?>
            <span><?php esc_html_e( 'Pubblicazione:', 'design_comuni_italia' ); ?></span>
            <?php echo date( 'd/m/Y', $pubblicazione  ); ?><br>
          <?php endif; ?>
          <?php if ( $scadenza ) : ?>
            <span><?php esc_html_e( 'Scadenza:', 'design_comuni_italia' ); ?></span>
            <?php echo date( 'd/m/Y', $scadenza  ); ?><br>
          <?php endif; ?>
        </div>
      <?php endif; ?>

    </a>
  </div>
<?php } else { ?>
  <div class="card-wrapper h-100 border rounded-3 shadow-sm cmp-list-card-img cmp-list-card-img-hr">
    <div class="card no-after rounded-3">
      <div class="row g-2 g-md-0 flex-md-column">
        <div class="col-12 order-1 order-md-2">
          <div class="card-body card-img-none rounded-top">
            <div class="category-top">
              <span class="category text-decoration-none">
                <?php echo strtoupper($tipo->name); ?>
              </span>
              <span class="data"><?php echo $arrdata[0].' '.strtoupper($monthName).' '.$arrdata[2] ?></span>
            </div>
            <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
              <h3 class="h4 card-title"><?php echo the_title(); ?></h3>
            </a>
            <p class="card-text text-secondary">
              <?php echo $description; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
