<?php
if (get_row_layout() == 'modulo_11'):
    $row   = get_row( true );
    $cards = $row['ripetitore'];
?>
<div class="modulo modulo-11 container my-2 my-md-0">
	<div class="row">
        <?php foreach( $cards as $card ): ?>
            <div id="" class="col card">
                <a href="#" class="card-container card-container--feature">
                    <div class="card-body py-52 px-20 text-center">
                        <?php echo $card['card']['icona']; ?>
                        <h4 class=""><?php echo $card['card']['titolo']; ?></h4>
                        <p class="paragraph--small"><?php echo $card['card']['body']; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
	</div>
</div>
<?php endif; ?>