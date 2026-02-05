<?php
/* Template Name: Chi siamo
 *
 * Area Stampa template file
 *
 * @package Design_Comuni_Italia
 */
global $post, $with_shadow;

get_header();
?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			$with_shadow = false;
			$documents = dci_get_meta( 'area_stampa_docs', '_dci_page_', $post->ID );
			$documents = is_array( $documents ) ? $documents : array();
			?>
			<div class="bg-100 pb-5">
				<?php get_template_part( 'template-parts/hero/hero' ); ?>
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-8 offset-lg-4">
							<article class="richtext-wrapper">
								<?php the_content(); ?>
							</article>
						</div>
					</div>
				</div>
			</div>

			<?php
			$luoghi = dci_get_meta( 'luoghi', '_dci_page_', $post->ID );
			if ( is_array( $luoghi ) && ! empty( $luoghi ) ) {
				$array_of_pages = get_posts(
					array(
						'title'     => 'Gli spazi della cultura',
						'post_type' => 'any',
					)
				);
				$id   = $array_of_pages[0]; //Be sure you have an array with single post or page
				$id   = $id->ID;
				$link = get_permalink( $id );
			?>
			<section class="py-5 bg-200" id="chi-siamo-luoghi">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-8">
							<h2>Gli spazi della cultura</h2>
						</div>
						<div class="d-none d-md-block col-md-4 text-end">
							<a class="btn btn-xs btn-outline-dark btn-round" href="<?php echo esc_url( $link ); ?>">
								Esplora tutti i luoghi
								<svg class="icon ms-2">
									<use xlink:href="#it-arrow-right" aria-hidden="true"></use>
								</svg>
							</a>
						</div>
					</div>
					<div class="row pt-3">
						<div class="splide slider_luoghi" data-splide='{
							"type":"slide",
							"perPage":3,
							"perMove":1,
							"gap":"24px",
							"arrows":true,
							"pagination":true,
							"mediaQuery":"max",
							"breakpoints":{
								"992":{"perPage":2.5}
							},
							"breakpoints":{
								"768":{"perPage":2}
							},
							"breakpoints":{
								"676":{"perPage":1.5}
							}
						}'>
							<div class="splide__track">
								<ul class="splide__list">
										<?php
											foreach ( $luoghi as $luogo ) :
												$post = get_post( $luogo ); // il tuo ID
												setup_postdata( $post );
												echo '<li class="splide__slide">';
										 		get_template_part( 'template-parts/itinerario/cards-list' );
												echo '</li>';
												wp_reset_postdata();
											endforeach;
										 ?>
								</ul>
						 	</div>
						</div>
					</div>
				</div>
			</section>
			<?php } ?>

			<section class="py-5">
				<div class="container">
					<div class="row py-5">
						<div class="col-12 col-lg-8">
							<h2>Aree Tematiche</h2>
						</div>
					</div>
					<?php
					$aree_tematiche = dci_get_meta( 'aree_tematiche', '_dci_page_', $post->ID );
					if ( is_array( $aree_tematiche ) && ! empty( $aree_tematiche ) ) :
						foreach ( $aree_tematiche as $area ) :
							$titolo   = isset( $area['titolo'] ) ? $area['titolo'] : '';
							$testo    = isset( $area['testo'] ) ? $area['testo'] : '';
							$immagine = isset( $area['immagine'] ) ? $area['immagine'] : '';

							$argomento_raw = isset( $area['argomento'] ) ? $area['argomento'] : '';
							if ( is_array( $argomento_raw ) ) {
								$first_val = reset( $argomento_raw );
								$argomento = absint( $first_val );
							} else {
								$argomento = absint( $argomento_raw );
							}

							$term_obj = $argomento ? get_term( $argomento, 'argomenti' ) : null;
							// Fallback: support slug saved as value.
							if ( ! $argomento && is_string( $argomento_raw ) && '' !== $argomento_raw ) {
								$maybe_term = get_term_by( 'slug', $argomento_raw, 'argomenti' );
								if ( $maybe_term && ! is_wp_error( $maybe_term ) ) {
									$term_obj  = $maybe_term;
									$argomento = $maybe_term->term_id;
								}
							}

							$term_link = ( $argomento && $term_obj && ! is_wp_error( $term_obj ) ) ? get_term_link( $term_obj ) : '';
							$show_btn  = $argomento && $term_obj && ! is_wp_error( $term_obj );
							$btn_href  = ( $term_link && ! is_wp_error( $term_link ) ) ? $term_link : '#';

							$img_url = '';
							if ( is_array( $immagine ) && isset( $immagine['url'] ) ) {
								$img_url = $immagine['url'];
							} elseif ( is_string( $immagine ) ) {
								$img_url = $immagine;
							}
							?>
							<div class="row area-tematica py-5">
								<div class="col-12 col-lg-6">
									<div class="card-body pb-4 pb-lg-0 pe-lg-5 d-flex flex-column h-100">
										<?php
										$term_img = ( $show_btn ) ? dci_get_term_meta( 'immagine', 'dci_term_', $term_obj->term_id ) : '';
										if ( $term_img ) :
											?>
											<div class="d-flex align-items-center justify-content-between gap-3 mb-4">
												<?php if ( $titolo ) : ?>
													<h3 class="mb-0 h2"><?php echo esc_html( $titolo ); ?></h3>
												<?php endif; ?>
												<div class="mb-0 icona-argomento clash-display-medium ms-3">
													<figure class="rounded-circle mb-0">
														<img src="<?php echo esc_url( $term_img ); ?>" alt="<?php echo esc_attr( $term_obj->name ); ?>" class="img-fluid">
													</figure>
												</div>
											</div>
										<?php elseif ( $titolo ) : ?>
											<h3 class="h2"><?php echo esc_html( $titolo ); ?></h3>
										<?php endif; ?>

										<?php if ( $testo ) : ?>
											<p class="mb-4"><?php echo wp_kses_post( nl2br( $testo ) ); ?></p>
										<?php endif; ?>

										<?php if ( $show_btn ) : ?>
											<div class="mt-auto">
												<a class="btn btn-primary w-100" href="<?php echo esc_url( $btn_href ); ?>">
													<?php esc_html_e( 'Scopri gli appuntamenti', 'design_comuni_italia' ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-12 col-lg-6">
									<?php if ( $img_url ) : ?>
										<figure  class="rounded-3">
											<img src="<?php echo $img_url; ?>" alt="<?php echo esc_attr( $titolo ); ?>" class="w-100 rounded-3"/>
										</figure>
									<?php endif; ?>
								</div>
							</div>
						<?php
						endforeach;
					endif;
					?>
				</div>
			</section>
			<?php get_template_part( 'template-parts/common/bolli-argomenti' ); ?>

			<section class="py-5 bg-100" id="bandi-e-gare">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-sm-8">
							<h2 class="mb-0">Bandi e Gare</h2>
						</div>
						<div class="col-sm-4 text-lg-end mt-3 mt-lg-0">
							<div class="slider_bandi_arrows_placeholder"></div>
						</div>
					</div>
					<div class="row py-4">
						<?php
						$bandi = dci_get_meta( 'bandi', '_dci_page_', $post->ID );
						if ( is_array( $bandi ) && ! empty( $bandi ) ) :
							?>
							<div class="splide slider_bandi" data-splide='{
								"type":"slide",
								"perPage":2,
								"perMove":1,
								"gap":"24px",
								"arrows":true,
								"pagination":true,
								"mediaQuery":"max",
								"breakpoints":{
									"992":{"perPage":1}
								}
							}'>
								<div class="splide__arrows">
									<button class="splide__arrow splide__arrow--prev" type="button" aria-label="<?php esc_attr_e( 'Slide precedente', 'design_comuni_italia' ); ?>">
										<svg class="icon" aria-hidden="true"><use xlink:href="#it-arrow-left"></use></svg>
									</button>
									<button class="splide__arrow splide__arrow--next" type="button" aria-label="<?php esc_attr_e( 'Slide successiva', 'design_comuni_italia' ); ?>">
										<svg class="icon" aria-hidden="true"><use xlink:href="#it-arrow-right"></use></svg>
									</button>
								</div>
								<div class="splide__track">
									<ul class="splide__list">
										<?php foreach ( $bandi as $bando ) :
											$titolo  = isset( $bando['titolo'] ) ? $bando['titolo'] : '';
											$pubb    = isset( $bando['data_pubblicazione'] ) ? $bando['data_pubblicazione'] : '';
											$chius   = isset( $bando['data_chiusura'] ) ? $bando['data_chiusura'] : '';
											$link    = isset( $bando['link'] ) ? $bando['link'] : '';
											?>
											<li class="splide__slide">
												<a class="card card-bando no-after rounded-3 h-100" <?php echo $link ? 'target="_blank"' : ''; ?> href="<?php echo esc_url( $link ? $link : '#' ); ?>">
													<div class="card-body">
														<h3 class="card-title"><?php echo esc_html( $titolo ); ?></h3>
													</div>
													<div class="card-footer d-flex align-items-center justify-content-between">
														<div>
															<?php if ( $pubb ) : ?>
																<span><?php esc_html_e( 'Pubblicazione:', 'design_comuni_italia' ); ?></span>
																<?php echo date( 'd/m/Y', $pubb ); ?><br>
															<?php endif; ?>
															<?php if ( $chius ) : ?>
																<span><?php esc_html_e( 'Scadenza:', 'design_comuni_italia' ); ?></span>
																<?php echo date( 'd/m/Y', $chius  ); ?>
															<?php endif; ?>
														</div>
														<span class="bando-icon ms-3">
															<svg class="icon" aria-hidden="true">
																<use xlink:href="#it-arrow-right"></use>
															</svg>
														</span>
													</div>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						<?php else : ?>
							<div class="col-12">
								<p class="text-muted mb-0"><?php esc_html_e( 'Non ci sono bandi pubblicati.', 'design_comuni_italia' ); ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>


		<?php endwhile; ?>
	</main>
<?php
get_footer();
