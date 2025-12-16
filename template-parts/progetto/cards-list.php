<?php
    global $post;

    $descrizione_breve = dci_get_meta("descrizione_breve", '_dci_project_', $post->ID);
    $img = dci_get_meta("immagine", '_dci_project_', $post->ID);
    if ($img) {
?>
<div class="col-md-6">
  <div class="card-wrapper">
    <a class="card card-progetto no-after rounded-3 border border-light no-glow" href="<?php echo get_permalink(); ?>">

      <div class="img-responsive-wrapper">
        <div class="img-responsive img-responsive-panoramic">
          <figure class="img-wrapper">
            <?php dci_get_img($img, ''); ?>
          </figure>
        </div>
      </div>

      <div class="card-body">
        <h3 class="h4 card-title"><?php echo the_title(); ?></h3>
        <p class="card-text text-secondary">
          <?php echo $descrizione_breve; ?>
        </p>
      </div>

    </a>
  </div>
</div>
<?php } else { ?>
<div class="col-md-6 col-xl-4">
  <div class="card-wrapper border border-light rounded shadow-sm cmp-list-card-img cmp-list-card-img-hr">
    <div class="card no-after rounded">
      <div class="row g-2 g-md-0 flex-md-column">
        <div class="col-12 order-1 order-md-2">
          <div class="card-body card-img-none rounded-top">
            <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
              <h3 class="card-title"><?php echo the_title(); ?></h3>
            </a>
            <p class="card-text text-secondary">
              <?php echo $description; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
