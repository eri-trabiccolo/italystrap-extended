<?php
/**
 * Template for widget post
 *
 * @package ItalyStrap
 */

?>

<?php if ( isset( $this->args['before_posts'] ) ) : ?>
	<div class="post-widget-before">
		<?php echo wpautop( esc_attr( $this->args['before_posts'] ) ); // XSS ok.?>
	</div>
<?php endif; ?>

<section class="post-widget hfeed <?php echo esc_attr( $this->args['container_class'] ); ?>" itemscope itemtype="http://schema.org/CollectionPage">

	<?php

	if ( $this->query->have_posts() ) :

		while ( $this->query->have_posts() ) :

			$this->query->the_post();

			if ( isset( $this->posts_to_exclude[0] ) && in_array( get_the_ID(), $this->posts_to_exclude, true ) ) {
				continue;
			}

			/**
			 * Ad "active" css class to current post
			 *
			 * @var string
			 */
			$current_post = ( $this->post && $this->post->ID === $this->current_post_id && is_single() ) ? ' active' : '';

			$post_class = ( ! empty( $this->args['post_class'] ) ) ? ' ' . $this->args['post_class'] : '' ;

			$classes = 'post-number-' . $this->query->current_post . $current_post . esc_attr( $post_class );

			?>

			<article id="widget-post-<?php the_ID(); ?>"  <?php post_class( $classes ); ?>>

				<?php include \ItalyStrap\Core\get_template( '/templates/posts/thumbnail.php' ); ?>

				<section class="entry-body">
					<header class="entry-header">
						<?php if ( get_the_title() && $this->args['show_title'] ) : ?>
						<<?php echo esc_attr( $this->args['entry_title'] ); ?> class="entry-title">
							<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark">
								<span itemprop="name">
									<?php the_title(); ?>
								</span>
							</a>
						</<?php echo esc_attr( $this->args['entry_title'] ); ?>>
						<?php endif; ?>
					
						<?php if ( $this->args['show_date'] || $this->args['show_author'] || $this->args['show_comments_number'] ) : ?>
					
						<div class="entry-meta">
					
							<?php
							if ( $this->args['show_date'] ) : ?>
								<time class="published" datetime="<?php echo get_the_time( 'c' ); // XSS ok. ?>" itemprop="datePublished"><?php echo get_the_time( $this->args['date_format'] ); // XSS ok.?></time>
							<?php
							endif;

							if ( $this->args['show_date'] && $this->args['show_author'] ) : ?>
							<span class="sep"><?php esc_attr_e( '|', 'italystrap' ); ?></span>
							<?php
							endif; ?>
					
							<?php if ( $this->args['show_author'] ) : ?>
								<span class="author vcard" itemprop="author">
									<?php esc_attr_e( 'By', 'italystrap' ); ?>
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="fn">
										<?php echo get_the_author(); ?>
									</a>
								</span>
							<?php endif; ?>
					
							<?php if ( $this->args['show_author'] && $this->args['show_comments_number'] ) : ?>
								<span class="sep"><?php esc_attr_e( '|', 'italystrap' ); ?></span>
							<?php endif; ?>
					
							<?php if ( $this->args['show_comments_number'] ) : ?>
								<a class="comments" href="<?php comments_link(); ?>">
									<?php comments_number( __( 'No comments', 'italystrap' ), __( 'One comment', 'italystrap' ), __( '% comments', 'italystrap' ) ); ?>
								</a>
							<?php endif; ?>
					
						</div>
					
						<?php endif; ?>
					
					</header>
					
					<?php if ( $this->args['show_excerpt'] ) : ?>
						<div class="entry-summary">
							<p itemprop="text">
								<?php

								// echo esc_attr( get_the_excerpt() );
								echo esc_attr( wp_trim_words( get_the_excerpt(), $this->args['excerpt_length'], '' ) );
								/**
								 * Echo echo esc_attr( wp_trim_words( get_the_content(), $this->args['excerpt_length'], '' ) );
								 */
								?>
								<?php if ( $this->args['show_readmore'] ) : ?>
								<a <?php
								$array = array(
									'class'	=> 'more-link',
									'href'	=> get_permalink(),
									'rel'	=> 'prefetch',
									);
								ItalyStrap\Core\get_attr( 'widget_post_read_more', $array, true ) ?>><?php echo esc_attr( $this->args['excerpt_readmore'] ); ?></a>
								<?php endif; ?>
							</p>
						</div>
					<?php elseif ( $this->args['show_content'] ) : ?>
						<div class="entry-content" itemprop="text">
							<?php the_content() ?>
						</div>
					<?php endif; ?>
					
					<footer class="entry-footer">
					
						<?php
						$categories = get_the_term_list( $this->query->post->ID, 'category', '', ', ' );
						if ( $this->args['show_cats'] && $categories ) :
							?>
						<div class="entry-categories">
							<strong class="entry-cats-label"><?php esc_attr_e( 'Posted in', 'italystrap' ); ?>:</strong>
							<span class="entry-cats-list"><?php echo $categories; // XSS ok.?></span>
						</div>
						<?php endif; ?>
					
						<?php
						$tags = get_the_term_list( $this->query->post->ID, 'post_tag', '', ', ' );

						if ( $this->args['show_tags'] && $tags ) :
						?>
						<div class="entry-tags">
							<strong class="entry-tags-label"><?php esc_attr_e( 'Tagged', 'italystrap' ); ?>:</strong>
							<span class="entry-tags-list" itemprop="keywords"><?php echo $tags; // XSS ok. ?></span>
						</div>
						<?php endif; ?>
					
						<?php $this->get_custom_fields(); ?>
					</footer>
				</section>
		</article>

		<?php endwhile; ?>

		<?php else : ?>

			<p class="post-widget-not-found">
				<?php esc_attr_e( 'No posts found.', 'italystrap' ); ?>
			</p>

		<?php endif; ?>

</section>

<?php if ( isset( $this->args['after_posts'] ) ) : ?>
	<div class="post-widget-after">
		<?php echo wpautop( esc_attr( $this->args['after_posts'] ) ); // XSS ok. ?>
	</div>
<?php endif;
