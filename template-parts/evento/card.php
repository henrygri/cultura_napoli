<?php
global $post;

$img = dci_get_meta('immagine', '_dci_evento_',$post->ID);
$descrizione = dci_get_meta('descrizione_breve', '_dci_evento_',$post->ID);
$timestamp = dci_get_meta('data_orario_inizio', '_dci_evento_',$post->ID);
$arrdata = explode('-', date_i18n("j-F-Y", $timestamp));
$luogo_evento_id = dci_get_meta("luogo_evento", '_dci_evento_', $post->ID);
$luogo_evento = '';
if ( ! empty( $luogo_evento_id ) ) {
    $luogo_evento = get_the_title( $luogo_evento_id );
}
?>
<div class="col-12 col-sm-6 col-lg-4 mb-3">
	<article class="card-wrapper card-space">
	<a class="card card-img card-evento" href="<?php echo get_permalink($post->ID); ?>">
		<div class="img-responsive-wrapper">
			<div class="img-responsive img-responsive-panoramic rounded-3">
				<figure class="img-wrapper">
					<?php dci_get_img($img); ?>
				</figure>
				<?php /*
				<div class="card-calendar d-flex flex-column justify-content-center">
					<span class="card-date"><?php echo $arrdata[0]; ?></span>
					<span class="card-day"><?php echo $arrdata[1]; ?></span>
				</div>
				*/ ?>
			</div>
		</div>
		<div class="card-body">
			<h5 class="card-title"><?php echo $post->post_title ?></h5>
			<p class="card-text">
				<?php // echo $descrizione; ?>
				<?php echo $arrdata[0]; ?> <?php echo $arrdata[1]; ?><br><?php echo $luogo_evento; ?>
			</p>
		</div>
	</a>
	</article>
</div>
