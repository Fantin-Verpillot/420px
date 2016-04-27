<?php require_once 'views/header.php'; ?>

    <div class="content-section-a">
        <div class="container">
            <h3 class="image-user"><?php echo $userPseudo; ?></h3>
            <div class="row image-block">
                <?php
                foreach($images as $image) {
                    ?>
                    <img class="image-library" src="<?php echo $image; ?>" alt="">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

<?php require_once 'views/footer.php'; ?>