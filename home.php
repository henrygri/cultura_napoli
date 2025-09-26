<?php
/**
 * The template for displaying home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

get_header();
?>
    <main id="main-container" class="main-container redbrown">
        <h1 class="visually-hidden">
            <?php echo dci_get_option("nome_comune"); ?>
        </h1>

        <section class="it-hero-wrapper it-wrapped-container custom-overlapping" aria-describedby="contenuti_evidenza">
          <div class="container">
            <h2 id="contenuti_evidenza" class="visually-hidden">Contenuti in evidenza</h2>
            <div class="row">
                <?php get_template_part("template-parts/home/slideshow"); ?>

                <!--
                  <li class="splide__slide it-hero-card it-hero-bottom-overlapping rounded drop-shadow ">
                    <figure class="figure px-0 img-full w-100">
                        <img src="https://dev.studiolabo.it/cultura-napoli/wp-content/uploads/2025/09/banner_aggiornato_Jori.png" class="figure-img img-fluid rounded" alt="" />
                    </figure>
                  </li>
                -->
            </div>
          </div>
        </section>

        <section>
          <div class="container py-5 border-top border-bottom">
            <p class="h2">
              Il calendario ufficiale della cultura a Napoli <br>
              Scopri cosa succede ogni giorno in città.
            </p>
          </div>
        </section>

        <?php get_template_part("template-parts/evento/prossimi-eventi"); ?>

        <?php get_template_part("template-parts/common/bolli-argomenti"); ?>

        <section class="py-5 bg-100">
          <div class="container">
            <div class="row py-3">
              <div class="col-12">
                <h2>I Luoghi della cultura</h2>
              </div>
              <div class="col-lg-6 pt-3">
                mappa
              </div>
              <div class="col-lg-6 pt-3">
                Nome municipalità, quartieri, 6 location selezionate per ogni municipalità
              </div>
            </div>
          </div>
        </section>

        <section id="head-section">
            <h2 class="visually-hidden">Contenuti in evidenza</h2>
            <?php
			$messages = dci_get_option( "messages", "home_messages" );
            if($messages && !empty($messages)) {
                get_template_part("template-parts/home/messages");
            }
		    ?>
            <?php get_template_part("template-parts/home/notizie"); ?>
            <?php get_template_part("template-parts/home/calendario"); ?>
        </section>

        <?php get_template_part("template-parts/common/bolli-argomenti"); ?>


        <section id="evidenza" class="evidence-section">
            <div class="section py-5 pb-lg-80 px-lg-5 position-relative" style="<?php if (file_exists(get_stylesheet_directory().'/assets/img/evidenza-header.png')){ ?>background-image: url('<?php echo esc_url( get_stylesheet_directory_uri()); ?>/assets/img/evidenza-header.png');<?php }else{ ?>background-image: url('<?php echo esc_url( get_template_directory_uri()); ?>/assets/img/evidenza-header.png');<?php } ?>">
                <?php get_template_part("template-parts/home/argomenti"); ?>
                <?php get_template_part("template-parts/home/siti","tematici"); ?>
            </div>
        </section>
        <?php get_template_part("template-parts/home/ricerca"); ?>
    </main>
<?php
get_footer();