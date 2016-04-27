    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright text-muted small">Copyright &copy; Fantin Verpillot 2016.<br />All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>

<?php
if (isset($alert_error)) {
    echo '<script>alert(\''.$alert_error.'\')</script>';
}
?>