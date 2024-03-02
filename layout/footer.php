    <footer class="fixed-bottom text-center mb-3">
        &copy; FajarAlfa <?= date('Y') ?>
    </footer>
</body>

</html>
<?php
session_unflash();
session_set('last_uri', $_SERVER['REQUEST_URI']);
?>