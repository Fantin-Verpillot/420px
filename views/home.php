<?php require_once 'views/header.php'; ?>


    <div class="content-section-a">
        <div class="container">
            <div class="row image-block">
                <?php
                foreach($users[$idUserConnected] as $image) {
                    ?>
                    <img class="image-library" src="<?php echo $image; ?>" alt="">
                    <?php
                }
                ?>
            </div>
            <a href="index.php?action=user&param=<?php echo $idUserConnected; ?>"><h3 class="image-library-user"><?php echo 'Vos photos'; ?></h3></a>
        </div>
    </div>
<?php
$i = 0;
foreach($users as $id => $images) {
    if ($id == $idUserConnected) {
        continue;
    }
?>
    <div class="content-section-<?php echo $i % 2 === 1 ? 'a' : 'b'; ?>">
        <div class="container">
            <div class="row image-block">
                <?php
                foreach($images as $image) {
                ?>
                    <img class="image-library" src="<?php echo $image; ?>" alt="">
                <?php
                }
                ?>
            </div>
            <a href="index.php?action=user&param=<?php echo $id; ?>"><h3 class="image-library-user"><?php echo $userPseudos[$id]; ?></h3></a>
        </div>
    </div>
<?php
    ++$i;
}
?>

<?php require_once 'views/footer.php'; ?>