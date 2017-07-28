<?php

/*
	Template Name: All Categories
*/
get_header();
the_post();
?>
<section>
	<div class="container">
	<?php query_posts('category_name=blog-posts &posts_per_page=6');?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class='blog-post-container'>
	<a href="<?php the_permalink();?>"><div class='blog-post-image'><?php the_post_thumbnail();?></div>
	<div class='blog-post-title'><?php the_title();?></div></a>
    <div class='blog-post-excerpt'><?php the_excerpt(); ?></div>
   </div>
<?php endwhile; endif; ?>

	</div>
</section>
<?php get_footer(); ?>