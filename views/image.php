<?php require_once 'views/header.php'; ?>

    <div class="content-section-a">
        <div class="container">
            <div class="row image-block">
                <img class="image-page" src="<?php echo $image; ?>" alt="">
            </div>
            <a href="index.php?action=user&param=<?php echo $userId; ?>"><h3 class="image-library-user"><?php echo $userPseudo; ?></h3></a>
        </div>
    </div>

<?php require_once 'views/footer.php'; ?>