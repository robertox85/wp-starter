<?php
if (get_row_layout() == 'modulo_12'):
    $row   = get_row( true );
    $allineamento_testo = $row['allineamento_testo'];
    $testo = ($allineamento_testo == 'destra') ? 'order-1': 'order-2';
    $video = ($allineamento_testo == 'destra') ? 'order-2': 'order-1';
    // background
    // titolo
    // contenuto
    // iframe - x modal
    // allineamento testo - dx o sx

?>

<div id="video-hero_1" class="heroes modulo-12" data-src="<?php echo $row['background'] ?>" style="background-image: url('<?php echo $row['background'] ?>');">
    <div class="heroes--container container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-xl-6 <?php echo $testo ?>">
                <div class="heroes-container--outer">
                    <div class="heroes-container--single">
                        <div class="body">
                            <h4 class="title color-standard--white"><?php echo $row['titolo'] ?></h4>
                            <p class="paragraph--big color-standard--white"><?php echo $row['contenuto'] ?></p>
                            <a class="btn color-standard--white d-lg-none d-block" data-toggle="modal"
                                data-target="#modal__hero-1">Visualizza video</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 text-center <?php echo $video ?>">


                <!-- Button trigger modal -->
                <button type="button" class="btn" data-toggle="modal" data-target="#modal__hero-1">
                    <i class="fas fa-play-circle fa-3x color-standard--white d-none d-lg-block"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modal__hero-1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content modal-video">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php echo $row['iframe'] ?>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
<?php endif; ?>