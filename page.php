<?php get_header(); ?>

		<?php if (have_posts()) : ?>
			
			<?php while (have_posts()) : the_post(); ?>
				<?php if (is_front_page()) :?>
					<div class="hidden">
				<?php endif; ?>			
				<?php the_content(); ?>
				<?php if (is_front_page()) :?>
					</div>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
		
		<?php if (is_front_page()) :?>
		<script type="text/javascript">
			var video_array = Array();
		</script>
			<?php $args = array(
			    'numberposts'     => 10000,
			    'offset'          => 0,
			    'orderby'         => 'post_date',
			    'order'           => 'DESC',
			    'post_type'       => 'vega-video',
			 ); ?>
			<?php $post_array = get_posts( $args ); ?>
			<?php $video_array = array(); ?>
			<?php foreach ($post_array as $produktion) { ?>
				<?php 
					global $q_config;
					$id = $produktion->ID; 
					$meta_values = get_post_custom($id);
					$array[0] = $id;
					$array[1] = htmlspecialchars($produktion->post_title, ENT_QUOTES);	
					$array[2] = htmlspecialchars($produktion->post_content, ENT_QUOTES);
					$array[3] = $meta_values['thumbnail'][0];
					$array[4] = $meta_values['poster'][0];
					$array[5] = $meta_values['upload_vid1'][0];
					$array[6] = $meta_values['upload_vid2'][0];
					$array[7] = $meta_values['upload_vid3'][0];
					$array[8] = $q_config['language'];
					?>
						<script>
					 	video_array.push(Array("<?php echo join("\", \"", $array); ?>"));
						</script>
					<?php
					if(isset($_GET['video_id']) && $array[0] == $_GET['video_id']){
						$first = $array;
					}
					elseif(!isset($first) && !isset($_GET['video_id'])){
						$first = $array;
					}
					unset($array);
				?>
			<?php } ?>			
				
				
				<!-- Begin VideoJS -->
				<div id="main_player">
				 	<div class="video-js-box">
				    <video class="video-js" width="700" height="395" controls preload poster="<?php echo $first[4]; ?>">
				      <source src="<?php echo $first[5]; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
				      <source src="<?php echo $first[7]; ?>" type='video/webm; codecs="vp8, vorbis"' />
				      <source src="<?php echo $first[6]; ?>" type='video/ogg; codecs="theora, vorbis"' />
				      <object id="flash_fallback_1" class="vjs-flash-fallback" width="700" height="393" type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
				        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
				        <param name="allowfullscreen" value="true" />
				        <param name="flashvars" value='config={"playlist":["<?php echo $first[4]; ?>", {"url": "<?php echo $first[5]; ?>","autoPlay":false,"autoBuffering":true, "scaling":"fit"}]}' />
				        <img src="<?php echo $first[4]; ?>" width="700" height="393" alt="Poster Image" title="No video playback capabilities." />
				      </object>
				    </video>
				  </div>
				</div>
				  <!-- End VideoJS -->
				<div id="scroll_button_container_div">
					<div id="thumb_scroll_back" class="scroll_button"><a href="#back"><span class="empty_span"></span></a>‹</div><div id="thumb_scroll_forth" class="scroll_button"><a href="#forth"><span class="empty_span"></span></a>›</div>
					<div id="scroll_container_div">
						<div id="thumbnails_div"></div>
					</div>
				</div>
				
				
		<?php endif; ?>
<?php get_footer(); ?>