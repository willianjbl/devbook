    <div class="modal">
        <div class="modal-inner">
            <a rel="modal:close">&times;</a>
            <div class="modal-content"></div>
        </div>
    </div>
    <script>
        const BASE = '<?= $base ?>';
    </script>
    <script src="<?= "$base/assets/js/flash.js" ?>"></script>
    <script type="text/javascript" src="<?= "$base/assets/js/script.js" ?>"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script type="text/javascript">
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: false,
            autoplayVideos: true
        });
    </script>
</body>
</html>
