<footer class="footer">
    <div class="container">
        <div class="row margin-top-10">
            <div class="col-md-5 col-md-offset-1">
                <span class="copyleft">Copyleft &copy; 2015 - Developed by <a href="http://www.gianlucabarranca.it">Gianluca Barranca</a></span>

            </div>
            <div class="col-md-4 col-md-offset-2">
                <ul class="social">
                    <li>
                        <a href="#">
                            <img src="<?php echo base_url().'assets/img/fb.png';?>" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="<?php echo base_url().'assets/img/tw.png';?>" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="<?php echo base_url().'assets/img/lk.png';?>" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="<?php echo base_url().'assets/js/vendor/bootstrap.min.js';?>"></script>
<script src="<?php echo base_url().'assets/js/main.js';?>"></script>

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