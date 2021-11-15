<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package XSimplyChild
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="search-box"> 
			<?php get_search_form(); ?>
		</div>
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
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
