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
                        <div class="hero-text">
                          <h3 class="h4 text-black"><em><?php echo str_replace(array('<p>', '</p>'), '', $description); ?></em></h3>
                          <p>
                            <?php
                            if ($post_type === 'focus') {
                                echo 'Focus è uno spazio multimediale pensato per portarti nel cuore dei contenuti: video di approfondimento, cortometraggi, report, podcast e gallerie fotografiche. Un unico luogo, tante possibilità di ingresso, per esplorare la cultura da prospettive diverse, in modo dinamico e coinvolgente.';

                            } elseif ($post_type === 'itinerario') {
                                echo 'Quest’area propone itinerari culturali alla scoperta del territorio attraverso musica, cinema, letteratura e altre forme artistiche. Dai luoghi iconici alle ambientazioni di film, serie o opere letterarie, ogni percorso offre un’esperienza immersiva e nuovi punti di vista sulla città.';

                            } elseif ($post_type === 'progetto') {
                                echo 'Questa sezione racconta le idee ed i progetti che sono alla base della programmazione culturale, pensati per valorizzare nel tempo il patrimonio culturale materiale e immateriale del territorio. Ogni iniziativa, anche la più piccola, è un seme che cresce e dà vita a percorsi duraturi, che alimentano una visione culturale di ampio respiro.';
                            }
                            ?>
                          </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
