<?php
    global $title, $description, $with_shadow, $data_element;

    if (!$title) $title = get_the_archive_title();
    if (!$description) $description = get_the_archive_description();
?>

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12">
            <?php get_template_part("template-parts/common/breadcrumb"); ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center <?php echo $with_shadow? 'row-shadow' : ''?>">
        <div class="col-12">
            <div class="cmp-hero">
                <section class="it-hero-wrapper bg-white align-items-start">
                    <div class="it-hero-text-wrapper pt-0 ps-0 pb-0">
                        <h1 class="text-black hero-title" <?php echo $data_element ? $data_element : null ?>>
                            <?php echo $title; ?>
                        </h1>
                        <?php
                        $hero_subtitle = '';
                        $hero_text = '';

                        if ( $post_type === 'focus' ) {
                            $hero_subtitle = cmb2_get_option( 'focus', 'focus_sottotitolo' );
                            $hero_text     = cmb2_get_option( 'focus', 'focus_testo' );

                        } elseif ( $post_type === 'itinerario' ) {
                            $hero_subtitle = cmb2_get_option( 'itinerari', 'itinerari_sottotitolo' );
                            $hero_text     = cmb2_get_option( 'itinerari', 'itinerari_testo' );

                        } elseif ( $post_type === 'progetto' ) {
                            $hero_subtitle = cmb2_get_option( 'progetti', 'progetti_sottotitolo' );
                            $hero_text     = cmb2_get_option( 'progetti', 'progetti_testo' );
                        }

                        if ( $hero_subtitle || $hero_text ) {
                            echo '<div class="hero-text">';
                            if ( $hero_subtitle ) {
                                $subtitle = str_replace(array('<p>', '</p>'), '', $hero_subtitle );
                                echo '<h3 class="h4 text-black"><em>' . wp_kses_post( $subtitle ) . '</em></h3>';
                            }
                            if ( $hero_text ) {
                                echo '<p>' . wp_kses_post( $hero_text ) . '</p>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
