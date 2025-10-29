<?php
global $post;

$img = dci_get_meta('immagine', '_dci_evento_',$post->ID);
$descrizione = dci_get_meta('descrizione_breve', '_dci_evento_',$post->ID);
$start_timestamp = dci_get_meta('data_orario_inizio', '_dci_evento_',$post->ID);
$start_arrdata = explode('-', date_i18n("j-F-Y", $start_timestamp));
$end_timestamp = dci_get_meta('data_orario_fine', '_dci_evento_',$post->ID);
$end_arrdata = explode('-', date_i18n("j-F-Y", $end_timestamp));
$luogo_evento_id = dci_get_meta("luogo_evento", '_dci_evento_', $post->ID);
$luogo_evento = '';
if ( ! empty( $luogo_evento_id ) ) {
    $luogo_evento = get_the_title( $luogo_evento_id );
}
?>
<div class="col-12">
	<article class="card-wrapper card-space">
	<a class="card card-img card-evento flex-md-row" href="<?php echo get_permalink($post->ID); ?>">
    <div class="col-12 col-md-6 img-responsive-wrapper">
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
		<div class="col-12 col-md-6 card-body p-md-4">
			<h3 class="card-title"><?php echo $post->post_title ?></h3>
			<p class="card-text">
        <?php // echo $descrizione; ?>
				<?php
            if ($end_timestamp and $end_arrdata[0] != $start_arrdata[0]) {
                echo 'Dal '.$start_arrdata[0].' '.$start_arrdata[1].' al '.$end_arrdata[0].' '.$end_arrdata[1];
            } else {
                echo $start_arrdata[0].' '.$start_arrdata[1];
            }
        ?>
        <?php echo ($luogo_evento) ? '<br>'.$luogo_evento : ''; ?><br>
			</p>
      <p class="card-text">
        <?php echo $descrizione; ?>
      </p>
		</div>
	</a>
	</article>
</div>
