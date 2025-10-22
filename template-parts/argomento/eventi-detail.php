<?php
    global $argomento;

    $posts = dci_get_grouped_posts_by_term( 'eventi' , 'argomenti', $argomento->slug, 3 );
?>

<section id="novita">
    <div class="pt-4 pt-md-5 pb-50">
        <div class="container">
            <div class="row row-title">
                <div class="col-12">
                    <h3 class="title-large-semi-bold mb-0">
                        Eventi
                    </h3>
                </div>
            </div>
            <div class="row pt-4 mt-lg-2 pb-lg-4">
              <?php
                foreach ($posts as $post) {
                  get_template_part('template-parts/evento/card');
                }
              ?>
            </div>
            <div class="row mt-lg-2">
                <div class="col-12 col-lg-3 offset-lg-9">
                <button
                    type="button"
                    class="btn btn-primary text-button w-100"
                    onclick="location.href='<?php echo dci_get_template_page_url('page-templates/eventi.php'); ?>'"
                >
                    Tutti gli eventi
                </button>
                </div>
            </div>
        </div>
    </div>
</section>
