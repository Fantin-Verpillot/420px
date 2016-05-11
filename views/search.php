<div class="content-section-a content-dc">
    <div class="container">
        <div class="row search-form">
            <div class="col-lg-12">
                <div class="form-search">
                    <div>
                        <form action="index.php?action=search" method="post">
                            <table>
                                <tr>
                                    <td>
                                        <input class="form-control form-field" placeholder="Composantes RGB séparées par des virgules" type="text" name="rgb"/>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary form-field-button color-search-button" type="submit" name="search">Rechercher</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if (isset($images)) {
                ?>
                <h3>Résultats (<?php echo count($images); ?>)</h3><br />
                <?php
                foreach ($images as $idImage => $image) {
                    ?>
                    <a href="index.php?action=image&param=<?php echo $idImage; ?>">
                        <img class="image-library"src="<?php echo $image; ?>?=<?php echo uniqid(); ?>">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>