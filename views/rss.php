<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<rss version="2.0">
    <channel>
        <title>Photos de <?php echo $userPseudo; ?></title>
        <link>http://localhost/420px/index.php?action=user&param=<?php echo $userId; ?></link>
        <description>XML contenant les photos de l'utilisateur <?php echo $userPseudo; ?>.</description>
        <?php
        foreach ($images as $id => $image) {
            ?>
            <item>
                <title>Photo n°<?php echo $id; ?></title>
                <description>Item contenant la photo n°<?php echo $id; ?> de l'utilisateur <?php echo $userPseudo; ?>.</description>
                <image>http://localhost/420px/<?php echo $image; ?></image>
                <link>http://localhost/420px/index.php?action=user&param=<?php echo $id; ?></link>
            </item>
            <?php
        }
        ?>
    </channel>
</rss>