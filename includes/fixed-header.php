<header class="fl-page-header fl-page-header-fixed fl-page-nav-right">
	<div class="fl-page-header-wrap">
		<div class="fl-page-header-container container">
			<div class="fl-page-header-row row">
				<div class="fl-page-logo-wrap col-md-3 col-sm-12">
					<div class="fl-page-header-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="WP Paris l'association des utilisateurs parisiens de WordPress"><?php FLTheme::logo(); ?></a>
					</div>
				</div>
				<div class="fl-page-fixed-nav-wrap col-md-9 col-sm-12">
					<div class="fl-page-nav-wrap">
						<nav class="fl-page-nav fl-nav navbar navbar-default" role="navigation">
							<div class="fl-page-nav-collapse collapse navbar-collapse">
								<?php 
								
								wp_nav_menu(array(
									'theme_location' => 'header',
									'items_wrap' => '<ul id="%1$s" class="nav navbar-nav navbar-right %2$s">%3$s</ul>',
									'container' => false,
									'fallback_cb' => 'FLTheme::nav_menu_fallback'
								)); 
								
								?>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</header><!-- .fl-page-header-fixed -->