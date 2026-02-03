<?php
/**
 * Itinerario template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

global $gallery, $video, $trascrizione, $inline;

get_header();
?>

<main>
  <?php
  while ( have_posts() ) :
    the_post();
    $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

    $prefix= '_dci_focus_';
    $sottotitolo = dci_get_meta("sottotitolo", $prefix, $post->ID);
    $descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
    $descrizione = dci_get_wysiwyg_field("descrizione_completa", $prefix, $post->ID);
    //cover
    $img_url = dci_get_meta('immagine', $prefix, $post->ID);
    $img_id = $img_url ? attachment_url_to_postid($img_url) : 0;
    $img = $img_id ? get_post($img_id) : null;
    $image_alt = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true) : '';
    //media
    $gallery = dci_get_meta("gallery", $prefix, $post->ID);
    $video = dci_get_meta("video", $prefix, $post->ID);
    $trascrizione = dci_get_meta("trascrizione", $prefix, $post->ID);
    ?>

    <section class="it-hero-wrapper it-wrapped-container custom-overlapping">
      <div class="container">
        <div class="row mx-0">
          <div class="col-12 px-0">
            <div class="it-hero-card it-hero-bottom-overlapping rounded-3 drop-shadow mt-0">
              <figure class="figure px-0 img-full w-100">
                  <img src="<?php echo $img_url; ?>" class="figure-img img-fluid rounded-3" alt="<?php echo $image_alt; ?>" />
                  <?php if ($img->post_excerpt)  {?>
                  <figcaption class="figure-caption text-center pt-3">
                      <?php echo $img->post_excerpt; ?>
                  </figcaption>
                  <?php } ?>
              </figure>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="container px-4" id="main-container">
      <div class="row">
        <div class="col px-lg-4">
            <?php get_template_part("template-parts/common/breadcrumb"); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 px-lg-4 py-lg-2">
          <h1 class="h2" data-audio><?php the_title(); ?></h1>
          <?php if ($sottotitolo) { ?>
          <h2 class="h4 py-2" data-audio><?php echo $sottotitolo; ?></h2>
          <?php } ?>
          <p data-audio>
            <?php echo $descrizione_breve; ?>
          </p>
          <?php
              $inline = true;
              get_template_part('template-parts/single/actions-inverse');
          ?>
        </div>
        <div class="col-lg-3 offset-lg-1">
          <?php
              // $inline = true;
              // get_template_part('template-parts/single/actions');
          ?>
        </div>
      </div>
    </div>

    <?php // get_template_part('template-parts/single/image-large'); ?>

    <div class="container">
      <div class="row border-top row-column-border row-column-menu-left border-light">
        <aside class="col-lg-4">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Indice della pagina" data-bs-navscroll>
                    <div class="navbar-custom" id="navbarNavProgress">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                        <button
                                            class="accordion-button pb-10 px-3 text-uppercase"
                                            type="button"
                                            aria-controls="collapse-one"
                                            aria-expanded="true"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-one"
                                        >Indice della pagina
                                            <svg class="icon icon-sm icon-primary align-top">
                                                <use xlink:href="#it-expand"></use>
                                            </svg>
                                        </button>
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                            <div class="accordion-body">
                                                <ul class="link-list" data-element="page-index">
                                                <?php if ($descrizione) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#cos-e">
                                                    <span>Cos'è</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if( $destinatari) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#destinatari">
                                                    <span>A chi è rivolto</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

        <section class="col-lg-8 it-page-sections-container border-light">
          <article id="cos-e" class="it-page-section mb-5" data-audio>
              <?php if ($descrizione) { ?>
              <h2 class="h3 mb-2">Cos'è</h2>
              <div class="richtext-wrapper">
                  <?php echo $descrizione; ?>
              </div>
              <?php  } ?>
              <?php if(is_array($persone) && count($persone)) {?>
              <div class="pt-3 mb-4">
                <h3 class="h4">Parteciperanno</h3>
                <?php get_template_part("template-parts/single/persone"); ?>
              </div>
              <?php  } ?>
              <?php if (is_array($gallery) && count($gallery)) {
                  get_template_part("template-parts/single/gallery");
              } ?>
              <?php if ($video) {
                  get_template_part("template-parts/single/video");
              } ?>
          </article>

          <?php if($destinatari) {?>
          <article id="destinatari" class="it-page-section mb-5">
            <h2 class="h3 mb-2">A chi è rivolto</h2>
            <p><?php echo $destinatari; ?></p>
          </article>
          <?php  } ?>

          <?php // get_template_part('template-parts/single/page_bottom'); ?>
        </section>
      </div>
    </div>

    <?php
    $parent_event_id = dci_get_meta('evento_genitore', '_dci_evento_');
    if ($parent_event_id) {
        $parent_event = get_post($parent_event_id);
        if ($parent_event && $parent_event->post_type == 'evento') : ?>
        <section class="pt-4 pb-5 bg-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="h4 mt-4 mb-4">Questo evento fa parte di</h3>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $post = $parent_event;
                    setup_postdata($post);
                    get_template_part("template-parts/evento/card");
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
        <?php endif;
    } ?>

    <?php
    $progetti = dci_get_meta('progetti_evento', '_dci_evento_');
    if (is_array($progetti) && count($progetti) > 0) : ?>
    <section class="pt-4 pb-5 bg-200">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h4 mt-4 mb-4">Questo evento fa parte del progetto</h3>
                </div>
            </div>
            <div class="link-list-wrapper">
                <ul class="link-list">
                    <?php
                    foreach ($progetti as $progetto_id) {
                        $progetto = get_post($progetto_id);
                        if ($progetto && $progetto->post_type == 'progetto') {
                            ?>
                            <li>
                                <a class="list-item" href="<?php echo get_permalink($progetto); ?>">
                                    <span><?php echo $progetto->post_title; ?></span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <?php endif; ?>

  <?php
  endwhile; // End of the loop.
  ?>
</main>

<?php
get_footer();
