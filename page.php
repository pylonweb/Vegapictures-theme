<?php get_header(); ?>

		<?php if (have_posts()) : ?>
			
			<?php while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
		
		<?php if (is_front_page()) :?>
		<script type="text/javascript">
			var video_array = Array();
		</script>
			<?php $args = array(
			    'numberposts'     => 5,
			    'offset'          => 0,
			    'orderby'         => 'post_date',
			    'order'           => 'DESC',
			    'post_type'       => 'vega-video',
			 ); ?>
			<?php $post_array = get_posts( $args ); ?>
			<?php $video_array = array(); ?>
			<?php foreach ($post_array as $produktion) { ?>
				<?php 
					$id = $produktion->ID; 
					$meta_values = get_post_custom($id);	
					$array[0] = $id;
					$array[1] = $produktion->post_title;	
					$array[2] = $meta_values['proj_desc'][0];
					$array[3] = $meta_values['thumbnail'][0];
					$array[4] = $meta_values['poster'][0];
					$array[5] = $meta_values['upload_vid1'][0];
					$array[6] = $meta_values['upload_vid2'][0];
					$array[7] = $meta_values['upload_vid3'][0];
					?>
						<script>
					 	video_array.push(Array("<?php echo join("\", \"", $array); ?>"));
						</script>
					<?php
					unset($array);
				?>
			<?php } ?>			
				
				
				<!-- Begin VideoJS -->
				<div id="main_player">
				 	<video id="player" class="video-js vjs-default-skin" controls preload width="700" height="393"
					      poster="http://video-js.zencoder.com/oceans-clip.png"
					      data-setup="">
					    <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4'>
					    <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm'>
					  </video>
				</div>
				  <!-- End VideoJS -->
				
				<div id="thumbnails_div">
				</div>
				
				
		<?php endif; ?>
<?php get_footer(); ?>