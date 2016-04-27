    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>

<?php
if (isset($alert_error)) {
    echo '<script>alert(\''.$alert_error.'\')</script>';
}
?>