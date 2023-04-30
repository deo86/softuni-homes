<li class="property-card">
    <div class="property-primary">
        <h2 class="property-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="property-meta">
			<a class="property-meta" href="#"><?php echo softuni_display_single_term( get_the_ID(), 'neighborhood' ); ?></a>
            <a class="property-meta" href="#"><?php echo softuni_display_single_term( get_the_ID(), 'location' ); ?></a>
        </div>
		<?php echo the_content(); ?>
			<span class="property-date">Posted <?php echo softuni_time_ago(); ?></span>
    </div>
    <div class="property-logo">
        <div class="property-logo-box">
        <?php if ( has_post_thumbnail() ) :  ?>
            <?php the_post_thumbnail( 'property-thumbnail' ); ?>
        <?php else : ?>
            <img src="wp-content/themes/softuni-homes/assets/images/bedroom.jpg" width="198" height="118" alt="property image">
        <?php endif; ?>
        </div>
    </div>
</li>