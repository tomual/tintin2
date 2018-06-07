</div>
</div>

<script src="<?php echo base_url('assets/js/vendors/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/jquery-ui.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/selectize.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/ckeditor/ckeditor.js') ?>"></script>
<script>

    $(document).ready(function () {
        $('.selectize').selectize();
        CKEDITOR.replaceClass = 'ckeditor';

        $('.datepicker').datepicker();
    });

    var urlNewTicket = '<?php echo base_url('ticket/new') ?>';
    var keyPressed = {};
    document.addEventListener('keydown', function (e) {

        keyPressed[e.key + e.location] = true;

        if (keyPressed.Shift1 == true && keyPressed.Control1 == true) {
            // Left shift+CONTROL pressed!
            keyPressed = {}; // reset key map
        }
        if (keyPressed.Shift2 == true && keyPressed.Control2 == true) {
            // Right shift+CONTROL pressed!
            keyPressed = {};
        }

        checkShortcut();
    }, false);

    document.addEventListener('keyup', function (e) {
        keyPressed[e.key + e.location] = false;

        keyPressed = {};
    }, false);

    function checkShortcut() {
        if (keyPressed.q0 && keyPressed.w0) {
            window.location.href = urlNewTicket;
        }
    }
</script>
</body>
</html>