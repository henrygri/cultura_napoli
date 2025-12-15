<?php
global $scheda;

$post = get_post($scheda)??null;
$img = dci_get_meta('immagine');
$descrizione_breve = dci_get_meta('descrizione_breve');
$start_timestamp = dci_get_meta("data_orario_inizio", $prefix, $post->ID);
$start_date = date_i18n('d F Y', date($start_timestamp));
$start_date_arr = explode('-', date_i18n('d-F-Y-H-i', date($start_timestamp)));
$end_timestamp = dci_get_meta("data_orario_fine", $prefix, $post->ID);
$end_date = date_i18n('d F Y', date($end_timestamp));
$end_date_arr = explode('-', date_i18n('d-F-Y-H-i', date($end_timestamp)));$arrdata = explode('-', date_i18n("j-F-Y", $timestamp));
$luogo_evento_id = dci_get_meta("luogo_evento", '_dci_evento_', $post->ID);
$luogo_evento = '';
if ( ! empty( $luogo_evento_id ) ) {
    $luogo_evento = get_the_title( $luogo_evento_id );
}
$icon = dci_get_post_type_icon_by_id($post->ID);

$page = get_page_by_path( dci_get_group($post->post_type) );

$page_macro_slug = dci_get_group($post->post_type);
$page_macro = get_page_by_path($page_macro_slug);
?>
<a
  class="card card-full card-flex no-after no-glow no-pop no-hover rounded-3 mb-0"
  href="<?php echo get_permalink($post->ID); ?>"
  aria-label="Vai alla pagina <?php echo $post->post_title ?>"
  title="Vai alla pagina <?php echo $post->post_title ?>"
  >
      <div class="card-image-wrapper">
        <div class="card-image rounded-3" style="background-image:url(<?php echo $img; ?>);"></div>
      </div>
      <div class="card-body p-3">
        <div class="row">
          <div class="col-lg-8 pe-lg-5">
            <?php /*
            <div class="category-top">
              <span class="category title-xsmall-semi-bold fw-semibold" ><?php echo $page->post_title ?></span>
            </div>
            */ ?>
            <h3 class="h4 card-title"><?php echo $post->post_title ?></h3>
            <p class="text-paragraph-card text-secondary m-0" style="margin-bottom: 40px!important;"><?php echo $descrizione_breve ?></p>
          </div>
          <div class="col-lg-4">
            <?php switch ( $page->post_title ) {
              case 'Eventi':
                  // codice per titolo "evento"
                  echo 'Dal '.$start_date_arr[0].' '.$start_date_arr[1];
                  echo ' al '.$end_date_arr[0].' '.$end_date_arr[1];
                  echo ($luogo_evento) ? '<br>'.$luogo_evento : '';
                  break;
              default: ?>
              <span class="read-more ps-3">
                  <span class="text">Vai alla pagina</span>
                  <svg class="icon">
                      <use xlink:href="#it-arrow-right"></use>
                  </svg>
              </span>
              <?php break;
            } ?>
          </div>
        </div>
      </div>
</a>
