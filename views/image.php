    <div class="content-section-a">
        <div class="container">
            <div class="row image-block">
                <div class="col-lg-2 effect-block">
                    <?php
                    if ($userId == $idUserConnected) {
                        ?>
                        <a href="index.php?action=effect&effect=sepia&param=<?php echo $imageId; ?>"><img class="effect-image-page" src="assets/img/sepia_filter.png" alt=""></a>
                        <a href="index.php?action=effect&effect=greyscale&param=<?php echo $imageId; ?>"><img class="effect-image-page" src="assets/img/greyscale_filter.png" alt=""></a>
                        <a href="index.php?action=effect&effect=gauss&param=<?php echo $imageId; ?>"><img class="effect-image-page" src="assets/img/gauss_filter.png" alt=""></a>
                        <a href="index.php?action=effect&effect=border&param=<?php echo $imageId; ?>"><img class="effect-image-page" src="assets/img/border_filter.png" alt=""></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-6">
                    <img class="image-page" src="<?php echo $image; ?>?=<?php echo uniqid(); ?>" alt="">
                </div>
                <div class="col-lg-2">
                    <?php
                    if ($userId == $idUserConnected) {
                        ?>
                        <h4>Luminosité</h4><a href="index.php?action=effect&effect=lightplus&param=<?php echo $imageId; ?>">Diminuer (-)</a><br /><a href="index.php?action=effect&effect=lightless&param=<?php echo $imageId; ?>">Augmenter (+)</a><br /><br />
                        <h4>Contraste</h4><a href="index.php?action=effect&effect=contrastplus&param=<?php echo $imageId; ?>">Diminuer (-)</a><br /><a href="index.php?action=effect&effect=contrastless&param=<?php echo $imageId; ?>">Augmenter (+)</a><span><br /><br />
                        <h4>Actions</h4><a href="index.php?action=delete&param=<?php echo $imageId; ?>">Supprimer</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="text-center">
                    <a href="index.php?action=user&param=<?php echo $userId; ?>"><h3 class="display-inline"><?php echo $userPseudo; ?></h3></a><br />
                </div>
            </div>
        </div>
    </div>