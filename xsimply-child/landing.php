<?php
/*
Template Name: Landing
Template Post Type: page
*/

?>
<?php
/**
 * The header part
 *
 * @package XSimply
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if( xsimply_retrocompat() ) {
	wp_body_open();
} ?>
<div id="page" class="site">
	<div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">

            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'page' );

            endwhile; // End of the loop.
            ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <footer id="colophon" class="site-footer">
            <nav id="site-footer-navigation" class="footer-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-2',
                    'menu_id'        => 'footer-menu'
                ) );
                ?>
            </nav>
		<?php xsimply_get_my_site_cp(); ?>
        </footer><!-- #colophon -->
        
    </div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
