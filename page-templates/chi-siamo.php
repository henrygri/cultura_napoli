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
			$array_of_pages = get_posts([
					'title' => 'Gli spazi della cultura',
					'post_type' => 'any',
			]);
			$id = $array_of_pages[0];//Be sure you have an array with single post or page
			$id = $id->ID;
			$link = get_permalink($id);
			?>
			<section class="py-5 bg-200">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-8">
							<h2>Gli spazi della cultura</h2>
						</div>
						<div class="d-none d-md-block col-md-4 text-end">
							<a class="btn btn-xs btn-outline-dark btn-round" href="<?php echo esc_url(  $link  ); ?>">
								Esplora tutti i luoghi
								<svg class="icon ms-2">
									<use xlink:href="#it-arrow-right" aria-hidden="true"></use>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</section>

			<section class="py-5">
				<div class="container">
					<div class="row py-5">
						<div class="col-12 col-lg-8">
							<h2>Aree Tematiche</h2>
						</div>
					</div>
					<!-- questo da ripetere -->
					<div class="row area-tematica py-5">
						<div class="col-12 col-lg-6">
							<div class="card-body pb-4 pb-lg-0 pe-lg-5">
								<h3>Musica</h3>
								<p>
									La musica è l’anima di Napoli e uno dei suoi linguaggi universali.<br>
									Attraverso l’Ufficio Musica, che svolge un ruolo di regia istituzionale nel progetto “Napoli Città della Musica”, il Comune valorizza i giovani talenti, investe sul rilancio culturale, sociale ed economico delle sue eccellenze, sostiene operatori e professionisti del settore, promuove collaborazioni che rafforzano il ruolo di Napoli come capitale della musica nel mondo.
								</p>
								<a class="btn btn-dark">Guarda gli eventi correlati</a>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="img-responsive-wrapper">
								<div class="img-responsive img-responsive-panoramic rounded-3">
									<figure class="img-wrapper">
										<?php dci_get_img($img); ?>
									</figure>
								</div>
							</div>
						</div>
					</div>
					<!-- fino a qui -->

					<div class="row area-tematica py-5">
						<div class="col-12 col-lg-6">
							<div class="card-body pb-4 pb-lg-0 pe-lg-5">
								<h3>Libri e Lettura</h3>
								<p>
									La letteratura è l’anima di Napoli e uno dei suoi linguaggi universali.<br>
									Attraverso l’Ufficio letteratura, che svolge un ruolo di regia istituzionale nel progetto “Napoli Città della letteratura, il Comune valorizza i giovani talenti, investe sul rilancio culturale, sociale ed economico delle sue eccellenze, promuove collaborazioni che rafforzano il ruolo di Napoli come capitale della letteratura nel mondo.
								</p>
								<a class="btn btn-dark">Guarda gli eventi correlati</a>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="img-responsive-wrapper">
								<div class="img-responsive img-responsive-panoramic rounded-3">
									<figure class="img-wrapper">
										<?php dci_get_img($img); ?>
									</figure>
								</div>
							</div>
						</div>
					</div>

				</div>
			</section>
			<?php get_template_part("template-parts/common/bolli-argomenti"); ?>

			<section class="py-5 bg-100">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h2>Bandi e Gare</h2>
						</div>
					</div>
					<div class="row py-4">
						<div class="col-md-6"><!-- togliamo colonne quando facciamo carousel -->
							<a class="card card-bando no-after rounded-3" target="_blank" href="">
								<div class="card-body">
									<h3 class="card-title">Manifestazione d’interesse finalizzata a reperire adesioni per la tutela e valorizzazione della Scuola Musicale Napoletana del ‘700</h3>
								</div>
								<div class="card-footer">
									<span>Pubblicazione:</span> 10/01/2026<br>
									<span>Scadenza:</span> 10/01/2026
								</div>
							</a>
						</div><!-- togliamo colonne quando facciamo carousel -->
						<div class="col-md-6"><!-- togliamo colonne quando facciamo carousel -->
							<a class="card card-bando no-after rounded-3" target="_blank" href="">
								<div class="card-body">
									<h3 class="card-title">Avviso Pubblico per manifestazione d’interesse per la costituzione di un calendario condiviso di iniziative culturali auto-sostenute e auto-organizzate da includere nella programmazione del “Maggio dei Monumenti” 2026</h3>
								</div>
								<div class="card-footer">
									<span>Pubblicazione:</span> 10/01/2026<br>
									<span>Scadenza:</span> 10/01/2026
								</div>
							</a>
						</div><!-- togliamo colonne quando facciamo carousel -->
					</div>
				</div>
			</section>


		<?php endwhile; ?>
	</main>
<?php
get_footer();
