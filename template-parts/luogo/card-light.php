<?php
global $luogo_id, $with_border;
$luogo = get_post( $luogo_id );

$prefix = '_dci_luogo_';
$img = dci_get_meta('immagine', $prefix, $luogo->ID);
$indirizzo = dci_get_meta("indirizzo", $prefix, $luogo->ID);  

if($with_border) {
?>
<div class="card card-teaser mb-3 border rounded flex-nowrap" href="<?php echo get_permalink($luogo->ID); ?>">
    <div class="card-body">
        <h4 class="u-main-black mb-1"><?php echo $luogo->post_title; ?></h4>
        <p class="card-text">
          <?php echo $indirizzo; ?><br>
          <?php echo dci_get_quartieri($luogo->ID); ?>
        </p>
    </div>
    <?php if ($img) { ?>
    <div class="avatar size-xl">
        <?php dci_get_img($img); ?>
    </div>
    <?php } ?>
</div>
<?php } else { ?>
<a class="card card-teaser mb-3 card-teaser-info rounded flex-nowrap" href="<?php echo get_permalink($luogo->ID); ?>" data-element="service-area">
    <div class="card-body">
        <p class="card-title h5 mb-1">
          <?php echo $luogo->post_title; ?>
        </p>
        <p class="card-text">
          <?php echo $indirizzo; ?><br>
          <?php echo dci_get_quartieri($luogo->ID); ?>
        </p>
    </div>
    <?php if ($img) { ?>
        <div class="avatar size-xl">
            <?php dci_get_img($img); ?>
        </div>
    <?php } ?>
</a>
<?php }
$with_border = false;
?>
