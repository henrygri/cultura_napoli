<?php
    global $argomento;

    $posts = dci_get_grouped_posts_by_term( 'itinerari' , 'argomenti', $argomento->slug, 3 );
    if (!empty($posts)) :
?>

<section id="itinerari">
    <div class="bg-200 pt-4 pt-md-5 pb-50">
        <div class="container">
            <div class="row row-title">
                <div class="col-12">
                  <h3 class="title-large-semi-bold mb-0">
                    Itinerari
                  </h3>
                  <p>Itinerari che puoi percorrere autonomamente alla scoperta del territorio</p>
                </div>
            </div>
            <div class="row pt-4 mt-lg-2 pb-lg-4">
              <?php
                foreach ($posts as $post) {
                  echo '<div class="col-md-6 mb-4">';
                  get_template_part('template-parts/itinerario/cards-list');
                  echo '</div>';
                }
              ?>
            </div>
            <div class="row mt-lg-2">
                <div class="col-12 col-lg-3 offset-lg-9">
                <button
                    type="button"
                    class="btn btn-primary text-button w-100"
                    onclick="location.href='<?php echo dci_get_template_page_url('page-templates/itinerari.php'); ?>'"
                >
                    Tutti gli itinerari
                </button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
