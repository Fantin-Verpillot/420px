    <div class="content-section-a">
        <div class="container">
            <div class="row image-block">
                <img class="image-page" src="<?php echo $image; ?>" alt="">
            </div>
            <br />
            <div class="row">
                <div class="text-center">
                    <a href="index.php?action=user&param=<?php echo $userId; ?>"><h3 class="display-inline"><?php echo $userPseudo; ?></h3></a><br />
                    <?php
                    if ($userId == $idUserConnected) {
                        ?>
                        <a href="index.php?action=delete&param=<?php echo $imageId; ?>"">(supprimer)</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>