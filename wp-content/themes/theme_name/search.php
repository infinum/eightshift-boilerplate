<?php
	get_header();
?>

<?php if ( have_posts() ) { ?>
	<!-- Page Title -->
	<header>
	<h1>
		<?php printf( __( 'Search Results for: %s', 'Theme_name' ), '<span>' . get_search_query() . '</span>' ); ?>
	</h1>
	</header>
<?php } ?>

<!-- Listing Section -->
<?php
if ( have_posts() ) {

	while ( have_posts() ) { the_post();
		get_template_part( 'template-parts/listing/grid' );
	};

	the_posts_pagination( array( 'screen_reader_text' => ' ' ) );

} else {
	get_template_part( 'template-parts/listing/empty' );
};

	wp_reset_query();

get_footer();
