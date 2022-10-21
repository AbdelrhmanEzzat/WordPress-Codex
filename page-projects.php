<?php

/* Template Name: CustomPageProjects */ 
 

get_header();
?>

	<div id="primary" class="content-area">
		<?php echo apply_filters( 'zakra_after_primary_start_filter', false ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		
	<!-- Main Container -->
	<div class="main-container">
		
		<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
			

				<?php
				//$query = new WP_Query( array( '' => '' ) );
				$args = array(
						'post_type' => 'projects',
						'post_status' => 'publish',
						
						'posts_per_page' => 20,
					);
						$query = new WP_Query( $args );
				if ( $query -> have_posts() ) :

				// Loop Start
				while ( $query -> have_posts() ) : $query -> the_post();

					if ( $query -> has_post_thumbnail() ) {
						echo '<div class="post-media">';
							the_post_thumbnail('ashe-full-thumbnail');
							add_theme_support( 'post-thumbnails' );
						echo '</div>';
				  
						}

			 		 
				echo'<div class="container-post">';
					echo	'<div class="row">';
						echo	'<div class="col-sm-2">';
						if ($query -> get_the_title() !== '' ) {
								
					//
					
					//echo get_the_author_meta('ID');
						echo '<header class="post-header">';
						echo '<h1 class="page-title">'. get_the_title() .'</h1>'; //the post title
						
						echo '</header>';
				
				
				}	
				
echo	'<div class="row ">';
			echo	'<div class="col-sm ">';
									// social media icon add by Abdo Ezzat from um _ database
			
			'<div id="post-avatar">'.get_avatar(get_the_author_meta('ID'), $size = 50).'<br>';
								 '</div>';
								 $photo_user = um_user_profile_url(); 

			  		echo '<a class ="name_dis">'.$display_name = um_user('display_name').'</a>';
					echo '<div id="post-avatar"><a href = "'.$photo_user.'">'.get_avatar(get_the_author_meta('ID'), $size = 50).'</a><br>';
								echo '</div>';
							
						echo'</div>';
				echo'</div>';

			  echo '<div class="col-sm ">';
			    echo  '<div class="post-content">';
			
						echo '<div class="addReadMore showlesscontent">'.get_field('rev_content').'</div>';
			
		
			    echo '</div>';
			 echo '</div>';
			
			
			
echo '<div class="rev_media">';
	echo	'<div class="row">';
	//  echo	'<div class="col-lg-6">';
				echo'<div class="col-sm ">';
				echo '<div class ="rev_img">'.wp_get_attachment_image( $image= get_field('1nd_photo'), array('400', '400')).'</div>';
				echo '<div class ="rev_img">'.wp_get_attachment_image( $image= get_field('2nd_photo'), array('400', '400')).'</div>';
				echo '<div class ="rev_img">'.wp_get_attachment_image( $image= get_field('3nd_photo'), array('400', '400')).'</div>';
				echo '</div>';
			

			echo '</div>';//col right
			echo '</div>';//col media
		echo '</div>';//ol-sm-2
	echo '</div>';//row
			

    echo '</div>';
		
								
echo '</div>';
			
		
			
			
		
					// Post Pagination
				

				echo '</div>';

			endwhile; // Loop End

			endif;

			?>

		</article>

		

	</div><!-- .main-container -->

</div><!-- .page-content -->

		<?php echo apply_filters( 'zakra_after_primary_end_filter', false ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

?>
<!DOCTYPE HTML>
		<head>
			<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 

				<style>
					.addReadMore.showlesscontent .SecSec,
					.addReadMore.showlesscontent .readLess {
						display: none;
					}

					.addReadMore.showmorecontent .readMore {
						display: none;
					}

					.addReadMore .readMore,
					.addReadMore .readLess {
						font-weight: bold;
						margin-left: 2px;
						color: blue;
						cursor: pointer;
					}

					.addReadMoreWrapTxt.showmorecontent .SecSec,
					.addReadMoreWrapTxt.showmorecontent .readLess {
						display: block;
					}
					
					.col-sm-2{
						margin: 20px;
   						 padding: 20px;
					}
					.col-right {
					background: white;
					padding: 0px;
					display: inline;
					}
					
					.post-content {
					color: black;
					font-family: sans-serif;
					padding: 5px;
					margin: 15px;
					background-color: honeydew;
					}
					.comments-area textarea {
  					  height: 100px;
					}
					 #comment{

					height: 44px;
				}
				#reply-title, #reply-title a, .comment-title h2, .comment-title {
					margin-bottom 0;
				}

					@media only screen and (max-width: 600px) {
						  /* For mobile phones: */
						  .col-sm-2 {
							padding: 0px;
							margin: 0px;
						}
						.post-content
						padding: 0px;
						margin: 0px;
					}
					
					
					
					
  			  </style>
			<script>

				function AddReadMore() {
					//This limit you can set after how much characters you want to show Read More.
					var carLmt = 200;
					// Text to show when text is collapsed
					var readMoreTxt = " ... Read More";
					// Text to show when text is expanded
					var readLessTxt = " Read Less";


					//Traverse all selectors with this class and manupulate HTML part to show Read More
					$(".addReadMore").each(function() {
						if ($(this).find(".firstSec").length)
							return;

						var allstr = $(this).text();
						if (allstr.length > carLmt) {
							var firstSet = allstr.substring(0, carLmt);
							var secdHalf = allstr.substring(carLmt, allstr.length);
							var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
							$(this).html(strtoadd);
						}

					});
					//Read More and Read Less Click Event binding
					$(document).on("click", ".readMore,.readLess", function() {
						$(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
					});
				}
				$(function() {
					//Calling function after Page Load
					AddReadMore();
				});
			</script>
			
		</head>

			

		<body>
			

	
		</body>
	
