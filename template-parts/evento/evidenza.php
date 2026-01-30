<?php
    global $post, $posts;
	// Per selezionare i contenuti in evidenza tramite flag

	//Per selezionare i contenuti in evidenza tramite configurazione
	$eventi = dci_get_option('eventi_evidenziati','eventi');

  // $url_eventi = get_permalink( get_page_by_title('Eventi') );
	$page_query = new WP_Query([
			'post_type' => 'page',
			'title' => 'Eventi',
			'posts_per_page' => 1,
			'fields' => 'ids',
			'no_found_rows' => true
	]);
	$url_luoghi = $page_query->have_posts() ? get_permalink($page_query->posts[0]) : home_url('eventi');

	if (is_array($eventi) && count($eventi)) {
?>

<div class="container pt-5">
	<h2 class="title-xxlarge mb-4 visually-hidden">Eventi in evidenza</h2>
	<div class="row g-4">
		<?php
			foreach ($eventi as $eventi_id) {
				$post = get_post($eventi_id);
				get_template_part("template-parts/evento/card");
			}
		?>
	</div>
</div>
<?php } ?>
