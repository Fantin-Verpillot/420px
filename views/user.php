    <div class="content-section-a content-section-user">
        <div class="container">
            <h3 class="image-user"><?php echo $userPseudo; ?></h3>
            (<a target="_blank" href="index.php?action=rss&param=<?php echo $userId; ?>">Voir RSS</a>)
            <div class="row image-block">
                <?php
                if (count($images) === 0) {
                    ?>
                    <img class="no-image-library space-top" src="assets/img/no_image.png" alt="">
                    <?php
                } else {
                    foreach($images as $idImage => $image) {
                        ?>
                        <a href="index.php?action=image&param=<?php echo $idImage; ?>"><img class="image-library" src="<?php echo $image; ?>" alt=""></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>