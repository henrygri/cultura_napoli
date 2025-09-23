<?php
    global $luogo, $luoghi;
    $prefix = '_dci_luogo_';
    $indirizzo = dci_get_meta('indirizzo', $prefix, $luogo->ID);
?>
<?php 
    $luoghi = array($luogo);
    get_template_part("template-parts/luogo/map"); 
?>
<div class="card">
  <div class="card-body">
    <h3 class="card-title h5">
      <svg class="icon">
        <use xlink:href="#it-map-marker" aria-hidden="true"></use>
      </svg>
      <a class="text-decoration-none text-black" href="<?php echo get_permalink($luogo->ID); ?>"><?php echo $luogo->post_title; ?></a>
    </h3>
    <div class="card-text text-secondary">
      <p><?php echo $indirizzo; ?></p>
    </div>
  </div>
</div>
