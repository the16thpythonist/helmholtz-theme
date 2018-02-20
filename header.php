<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <!-- IMPORTING JQUERY SO IT CAN BE USED IN THE SCRIPTS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- THE JAVASCRIPT TO MAKE THE IMAGE FADE INTO THE CONTROL BAR WITH SCROLLING DOWN -->
        <script>

            var Icon = $('<li class="icon-wrapper"><div class="logo-wrapper-small"><div class="logo-letter-wrapper-small"><p><b>M</b></p></div><div class="logo-letter-wrapper-small" id="logo-second-letter-wrapper-small"><p class="logo-letter"><b>T</b></p></div><div class="logo-dts-wrapper-small"><p class=><span><b>D</b></span><b>TS</b></p></div><div class="after-logo-box-small"></div></div></li>');
            Icon.css('opacity', 0);

            var helmholtzShowing = true;
            var sidebarAside = true;

            $(document).ready(function(){
                /* Hier der jQuery-Code */
                var menu = $('#menu-main');
                menu.prepend(Icon);

                var win = $(window);
                var helmholtzContainer = $('.helmholtz-img-container');

                var sidebar = $('.sidebar-wrap');
                var column1 = $('.col-sm-8');
                var column2 = $('.col-sm-4');

                var row = $('.container');

                win.bind('scroll', function () {
                    if(win.scrollTop() <= 240) {
                        menu.css('margin-left', win.scrollTop() * 0.58);
                        Icon.css('opacity', win.scrollTop() * 0.0042);
                    } else {
                        menu.css('margin-left', 140);
                        Icon.css('opacity', 1)
                    }
                });

                win.bind('resize', function () {
                    console.log(sidebar.width());

                    // Checks if the window gets too small and if that is the case makes the helmholtz logo disappear,
                    // so that the logo does not overlap the main window
                    if(win.width() <= 1170) {
                        if (helmholtzShowing) {
                            helmholtzContainer.toggle();
                            helmholtzShowing = false;
                        }
                    } else {
                        if (!helmholtzShowing) {
                            helmholtzContainer.toggle();
                            helmholtzShowing = true;
                        }
                    }

                    // This part checks if the window has a certain width and if that is the case moves the sidebar
                    // down under the main column and makes the main column broader
                    if(win.width() <= 1170) {
                        row.width(win.width());
                        column2.width(0);
                        column1.width(win.width() - 30);
                        if(sidebarAside) {
                            column1.detach('.sidebar-wrap');
                            sidebar.appendTo(column1);
                            sidebarAside = false;
                        }
                    } else {
                        row.width(1170);
                        column2.width(360);
                        column1.width(780);
                        if(!sidebarAside) {
                            column2.detach('.sidebar-wrap');
                            sidebar.appendTo(column2);
                            sidebarAside = true;
                        }
                    }
                })
            });
        </script>
        <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar-default">
		<header id="<?php if (nimbus_get_option('fp-banner-slug')=='') {echo "home";} else {echo esc_attr(nimbus_get_option('fp-banner-slug'));} ?>" >
			<div class="helmholtz-bar">
                <div class="helmholtz-img-container">
                    <a href="www.helmholtz.de" >
                        <img class="helmholtz-img" src="https://www.helmholtz.de/typo3conf/ext/dreipc_helmholtz/Resources/Public/assets/Images/logo/logo_helmholtz_EN.svg">
                    </a>
                </div>

                <div class="helmholtz-bar-inner">

                </div>
                <div class="helmholtz-bar-triangle">

                </div>
            </div>
            <div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-push-6">
						<?php get_template_part( 'partials/social'); ?>
					</div>		
					<div class="col-sm-6  col-sm-pull-6">

                        <div class="logo-wrapper">
                            <div class="logo-letter-wrapper">
                                <p class="logo-letter">
                                    <b>M</b>
                                </p>
                            </div>
                            <div class="logo-letter-wrapper" id="logo-second-letter-wrapper">
                                <p class="logo-letter">
                                    <b>T</b>
                                </p>
                            </div>
                            <div class="logo-dts-wrapper">
                                <p class="logo-dts">
                                    <span><b>D</b></span><b>TS</b>
                                </p>
                            </div>
                            <div class="after-logo-box">

                            </div>
                        </div>

						<?php
						if ( function_exists( 'the_custom_logo' ) ) {
							if (has_custom_logo()){
								# the_custom_logo();
							} else {
								get_template_part( 'partials/textlogo');
							}
						} else {
							get_template_part( 'partials/textlogo');
						}
						?>
					</div>
				</div>	
			</div>
	    </header>
	    <nav class="primary-nav">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">

						<?php get_template_part( 'partials/menu'); ?>
					</div>		
				<div>
			</div>
	    </nav>
	    <?php if (is_front_page() && !is_home() && !is_paged()) {
		    get_template_part( 'partials/frontpage','banner');
	    } ?>