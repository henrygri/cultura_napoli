<?php
    global $title, $description, $with_shadow, $with_description, $with_bg, $data_element;

    if (!$title) $title = get_the_title();
    if (!$description) $description = dci_get_meta('descrizione','_dci_page_',$post->ID ?? null);
?>

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12">
            <?php get_template_part("template-parts/common/breadcrumb"); ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center <?php echo $with_shadow? 'row-shadow' : ''; ?>">
        <div class="col-12">
            <div class="cmp-hero">
                <section class="it-hero-wrapper align-items-start  <?php echo $with_shadow? 'bg-white' : 'bg-transparent'; ?>">
                    <div class="it-hero-text-wrapper pt-0 ps-0 <?php echo $with_description? 'pb-4 pb-lg-60' : 'pb-0'; ?>">
                        <h1 class="text-black hero-title <?php echo $with_description? '' : 'mb-0'; ?>" <?php echo $data_element ? $data_element : null ?>>
                            <?php echo $title; ?>
                        </h1>
                        <?php if ($with_description) { ?>
                        <div class="hero-text">
                            <p><?php echo $description; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
