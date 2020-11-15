<?php  
if (get_row_layout() == 'modulo_1'):
    $row = get_row(true);
    $row = array_remove_empty($row);
    // pre($row);
?>
    <div class="modulo-1 container-fluid box-container my-2 my-md-0" style="background-image:url(<?php echo esc_url( $row['background_image'] ); ?>);background-size:contain;background-color:#fff">
        <div class="md-container px-0">
            <div class="box col-lg-6 <?php echo esc_attr( $row['posizione_box'] ); ?> default">
                <?php echo $row['body']; ?>
                <?php if ( isset( $row['cta'] ) ) : ?>
                        <a class="button button-primary cta text-uppercase mt-5" href="<?php echo esc_url( $row['cta']['url'] ); ?>"><?php echo $row['cta']['label']; ?></a>  
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
