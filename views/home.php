<?php
if ($idUserConnected !== 0) {
    ?>
    <div class="content-section-a">
        <div class="container">
            <div class="row image-block">
                <?php
                if (count($users[$idUserConnected]) === 0) {
                    ?>
                    <img class="no-image-library" src="assets/img/no_image.png" />
                    <?php
                } else {
                    foreach ($users[$idUserConnected] as $idImage => $image) {
                        ?>
                        <a href="index.php?action=image&param=<?php echo $idImage; ?>"><img class="image-library" src="<?php echo $image; ?>?=<?php echo uniqid(); ?>"></a>
                        <?php
                    }
                }
                ?>
            </div>
            <a href="index.php?action=user&param=<?php echo $idUserConnected; ?>"><h3
                    class="image-library-user"><?php echo 'Vos photos'; ?></h3></a>
        </div>
    </div>
    <?php
}
$i = 0;
foreach($users as $idUser => $images) {
    if ($idUser == $idUserConnected) {
        continue;
    }
?>
    <div class="content-section-<?php echo $i % 2 === 1 ? 'a' : 'b'; ?>">
        <div class="container">
            <div class="row image-block">
                <?php
                if (count($images) === 0) {
                    ?>
                    <img class="no-image-library" src="assets/img/no_image.png" alt="">
                <?php
                } else {
                    foreach ($images as $idImage => $image) {
                        ?>
                        <a href="index.php?action=image&param=<?php echo $idImage; ?>"><img class="image-library" src="<?php echo $image; ?>?=<?php echo uniqid(); ?>"></a>
                        <?php
                    }
                }
                ?>
            </div>
            <a href="index.php?action=user&param=<?php echo $idUser; ?>"><h3 class="image-library-user">Photos de <?php echo $userPseudos[$idUser]; ?></h3></a>
        </div>
    </div>
<?php
    ++$i;
}
?>