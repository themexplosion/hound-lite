<?php

namespace Hound\includes;

class AJAX_Handler {
	public function __construct() {
		add_action( 'wp_ajax_hound_ajax_search', array( $this, 'hound_ajax_search' ) );
		add_action( 'wp_ajax_nopriv_hound_ajax_search', array( $this, 'hound_ajax_search' ) );
	}

	public function hound_ajax_search() {
		if ( ! wp_verify_nonce( $_POST['nonce'], '_hound_search' ) ) {
			wp_die( 'Security check' );
		}

		$search_query = sanitize_text_field( $_POST['search_query'] );

		$thumb_size = 'post-thumbnail';

		$results = new \WP_Query(
			array(
				'post_type'      => array( 'post', 'page' ),
				's'              => $search_query,
				'posts_per_page' => - 1,
			)
		);

		?>
		<div class="hound-result-container">
			<?php

			if ( $results->have_posts() ) {
				while ( $results->have_posts() ) :
					$results->the_post();
					?>
					<div class="hound-result-item flex justify-center">
						<div class="hound-title-excerpt">
							<h3>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<p><?php the_excerpt(); ?></p>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			}
			?>
		</div> <!-- ./hound-result-container -->
		<?php
		// Return the results as a JSON response
		wp_die();
	}
}
