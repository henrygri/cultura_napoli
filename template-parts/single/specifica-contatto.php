<?php 

global $specifica_contatto;

?>
<div class="card card-teaser mt-3 rounded no-glow no-pop">
    <svg class="icon" aria-hidden="true">
        <use xlink:href="#it-telephone"></use>
    </svg>
    <div class="card-body">
        <h3 class="card-title h5">
            Specifica contatto
        </h3>
        <div class="card-text">
            <?php echo wpautop( wp_kses_post( $specifica_contatto ) ); ?>
        </div>
    </div>
</div>