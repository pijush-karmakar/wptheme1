
<?php 
/* 
 This is the template for footer

 @package sunsettheme

*/

 ?>

<footer class="sunset-footer text-center">
    <div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12">

						<?php _e( 'Copyright &copy;', 'sunsettheme' ); ?> <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a><?php _e( '. All rights reserved.', 'sunsettheme' )?>

						<?php printf( esc_html__( 'Powered %1$s by %2$s', 'sunsettheme' ), '', '<a href="https://wordpress.org/" target="_blank">WordPress</a>' ); ?>
						
				</div><!-- .col-lg-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
</footer>

<?php wp_footer(); ?>

</body>

</html>

