<?php get_header(); ?>

<?php
$homes_args = array(
	'post_type'			=> 'home',
	'post_status'		=> 'publish',
	'orderby'			=> 'date',
	'order'				=> 'ASC',
);

$homes_query = new WP_Query( $homes_args );
?>

<?php if ( $homes_query->have_posts() ) : ?>
	<h2>Properties Offers</h2>
	<ul class="properties-listing">
		<?php while ( $homes_query->have_posts() ) : ?>
			<?php //var_dump( "Hello from the custom post type" ); ?>
			<?php $homes_query->the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'home' ); ?>

		<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php get_footer(); ?>