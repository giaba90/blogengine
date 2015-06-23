<script src="<?php echo base_url().'assets/js/vendor/bootstrap.min.js';?>"></script>

<script>
    $('.open_menu').popover();

    $(".close_menu").hide();
    $(".menu").hide();
    $(".open_menu").click(function() {
        $(".menu").slideToggle("slow", function() {
            $(".open_menu").hide();
            $(".close_menu").show();
        });
    });

    $(".close_menu").click(function() {
        $(".menu").slideToggle("slow", function() {
            $(".close_menu").hide();
            $(".open_menu").show();
        });
    });
</script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>
</body>

</html>