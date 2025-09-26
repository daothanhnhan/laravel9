<!--MENU MOBILE-->
<nav class="visible-sm visible-xs mobile-menu-container mobile-nav">
    <div class="menu-mobile-nav">
        <span class="icon-bar"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </div>
    <div id="cssmenu" class="animated">
        <div class="uni-icons-close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <?= $header_menu ?>
                <div class="clearfix"></div>
    </div>
</nav>
<style>
#cssmenu > ul {
    /*display: block !important;*/
}
</style>
<script>
    $(document).ready(function () {
        //-----------------menu mobile---------------------
        $('.mobile-menu-container .menu-mobile-nav').on('click', function (e) {
            if($(e.target).is('.icon-bar i')){
                $('#cssmenu').slideToggle();
                $('#cssmenu ul').slideToggle();
                $('#cssmenu ul ul').hide();
            }
        });
        $('.uni-icons-close'). on('click', function (e) {
            if($(e.target).is('i')){
                $('#cssmenu').hide( 500);
                $('#cssmenu ul').hide(500);
            }
        });

        (function($) {

            $.fn.menumaker = function(options) {

                var cssmenu = $(this), settings = $.extend({
                    title: "Menu",
                    format: "dropdown",
                    sticky: false
                }, options);

                return this.each(function() {

                    cssmenu.find('li ul').parent().addClass('has-sub');

                    var multiTg = function() {
                        cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                        cssmenu.find('.submenu-button').on('click', function() {
                            $(this).toggleClass('submenu-opened');
                            $(this).toggleClass('active');
                            if ($(this).siblings('ul').hasClass('open')) {
                                $(this).siblings('ul').removeClass('open').slideToggle();
                            }
                            else {
                                $(this).siblings('ul').addClass('open').slideToggle();
                            }
                        });
                    };

                    if (settings.format === 'multitoggle') multiTg();
                    else cssmenu.addClass('dropdown');

                    if (settings.sticky === true) cssmenu.css('position', 'fixed');

                    var resizeFix = function() {
                        if ($( window ).width() > 768) {
                            cssmenu.find('ul').show();
                        }

                        if ($(window).width() <= 768) {
                            cssmenu.find('ul').hide().removeClass('open');
                        }
                    };
                    resizeFix();
                    return $(window).on('resize', resizeFix);

                });
            };
        })(jQuery);

        (function($){
            $(document).ready(function() {
                $("#cssmenu").menumaker({
                    title: "",
                    format: "multitoggle"
                });

                $("#cssmenu").prepend("<div id='menu-line'></div>");

                var foundActive = false, activeElement, linePosition = 0, menuLine = $("#cssmenu #menu-line"), lineWidth, defaultPosition, defaultWidth;

                $("#cssmenu > ul > li").each(function() {
                    if ($(this).hasClass('active')) {
                        activeElement = $(this);
                        foundActive = true;
                    }
                });

                if (foundActive === false) {
                    activeElement = $("#cssmenu > ul > li").first();
                }

                defaultWidth = lineWidth = activeElement.width();

                // defaultPosition = linePosition = activeElement.position().left;

                menuLine.css("width", lineWidth);
                menuLine.css("left", linePosition);

                $("#cssmenu > ul > li").on('mouseenter', function () {
                        activeElement = $(this);
                        lineWidth = activeElement.width();
                        linePosition = activeElement.position().left;
                        menuLine.css("width", lineWidth);
                        menuLine.css("left", linePosition);
                    },
                    function() {
                        menuLine.css("left", defaultPosition);
                        menuLine.css("width", defaultWidth);
                    });
            });
        })(jQuery);
    });
</script><!-- End menu mobile-->

<!--MENU DESTOP-->
<header>
    <div class="gb-header-ruouvang">
        <div class="gb-top-header_ruouvang">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <div class="gb-top-header_ruouvang-left">
                            <ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ: <?= $header_address ?></li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i> Hotline: <?= $header_phone ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="gb-top-header_ruouvang-right">
                            <ul>
                                <li><a href=""><i class="fa fa-user" aria-hidden="true"></i> Đăng nhâp</a></li>
                                <li><a href=""><i class="fa fa-phone" aria-hidden="true"></i> Đăng ký</a></li>
                                <li>
                                    <div class="cart_ruouvang">
  <a href="/gio-hang">
    <i class="fa fa-shopping-bag" aria-hidden="true"></i> (<span class="badge1">0</span>)
  </a>
</div>                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gb-header-between_ruouvang">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="gb-header-between_ruouvang-left">
                            <h1>
                                <a href="/"><img src="/storage/uploads/config/{{ $header_logo }}" alt="logo" class="img-responsive"></a>
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="gb-header-search_ruouvang">
    <form action="/tim-kiem-san-pham" method="get" accept-charset="utf-8">
        <div class="vk-newlist-banner-test-search">
            <input type="text" name="q" placeholder="Search...">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>
</div>                    </div>
                </div>
            </div>
        </div>
        <div class="gb-header-bottom_ruouvang">
            <div class="container">
                <nav class="gb-main-menu_ldpvinhome sticky-menu" >
    <div class="main-navigation uni-menu-text_ldpvinhome">
        <div class="cssmenu">
            
            <?= $header_menu ?>        </div>
    </div>
</nav>

<script src="/plugin/sticky/jquery.sticky.js"></script>
<script>
    $(document).ready(function () {
        var headerHeight = $('.gb-main-menu_ldpvinhome').outerHeight();

        $('.slide-section').click(function () {
            var linkHref = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(linkHref).offset().top - headerHeight
            }, 1000);
            e.preventDefault();
        });

        $(".sticky-menu").sticky({topSpacing:0});
    });
</script>            </div>
        </div>
    </div>
</header>

<script src="/plugin/sticky/jquery.sticky.js"></script>
<script>
    $(document).ready(function () {
        $(".sticky-menu").sticky({topSpacing:0});
    });
</script>