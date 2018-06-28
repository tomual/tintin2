</div>
</div>
<div class="shortcuts-overlay" style="display:none">
    <b class="d-block mb-5">Shortcuts</b>
    <div class="shortcut">
        <div class="shortcut-key">Q + W</div>
        <div class="shortcut-label">Search</div>
    </div>
    <div class="shortcut">
        <div class="shortcut-key">Q + E</div>
        <div class="shortcut-label">New Ticket</div>
    </div>
    <div class="shortcut">
        <div class="shortcut-key">Q + R</div>
        <div class="shortcut-label">Ticket List</div>
    </div>
</div>
<div class="search-overlay" style="display:none">
    <div class="form-group">
        <label class="form-label">Search</label>
        <select class="selectize form-control"></select>
    </div>
</div>
<div class="shortcuts-dim" style="display:none"></div>
<div class="search-dim" style="display:none"></div>
<script src="<?php echo base_url('assets/js/vendors/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/jquery-ui.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/selectize.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vendors/ckeditor/ckeditor.js') ?>"></script>
<script src="//dbrekalo.github.io/simpleLightbox/dist/simpleLightbox.min.js"></script>
<script>

    $(document).ready(function () {
        $('.selectize').selectize();
        CKEDITOR.replaceClass = 'ckeditor';

        $('.datepicker').datepicker();
        $('.lightbox').simpleLightbox({
            nextOnImageClick: false,
        });
    });

    var urlNewTicket = '<?php echo base_url('ticket/new') ?>';
    var urlTicketList = '<?php echo base_url('ticket/all') ?>';
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
        $('.shortcuts-overlay').fadeOut('fast');
        $('.shortcuts-dim').fadeOut();
    }, false);

    document.addEventListener('keyup', function (e) {
        keyPressed[e.key + e.location] = false;
        keyPressed = {};
    }, false);

    $('.search-dim').on('click', function() {
        closeSearch();
    });

    function checkShortcut() {
        if (keyPressed.q0) {
            if(!searchIsOpen()) {
                $('.shortcuts-overlay').fadeIn('fast');
                $('.shortcuts-dim').fadeIn();
            }
        }
        if (keyPressed.q0 && keyPressed.w0) {
            $('.search-overlay').fadeOut(function() {
                $('.search-dim').fadeIn();
                $('.search-overlay').fadeIn();
            });
            $('.shortcuts-dim').fadeOut();
        }
        if (keyPressed.q0 && keyPressed.e0) {
            window.location.href = urlNewTicket;
        }
        if (keyPressed.q0 && keyPressed.r0) {
            window.location.href = urlTicketList;
        }
        if (keyPressed.Escape0) {
            closeSearch();
        }
    }

    function searchIsOpen() {
        return $('.search-overlay:visible').length;
    }
    function closeSearch() {
        $('.search-overlay').fadeOut();
        $('.search-dim').fadeOut();
    }
</script>
</body>
</html>