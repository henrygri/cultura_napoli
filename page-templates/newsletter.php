<?php
/* Template Name: Newsletter
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
			?>
			<?php get_template_part( 'template-parts/hero/hero' ); ?>
			<section class="pb-5">
				<div class="container">
					<div class="row g-5">
						<div class="col-12 col-lg-8">
							<article class="richtext-wrapper">
								<?php the_content(); ?>


								<div class="p-5 border rounded-3 mt-4 mb-5">
									<script async type='text/javascript' src='https://app.emailchef.com/mcwebscript/7o226163636s756r745s6964223n22383231363636227q'></script>

									<form method="POST" action="https://app.emailchef.com/signupwl/7o22666s726q5s6964223n2237343532227q/it" id="form1">
										<div class="mb-3">
											<h4 class="mc-header">Iscriviti alla newsletter</h4>
										</div>
										<div class="mb-3">
											<label style=""  class="mc-label">Nome</label>
											<input value="" style="" class="mc-inputfield" id="field-2" name="field[-2]" type="text">
										</div>
										<div class="mb-3">
											<label style=""  class="mc-label">Cognome</label>
											<input value="" style="" class="mc-inputfield" id="field-3" name="field[-3]" type="text">
										</div>
										<div class="mb-3">
											<label style=""  class="mc-label">E-mail<span class="mc-asterisk">*</span></label>
											<input value="" style="" class="mc-inputfield" id="field-1" name="field[-1]" type="email">
										</div>
										<div class="mb-3">
											<p class="mc-privacy form-check">
												<input value="1" class="mc-inputfield" name="field[-4]" type="checkbox" required > Dichiaro di aver letto e compreso la <a href="#" target="_blank">Privacy Policy.</a><span class="mc-asterisk">*</span>
											</p>
										</div>
										<div class="mb-3">
											<input type="submit" class="btn btn-primary mc-signup-button" id="mc-signup-form-button-submit" name="mc-signup-form-button-submit" value="Iscriviti" style="">
										</div>
										<input type="hidden" name="form_id" value="7452" />
										<input type="hidden" name="lang" value="" />
										<input type="hidden" name="referrer" id="ec_referrer" value="" />
										<div id="ec_recaptcha"></div>
									</form>
									<script src="https://app.emailchef.com/signup/form.js/7o22666s726q5s6964223n2237343532227q/it/api"></script>
									<script src="https://www.google.com/recaptcha/api.js?onload=renderRecaptcha&render=explicit"></script>
									<style>
									#form1 .label { width: 100%; }
									#form1 input[type="text"],
									#form1 input[type="email"] { width: 100%; }
									</style>

								</div>

							</article>
						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	</main>
<?php
get_footer();
