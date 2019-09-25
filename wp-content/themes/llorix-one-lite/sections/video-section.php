<div id="section-video">
	<div class="container">
		<div class="row">
			<div class="col-md-12 timeline-text text-left video-title">
				<h2 class="text-left dark-text">Hình Ảnh</h2>
				<div class="colored-line-left"></div>
			</div>
			
			<div class="col-md-12 videos">
				<div class="col-md-4 col-sm-4 col-xs-12 video-left">
					<a class="video-image" href="#1">
						<!--<img src="<?php bloginfo('template_directory');?>/images/video1.jpg">-->
						<?php $video1 = do_shortcode( '[sc name="Homepage Video 1"]' ); echo do_shortcode( '[video_lightbox_youtube video_id="'.strip_tags($video1).'&rel=false" width="640" height="480" auto_thumb="1"]' ); ?>
					</a>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-12 video-center">
				<a class="video-image" href="#2">
						<!--<img src="<?php bloginfo('template_directory');?>/images/video2.jpg">-->
						<?php $video2 = do_shortcode( '[sc name="Homepage Video 2"]' ); echo do_shortcode( '[video_lightbox_youtube video_id="'.strip_tags($video2).'&rel=false" width="640" height="480" auto_thumb="1"]' ); ?>
					</a>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-12 video-right">
				<a class="video-image" href="#3">
						<!--<img src="<?php bloginfo('template_directory');?>/images/video3.jpg">-->
						<?php $video3 = do_shortcode( '[sc name="Homepage Video 3"]' ); echo do_shortcode( '[video_lightbox_youtube video_id="'.strip_tags($video3).'&rel=false" width="640" height="480" auto_thumb="1"]' ); ?>
					</a>
				</div>
			</div>

		</div>
	</div>
</div>