<?php
global $post;

$img = dci_get_meta('immagine');
// $argomenti = dci_get_meta("argomenti", '_dci_itinerario_', $post->ID);
$argomenti = get_the_terms($post, 'argomenti');

if ($img) {
?>
<div class="col-md-6">
  <div class="card-wrapper">
    <div class="card card-itinerario no-after rounded-3">

      <div class="img-responsive-wrapper">
        <div class="img-responsive img-responsive-panoramic rounded-3">
          <figure class="img-wrapper">
            <?php dci_get_img($img, ''); ?>
          </figure>
        </div>
      </div>

      <div class="card-body">
        <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
          <h3 class="card-title"><?php echo the_title(); ?></h3>
        </a>

        <?php if (is_array($argomenti) && count($argomenti) ) { ?>
        <div class="">
            <ul class="d-flex flex-wrap gap-1">
                <?php foreach ($argomenti as $argomento) { ?>
                <li>
                    <a class="chip chip-simple" data-element="service-topic">
                        <span class="chip-label"><?php echo $argomento->name; ?></span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>

        <?php /*
        <p class="card-text text-secondary">
          <?php echo $description; ?>
        </p>
        */ ?>
      </div>

    </div>
  </div>
</div>
<?php } else { ?>
<div class="col-md-6">
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
