<?php
if (dci_get_option("stemma_comune")) {
?>
<svg class="icon" aria-hidden="true">       
     <image xlink:href="<?php echo dci_get_option("stemma_comune");?>"/>    
</svg>
<?php } ?>