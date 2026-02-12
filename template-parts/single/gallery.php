<?php
global $gallery;
?>
<div class="it-carousel-wrapper it-carousel-same-height splide"  data-bs-carousel-splide>
	<div class="it-header-block visually-hidden">
		<div class="it-header-block-title">
			<h3 class="h4">Galleria di immagini</h4>
		</div>
	</div>
	<div class="splide__track">
		<ul class="splide__list it-carousel-all">
		<?php
			foreach ($gallery as $ida=>$urlg){
				$attach = get_post($ida);
				$imageatt =  wp_get_attachment_image_src($ida, "item-gallery");
				$alt = get_post_meta($attach->ID, '_wp_attachment_image_alt', true);
				$alt = !empty($alt) ? $alt : $attach->post_title;
				?>
				<li class="splide__slide">
					<div class="it-single-slide-wrapper">
						<figure>
						<img src="<?php echo $urlg; ?>" alt="<?php echo esc_attr($alt); ?>">
						<figcaption class="figure-caption mt-2"><?php echo $attach->post_excerpt; ?></figcaption>
						</figure>
					</div>
				</li>
		<?php } ?>
		</ul>
	</div>
</div>
