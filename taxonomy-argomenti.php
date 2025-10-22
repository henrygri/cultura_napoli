<?php
/**
 * Archivio Tassonomia Argomento
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#custom-taxonomies
 * @link https://italia.github.io/design-comuni-pagine-statiche/sito/argomento.html
 *
 * @package Design_Comuni_Italia
 */

global $argomento, $with_border, $uo_id, $custom_class;

$argomento = get_queried_object();
$img = dci_get_term_meta('immagine', "dci_term_", $argomento->term_id);
$aree_appartenenza = dci_get_term_meta('area_appartenenza', "dci_term_", $argomento->term_id);
$assessorati_riferimento = dci_get_term_meta('assessorato_riferimento', "dci_term_", $argomento->term_id);

get_header();
?>
<main>
    <div class="container" id="main-container">
        <div class="row justify-content-center">
            <div class="col-12">
                <?php get_template_part("template-parts/common/breadcrumb"); ?>
            </div>
        </div>
    </div>
    <div class="container pb-5 hero">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <h1 class="text-black hero-title">
                    <?php echo $argomento->name; ?>
                </h1>
                <h2 class="visually-hidden" id="news-details">Dettagli dell'argomento</h2>
                <div class="hero-text">
                  <p><?php echo $argomento->description; ?></p>
                </div>
            </div>
            <div class="col-12 col-lg-5 offset-lg-1 text-end">
              <?php if ($img) { ?>
                <div class="icona-argomento">
                  <figure class="rounded-circle">
                      <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="img-fluid">
                  </figure>
                </div>
              <?php } ?>
            </div>
        </div>
    </div>

    <?php get_template_part("template-parts/argomento/itinerari-detail"); ?>
    <?php get_template_part("template-parts/argomento/eventi-detail"); ?>
    <?php // get_template_part("template-parts/argomento/novita-detail"); ?>
    <?php // get_template_part("template-parts/argomento/amministrazione-detail"); ?>
    <?php // get_template_part("template-parts/argomento/servizi-detail"); ?>
    <?php // get_template_part("template-parts/argomento/documenti-detail"); ?>
</main>
<?php
get_footer();
