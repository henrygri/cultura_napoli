<?php
global $luogo_id, $with_border;
$luogo = get_post( $luogo_id );

$prefix = '_dci_luogo_';
$img = dci_get_meta('immagine', $prefix, $luogo->ID);
$indirizzo = dci_get_meta("indirizzo", $prefix, $luogo->ID);

if($with_border) {
?>
<div class="card card-teaser border rounded shadow p-3 flex-nowrap">
    <div class="card-body">
        <h3 class="h5 mb-1">
            <a class="text-decoration-none" href="<?php echo get_permalink($luogo->ID); ?>">
            <?php echo $luogo->post_title; ?>
            </a>
        </h3>
        <div class="card-text">
            <?php
                echo '<p>'.$indirizzo.'</p>';
            ?>
        </div>
    </div>
    <?php if ($img) { ?>
    <div class="avatar size-xl">
        <?php dci_get_img($img); ?>
    </div>
    <?php } ?>
</div>
<?php } else { ?>
<a class="card card-luogo card-luogo-small card-teaser p-0 rounded flex-nowrap" href="<?php echo get_permalink($luogo->ID); ?>" data-element="service-area">
    <?php if ($img) { ?>
      <div class="img-responsive-wrapper">
          <div class="img-responsive img-responsive-panoramic rounded">
              <figure class="img-wrapper">
                  <?php dci_get_img($img, 'rounded-top img-fluid'); ?>
              </figure>
          </div>
      </div>
    <?php } ?>
    <div class="card-body p-3">
      <h3 class="h5 card-title"><?php echo $luogo->post_title ?></h3>
      <p class="card-text"><?php echo $indirizzo; ?></p>
    </div>
</a>
<?php }
$with_border = false;
?>
