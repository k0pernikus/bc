<?php /* Template Name: Ohne Sidebar */ ?>

		<?php get_header(); ?>
		
		<!-- Mobiel Detect -->
		<?php $detect = new Mobile_Detect(); ?>
		<div id="container" role="main">

			<div id="full">

				<!-- Mobile Query -->
				<?php if(!$detect->isMobile() || $detect->isTablet()) : ?>
					<?php if(has_post_thumbnail()) : ?>
						<figure class="post-image">
							<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'full', true); ?>
							<a title="<?php the_title(); ?>" href="<?php echo $image_url[0]; ?>">
								<?php the_post_thumbnail('featured'); ?>
							</a>
							<?php if(get_post(get_post_thumbnail_id())->post_excerpt) : ?>
								<span class="meta-thumbnail-caption">
									<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
								</span>
							<?php endif; ?>
						</figure>
					<?php endif; ?>
			
					<?php if(function_exists('breadcrumb')) : ?>
						<?php breadcrumb(); ?> 
					<?php endif; ?>
				<?php endif; ?>
				<!-- Mobile Query -->

				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
					<header class="header">
						<h1 class="post-title"><?php the_title(); ?></h1>
					</header>
	
					<article class="article">
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
						<?php the_content(); ?>
						<?php wp_link_pages('before=<nav class="pagination_post">'. __("Pages:","scapegoat") .'&after=</nav>'); ?>
					</article>
					
				<?php
				$similar_posts = similar_articles($post->ID);
				if( $similar_posts != false && $similar_posts->have_posts() ) {
				while ($similar_posts->have_posts()) : $similar_posts->the_post(); ?>
				<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
				<?php
				endwhile;
				}
				?>
				</section>
				
				<?php endwhile; ?>
				
					<section id="replys">
						<?php comments_template(); ?>
					</section>
				
				<?php endif; ?>
			</div><!-- content -->

			<div class="clear"></div>
		</div><!-- container -->

		<?php get_footer(); ?>