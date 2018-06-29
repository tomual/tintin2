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
        <select class="selectize-search form-control"></select>
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

    var urlViewTicket = '<?php echo base_url('ticket/view/') ?>';
    var urlNewTicket = '<?php echo base_url('ticket/new/') ?>';
    var urlTicketList = '<?php echo base_url('ticket/all/') ?>';
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

    $('.selectize-search').on('change', function() {
        var ticket_id = $('.selectize-search').val();
        if(ticket_id) {
            window.location.href = urlViewTicket + ticket_id;
        }
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
                $('.search-overlay').fadeIn(function() {
                    searchSelectize[0].selectize.focus();
                    $('.selectize-search input').click();
                });
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

    var searchSelectize = $('.selectize-search').selectize({
        valueField: 'ticket_id',
        labelField: 'title',
        searchField: 'title',
        options: [],
        persist: false,
        loadThrottle: 600,
        create: false,
        allowEmptyOption: true,
        render: {
            option: function(item, escape) {
                return '<div>' +
                        '<div class="text-inherit"><span class="small text-muted"> <b>' + escape(item.ticket_id) + ':</span>' + escape(item.title) + '</b></div>' +
                        '<div class="text-muted small float-left">' + escape(item.status_label) + '</div>' +
                        '<div class="text-inherit small float-right">created ' + escape(item.created_at) + '</div>' +
                '</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '<?php echo base_url('ticket/ajax_search') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    keywords: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    // you can apply any modification to data before passing it to selectize
                    callback(res);
                    // res is json response from server
                    // it contains array of objects. Each object has two properties. In this case 'id' and 'Name'
                    // if array is inside some other property of res like 'response' or something. than use this
                    //callback(res.response);
                }
            });
        }
    });
</script>
</body>
</html>