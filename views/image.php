    <div class="content-section-a">
        <div class="container">
            <div class="row image-block">
                <div class="col-lg-2 effect-block">
                    <?php
                    if ($userId == $idUserConnected) {
                        ?>
                        <a href=""><img class="effect-image-page" src="<?php echo $image; ?>" alt=""></a>
                        <a href=""><img class="effect-image-page" src="<?php echo $image; ?>" alt=""></a>
                        <a href=""><img class="effect-image-page" src="<?php echo $image; ?>" alt=""></a>
                        <a href=""><img class="effect-image-page" src="<?php echo $image; ?>" alt=""></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-6">
                    <img class="image-page" src="<?php echo $image; ?>" alt="">
                </div>
                <div class="col-lg-2">
                    <?php
                    if ($userId == $idUserConnected) {
                        ?>
                        <h4>Luminosité</h4><a href="">Diminuer (-)</a><br /><a href="">Augmenter (+)</a><br /><br />
                        <h4>Contraste</h4><a href="">Diminuer (-)</a><br /><a href="">Augmenter (+)</a><span><br /><br />
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