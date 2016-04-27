    <div class="content-section-a">
        <div class="container">
            <h3 class="image-user"><?php echo $userPseudo; ?></h3>
            <div class="row image-block">
                <?php
                foreach($images as $idImage => $image) {
                    ?>
                <a href="index.php?action=image&param=<?php echo $idImage; ?>"><img class="image-library" src="<?php echo $image; ?>" alt=""></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>