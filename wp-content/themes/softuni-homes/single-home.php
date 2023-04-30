<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php while( have_posts() ) : ?>

		<?php the_post(); ?>

		<div class="home-single">
			<main class="home-main">
				<div class="property-card">
					<div class="home-primary">
						<header class="home-header">
							<h1 class="home-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<div class="home-meta">
								<a class="property-meta" href="#"><?php echo softuni_display_single_term( get_the_ID(), 'neighborhood' ); ?></a>
								<a class="property-meta" href="#"><?php echo softuni_display_single_term( get_the_ID(), 'location' ); ?></a>
								<div class="meta-date">Property visits: <?php echo get_post_meta( get_the_ID(), 'visits_count', true ); ?></div>
								<span class="meta-date">Posted on <?php echo get_the_date(); ?></span>
							</div>
							<div class="property-details">
								<span class="home-type">Author: <?php the_author(); ?></span>
							</div>
						</header>

						<div class="home-body">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</main>
			<aside class="home-secondary">
				<div class="home-logo">
					<div class="home-logo-box">
						<?php if ( has_post_thumbnail() ) :  ?>
							<?php the_post_thumbnail( 'home-thumbnail' ); ?>
						<?php else : ?>
							<img src="../../wp-content/themes/softuni-homes/assets/images/bedroom.jpg" width="198" height="118" alt="property image">
						<?php endif; ?>
					</div>
				</div>
				<a id="<?php echo get_the_ID(); ?>" class="like-button" href="#">Like (<?php echo get_post_meta( get_the_ID(), 'likes', true ) ?>)</a>
				<a href="#" class="button button-wide">Buy now</a>
			</aside>
		</div>

		<h2 class="section-heading">Other properties from the city:</h2>

		<?php softuni_update_home_visit_count( get_the_ID() ) ?>

	<?php endwhile; ?>

<?php endif; ?>



<?php get_footer();