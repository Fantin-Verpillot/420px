<?php require_once 'views/header.php'; ?>

    <div class="content-section-a">
        <div class="container">
            <div class="row image-block">
                <img class="image-page" src="<?php echo $image; ?>" alt="">
            </div>
            <br />
            <div class="row">
                <div class="text-center">
                    <a href="index.php?action=user&param=<?php echo $userId; ?>"><h3 class="display-inline"><?php echo $userPseudo; ?></h3></a>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'views/footer.php'; ?>