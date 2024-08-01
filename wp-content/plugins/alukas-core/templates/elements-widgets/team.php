<?php 
/**
 * Team Template
 */
?>

<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class ); ?>">	
	<div class="<?php echo $slider_class; ?>" <?php if( ! empty( $slider_options ) ){ echo 'data-slider_options="'.esc_attr( $slider_options ).'"';  } ?> >
		<?php 
		foreach( $team_members as $member_data){
			$team_args = $member_data;
			$team_args['id'] 		= pls_uniqid( 'pls-team-member-' );
			$team_args['style']		= $style;
			$team_args['image'] 	= '';
			if( ! empty( $member_data['image']['id'] ) ){
				$image_output 			= wp_get_attachment_image( $member_data['image']['id'],  'full', false );
				$team_args['image'] 	= $image_output;
			}elseif( ! empty( $member_data['image']['url'] ) ){
				$team_args['image'] 	= '<img src="'.$member_data['image']['url'].'"/>';
			}
			
			$team_args['class']	= 'pls-team-member swiper-slide';
			$team_social_data = array();				
			if( ! empty( $member_data['twitter'] ) ){
				$team_social_data[] = array(
					'class'	=> 'twitter',
					'icon'	=> 'picon-x-twitter',
					'link'	=> $member_data['twitter'],
				);
			}
			if( ! empty( $member_data['facebook'] ) ){
				$team_social_data[] = array(
					'class'	=> 'facebook',
					'icon'	=> 'picon-facebook',
					'link'	=> $member_data['facebook'],
				);
			}
			if( ! empty( $member_data['linkedin'] ) ){
				$team_social_data[] = array(
					'class'	=> 'linkedin',
					'icon'	=> 'picon-linkedin',
					'link'	=> $member_data['linkedin'],
				);
			}
			if( ! empty( $member_data['skype'] ) ){
				$team_social_data[] = array(
					'class'	=> 'skype',
					'icon'	=> 'picon-skype',
					'link'	=> $member_data['skype'],
				);
			}
			if( ! empty( $member_data['instagram'] ) ){
				$team_social_data[] = array(
					'class'	=> 'instagram',
					'icon'	=> 'picon-instagram',
					'link'	=> $member_data['instagram'],
				);
			}
			if( ! empty( $member_data['youtube'] ) ){
				$team_social_data[] = array(
					'class'	=> 'youtube',
					'icon'	=> 'picon-youtube',
					'link'	=> $member_data['youtube'],
				);
			}
			
			$team_args['team_social_data'] 	= $team_social_data;
			
			extract( $team_args );?>
			
			<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
				<div class="pls-member-avatar">
					<?php echo ($image);?>
					<?php if( ! empty( $team_social_data ) ){ ?>
						<div class="pls-member-social">
							<?php foreach( $team_social_data as $social_data ){ ?>
									<a class="pls-team-icon <?php echo esc_attr($social_data['class']);?>" href="<?php echo esc_url($social_data['link']);?>" target="_blank"><i class="<?php echo esc_attr($social_data['icon']);?>"></i></a>
							<?php } ?>		
						</div>
					<?php } ?>
				</div>		
				<div class="pls-member-info">
					<h3 class="pls-member-name"><?php echo esc_attr($name);?></h3>
					<div class="pls-member-designation"><?php echo esc_attr($designation);?></div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>