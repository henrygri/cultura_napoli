<?php
    global $luogo, $luoghi;
    $prefix = '_dci_luogo_';
    $indirizzo = dci_get_meta('indirizzo', $prefix, $luogo->ID);
?>
<?php 
    $luoghi = array($luogo);
    $posizione_gps = dci_get_meta("posizione_gps", $prefix, $luogo->ID);
    get_template_part("template-parts/luogo/map"); 
?>
<div class="card no-after no-pop no-glow no-hover">
  <div class="card-body d-lg-flex flex-lg-row justify-content-between">
    <div class="">
      <h3 class="card-title h5">
        <svg class="icon">
          <use xlink:href="#it-map-marker" aria-hidden="true"></use>
        </svg>
        <a class="text-decoration-none text-black" href="<?php echo get_permalink($luogo->ID); ?>"><?php echo $luogo->post_title; ?></a>
      </h3>
      <div class="card-text text-secondary">
        <p class="mb-0"><?php echo $indirizzo; ?><br><?php echo dci_get_quartieri($luogo->ID); ?></p>
      </div>
    </div>
    <div class="d-lg-flex flex-lg-column justify-content-center">
      <a class="btn btn-outline-secondary" target="_blank" href="https://www.google.com/maps/dir/?api=1&amp;destination=<?php echo $posizione_gps["lat"]; ?>,<?php echo $posizione_gps["lng"]; ?>">
        Ottieni indicazioni
        <svg class="icon ms-2">
          <use xlink:href="#it-arrow-right" aria-hidden="true"></use>
        </svg>
      </a>
    </div>
  </div>
</div>
