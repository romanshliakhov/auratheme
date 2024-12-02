<?php function sprite($width , $height, $iconId): void {
    global $build_folder; ?>
    <svg width="<?php echo $width?>" height="<?php echo $height?>">
        <use href="<?php echo $build_folder; ?>img/sprite/sprite.svg#<?php echo $iconId?>"></use>
    </svg>
<?php } ?>