<?php
global $post;

$prefix = '_dci_luogo_';
$img = dci_get_meta('immagine', $prefix, $post->ID);
$descrizione = dci_get_meta('descrizione_breve', $prefix, $post->ID);
$indirizzo = dci_get_meta("indirizzo", '_dci_luogo_', $luogo->ID);
?>

<div class="col-lg-6 col-xl-4">
    <div class="card-wrapper">
        <a class="card card-luogo no-glow no-after" href="<?php echo get_permalink($post->ID); ?>">
            <div class="img-responsive-wrapper">
                <div class="img-responsive img-responsive-panoramic rounded">
                    <figure class="img-wrapper">
                        <?php dci_get_img($img, 'rounded-top img-fluid'); ?>
                    </figure>
                </div>
            </div>
            <div class="card-body">
                <h3 class="h5 card-title"><?php echo $post->post_title ?></h3>
                <p class="card-text">
                    <?php echo $indirizzo; ?><br>
                    <?php echo dci_get_quartieri($post->ID); ?>
                </p>
            </div>
        </a>
    </div>
</div>
