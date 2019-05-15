		<?php 
		/**
		 * Default template location: landpick/footer
		 *
		 * @hooked landpick_newsletter_form_template_part - 10
		 */
		do_action( 'landpick/footer/before' ); 
		?>
		
		<footer id="<?php landpick_footer_id(); ?>" <?php landpick_footer_class(); ?>>
			<div class="container">

				<?php 
				/**
				 * Default template location: landpick/footer
				 *
				 * @hooked landpick_footer_widget_area_template_part - 10
				 * @hooked landpick_footer_copyright_template_part - 20
				 */
				do_action( 'landpick/footer' ); 
				?>				
				

			</div> <!-- End .container -->										
		</footer> <!-- End footer -->

		<?php 
		/**
		 * Default template location: landpick/footer
		 *
		 * @hooked landpick_quick_contact_form_template_part - 10
		 */
		do_action( 'landpick/footer/after' ); 
		?>
		
	</div>	<!-- End #<?php landpick_wrapper_id(); ?> (Start in header.php) -->

<?php wp_footer(); ?>

</body>
</html>
