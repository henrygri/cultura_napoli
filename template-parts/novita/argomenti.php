<?php
    $argomenti = get_terms('tipi_notizia', array(
        'hide_empty' => false,
    ) );
?>

<div class="container py-5 border-top border-light" id="argomento">
  <h2 class="h4 mb-4">Esplora per categoria</h2>
  <div class="row g-4">
    <?php foreach ($argomenti as $argomento) {
        ?>
    <div class="col-md-6 col-xl-4">
      <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light no-hover">
        <div class="card shadow-sm rounded">
          <div class="card-body">
            <a class="text-decoration-none" href="<?php echo get_term_link($argomento->term_id); ?>"
              data-element="news-category-link">
              <h3 class="h4 card-title t-primary title-xlarge"><?php echo ucfirst($argomento->name); ?></h3>
            </a>
            <p class="text-secondary mb-0">
              <?php echo $argomento->description; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
