<?php
if (get_row_layout() == 'modulo_2'):
$row = get_row(true);
$row = array_remove_empty($row);

$order_1        = ( $row[ 'posizione_testo' ] === 'text-right' ) ? 'order-lg-1' : 'order-lg-2';
$order_2        = ( $row[ 'posizione_testo' ] !== 'text-right' ) ? 'order-lg-1' : 'order-lg-2';
$fadein         = ( $row[ 'posizione_testo' ] === 'text-right' ) ? 'fade-right' : 'fade-left';
$background_url = ( $row[ 'background_type' ] === 'immagine_2' ) ? $row['background_image'] : '';
?>
<div class="modulo-2 md-container box-container mx-auto d-block my-2 my-md-0 py-3 py-lg-5 default"
	style="background-image: url(<?php echo $background_url; ?>)">
	<div class="container-fluid py-lg-5 px-5">
		<div class="row">
			<div class="col-lg-6 box-img py-lg-5 <?php echo $order_1; ?> image-container">

				<?php if ( $row['background_type'] == 'immagine' ) : ?>
				<img class="immagine" src="<?php echo $row['immagine']; ?>" alt="">
				<?php endif; ?>

				<?php if ( $row['background_type'] == 'immagine_2' ) : ?>
				<img class="immagine_2" src="<?php echo  $row['immagine']; ?>" alt="">
				<?php endif; ?>


			</div>
			<div class="col-lg-6 py-lg-5 <?php echo $order_2; ?>">
				<h2><?php echo $row['titolo']; ?></h2>
				<?php echo $row['body']; ?>
				<?php
				if ( isset($row['cta']) ) {
					?>
						<a class="button button-primary cta text-uppercase" href="<?php echo $row['cta']['url']; ?>"><?php echo $row['cta']['label']; ?></a>
					<?php
				}
				?>

			</div>
		</div>
	</div>
</div>

<?php endif; ?>
