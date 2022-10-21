<?php

get_header();

if (is_front_page()) {

	// Featured Slider, Carousel
	if (ashe_options('featured_slider_label') === true && ashe_options('featured_slider_location') !== 'blog') {
		if (ashe_options('featured_slider_source') === 'posts') {
			get_template_part('templates/header/featured', 'slider');
		} else {
			get_template_part('templates/header/featured', 'slider-custom');
		}
	}

	// Featured Links, Banners
	if (ashe_options('featured_links_label') === true && ashe_options('featured_links_location') !== 'blog') {
		get_template_part('templates/header/featured', 'links');
	}
}

?>

<div class="main-content clear-fix<?php echo esc_attr(ashe_options('general_content_width')) === 'boxed' ? ' boxed-wrapper' : ''; ?>" data-sidebar-sticky="<?php echo esc_attr(ashe_options('general_sidebar_sticky')); ?>">

	<?php

	// Sidebar Left
	get_template_part('templates/sidebars/sidebar', 'left');

	?>

	<!-- Main Container -->
	<div class="main-container">

		<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php

			if (have_posts()) :

				// Loop Start
				while (have_posts()) : the_post();

					/*if ( has_post_thumbnail() ) {
					echo '<div class="post-media">';
						the_post_thumbnail('medium');
					echo '</div>';
					
				}*/


					echo '<header class="post-header">';
					echo '<h1 class="page-title" > ';
					echo the_field('perfume_name');
					echo '  </h1>';
					echo '</header>';


					echo '<div class="post-content">';
					the_content('');

					if (has_post_thumbnail()) {
						echo '<div class="post-media">';
						the_post_thumbnail('medium');
						echo '</div>';
					}

					//echo wp_get_attachment_image( $image= get_field('perfume_photo'), array('400,400') );
					echo '<hr class="solid">'; //line

					echo '<br><h3 style="color:green">General Information</h3>';
					echo '<div class="data_info">';

					echo '<span> Brand :<b>';
					the_field('brand');
					echo '</b></span>';

					echo '<br><span>Year of Release :<b>';
					the_field('year_of_release');
					echo '</b></span>';

					echo '<br><span>Parent company :<b>';
					the_field('parent_company');
					echo '</b></span>';


					$gender = get_field('gender');
					if ($gender == "Male") {
						echo '<br><span>Gender is :<b>Male <i class="fa fa-male"><b></i></span>';
					} elseif ($gender == "Female") {
						echo '<br><span>Gender is :<b>Female  <i class="fa fa-female"></b></i></span>';
					} else {
						echo '<br><span>Gender is :<b> Unisex <i class="fa fa-female"></i>   <i class="fa fa-male"></b></i></span>';
					}

					echo '<br><span> Limited edition :<b>';
					the_field('limited_edition');
					echo '</b></span>';

					echo '<br><span> Availability :<b>';
					the_field('availability');
					echo '</b></span>';

					echo '<br><span> Perfume house :<b>';
					the_field('perfume_house_');
					echo '</b></span>';
					echo '</div>';

					echo '<hr class="solid">'; //line


					echo '<br><h3 style="color:green">Fragrance description</h3>';


					echo '<br><div id="frag_desc">';
					the_field('the_fragrance_description');
					echo '</b></div><br>';



					echo '<hr class="solid">'; //line


					echo '<br><h3 style="color:green">Perfumers & Bottle Designer</h3>';

					echo '<br><table id="customers">';
					echo '<tr>';

					if (empty(get_field('bottle_designer'))) {

						// do no_Thing

					} else {


						echo '<th scope="row">Bottle Designer</th>';
						echo '<td>';
						the_field('bottle_designer');
						echo '</td>';
						echo '</tr>';
					}


					if (empty(get_field('1st_perfumer'))) {

						// do no_Thing

					} else {

						echo '<tr>
							<th scope="row">1st perfumer</th>';
						echo '<td>';
						the_field('1st_perfumer');
						echo '</td>';
						echo '</tr>';
					}

					if (empty(get_field('2nd_perfumer'))) {

						// do no_Thing


					} else {

						echo '<tr>
							<th scope="row">2nd perfumer</th>';
						echo '<td>';
						the_field('2nd_perfumer');
						echo '</td>';
						echo '</tr>';
					}


					if (empty(get_field('3rd_perfumer'))) {

						// do no_Thing


					} else {

						echo '<tr >
							<th scope="row">3rd perfumer</th>';
						echo '<td>';
						the_field('3rd_perfumer');
						echo '</td>';
						echo '</tr>';
					}




					echo '</table>';




					echo '<hr class="solid">'; //line




					//get value of fregrance notes 
					$base = get_field('base_notes');
					$middle = get_field('heart_notes');
					$top = get_field('top_notes');

					echo '
<div class="notespyramid notespyramidb">

                               <ol>
                                    <li>Top Notes

                                        <div>
                                            <ul>';
					echo '<li> ' . $top . '  </li>                       
											</ul>
                                        </div>
                                    </li>


                                    <li>Heart Notes

                                        <div>
                                            <ul>';
					echo '<li>' . $middle . '</li>                                               											
											</ul>
                                        </div>
                                    </li>


                                    <li>Base notes

                                        <div>
                                            <ul>';
					echo '<li>' . $base . '</li>
											</ul>
                                        </div>
                                    </li>
                                </ol>
                            </div>';



					echo '<hr class="solid">'; //line




					echo '<br><h3 style="color:green">& Olfactive family &</h3>';
					echo '<div class="chart-container">';
					echo '<canvas id="myChart" width="400" height="300" ></canvas>';
					echo '</div>';



					/* $olfactive_family_selection=the_field('olfactive_family');
		$olfactive_family_selection_array=array("Floral","Oriental","Woody", "Leather", "Gourmand", "Chypre", "Citrus","Fruity","Green","Aquatic","Fougère","Abstract","Aromatic","Powdery","Amber");*/

					$olfactive_array = get_field('olfactive_family');

					if ($olfactive_array && in_array('Floral', $olfactive_array)) {
						$num1 = 9;
					} else {
						$num1 = 2;
					}


					if ($olfactive_array && in_array('Oriental', $olfactive_array)) {
						$num2 = 9;
					} else {
						$num2 = 2;
					}


					if ($olfactive_array && in_array('Woody', $olfactive_array)) {
						$num3 = 9;
					} else {
						$num3 = 2;
					}


					if ($olfactive_array && in_array('Leather', $olfactive_array)) {
						$num4 = 9;
					} else {
						$num4 = 2;
					}


					if ($olfactive_array && in_array('Gourmand', $olfactive_array)) {
						$num5 = 9;
					} else {
						$num5 = 2;
					}


					if ($olfactive_array && in_array('Chypre', $olfactive_array)) {
						$num6 = 9;
					} else {
						$num6 = 2;
					}


					if ($olfactive_array && in_array('Citrus', $olfactive_array)) {
						$num7 = 9;
					} else {
						$num7 = 2;
					}


					if ($olfactive_array && in_array('Fruity', $olfactive_array)) {
						$num8 = 9;
					} else {
						$num8 = 2;
					}



					if ($olfactive_array && in_array('Green', $olfactive_array)) {
						$num9 = 9;
					} else {
						$num9 = 2;
					}


					if ($olfactive_array && in_array('Aquatic', $olfactive_array)) {
						$num10 = 9;
					} else {
						$num10 = 2;
					}



					if ($olfactive_array && in_array('Fougère', $olfactive_array)) {
						$num11 = 9;
					} else {
						$num11 = 2;
					}


					if ($olfactive_array && in_array('Abstract', $olfactive_array)) {
						$num12 = 9;
					} else {
						$num12 = 2;
					}


					if ($olfactive_array && in_array('Aromatic', $olfactive_array)) {
						$num13 = 9;
					} else {
						$num13 = 2;
					}


					if ($olfactive_array && in_array('Powdery', $olfactive_array)) {
						$num14 = 9;
					} else {
						$num14 = 2;
					}



					if ($olfactive_array && in_array('Amber', $olfactive_array)) {
						$num15 = 9;
					} else {
						$num15 = 2;
					}




					echo '<hr class="solid">'; //line

					echo '<br><h3 style="color:green">& Perfume Media &</h3>';

					if (empty(get_field('video_perfume'))) {
						echo '<span>No Video Submited by user</span>';
					} else {
						$video_perfume = get_field('video_perfume');
						echo '<div class="video_perfume"><video controls height="250" width="400">
			
												<source src="' . $video_perfume . '"
															type="video/webm">
			
													<source src="' . $video_perfume . '"
															type="video/mp4"></video>';
						echo '</div>';
					}


					$im1 = wp_get_attachment_image($image1 = get_field('first_photo'), array('1080', '2220'));
					$im2 = wp_get_attachment_image($image2 = get_field('second_photo'), array('1080', '2220'));
					$im3 = wp_get_attachment_image($image3 = get_field('third_photo'), array('1080', '2220'));
					$im4 = wp_get_attachment_image($image3 = get_field('fourth_image'), array('1080', '2220'));
					$im5 = wp_get_attachment_image($image3 = get_field('fifth_image'), array('1080', '2220'));



					if (empty(get_field('first_photo')) && empty(get_field('second_photo'))) {
						echo 'No Photo Submited by user';
					} else {
						echo '<div id="demo" class="carousel slide" data-ride="carousel">

					 <!-- Indicators -->
					  <ul class="carousel-indicators">
						<li data-target="#demo" data-slide-to="0" class="active"></li>
						<li data-target="#demo" data-slide-to="1"></li>
						<li data-target="#demo" data-slide-to="2"></li>
						<li data-target="#demo" data-slide-to="3"></li>
						<li data-target="#demo" data-slide-to="4"></li>
					  </ul>

					 <!-- The slideshow -->
					  <div class="carousel-inner">
					<div class="carousel-item active">' ?>
						<img class="mfp-img" style="max-height: 699px;" src="'<?php echo $im1 ?><?php
																								echo '</div>

						<div class="carousel-item">' ?>
						  <img class=" mfp-img" style="max-height: 699px;" src="'<?php echo $im2 ?><?php
																									echo '</div>

						<div class="carousel-item">' ?>
						  <img class=" mfp-img" style="max-height: 699px;" src="'<?php echo $im3 ?><?php
																									echo '</div>';

																									if (empty(get_field('fourth_image'))) {
																									} else {
																										echo '
						<div class="carousel-item">' ?> 
						  <img class=" mfp-img" style="max-height: 699px;" src="'<?php echo $im4 ?><?php
																									}
																									echo '</div>';

																									if (empty(get_field('fourth_image'))) {
																									} else {
																										echo '
						<div class="carousel-item">' ?> 
						  <img class=" mfp-img" style="max-height: 699px;" src="'<?php echo $im4 ?><?php
																									}
																									echo '</div>';

																									/*if (empty(get_field('fourth_image'))){
						}
						else{
						'<div class="carousel-item">'?>
						  <img class="mfp-img"  style="max-height: 699px;" src="'<?php echo $im4 ?><?php
						echo '</div>';
						}
						
						if (empty(get_field('fifth_image'))){
						}
						else{
						'<div class="carousel-item">'?>
						  <img class="mfp-img"  style="max-height: 699px;" src="'<?php echo $im4 ?><?php
						echo '</div>';
						}*/

																									'</div>

					  <!-- Left and right controls -->
					  <a class="carousel-control-prev" href="#demo" data-slide="prev">
						<span class="carousel-control-prev-icon"></span>
					  </a>
					  <a class="carousel-control-next" href="#demo" data-slide="next">
						<span class="carousel-control-next-icon"></span>
					  </a>';
																									echo '</div>';
																								} // for if 

																								echo '<hr class="solid">'; //line

																								// Post Pagination
																								$defaults = array(
																									'before' => '<p class="single-pagination">' . esc_html__('Pages:', 'ashe'),
																									'after' => '</p>'
																								);

																								wp_link_pages($defaults);
																								echo '</div>';

																							endwhile; // Loop End

																						endif;

																									?>

		</article>

		<?php get_template_part('templates/single/comments', 'area'); ?>

	</div><!-- .main-container -->

	<?php

	// Sidebar Right
	get_template_part('templates/sidebars/sidebar', 'right');

	?>

</div><!-- .page-content -->

<?php get_footer(); ?>

<!DOCTYPE html>
<head>
	<style>
span.carousel-control-next-icon, span.carousel-control-prev-icon {
background-color: red;
}
		.notespyramidb {
    text-align: center;
    background-image: url(https://ifragranceofficial.com/wp-content/uploads/2021/03/Untitled-2.png);
    background-repeat: no-repeat;
    background-position: center top;
    background-size: 100% 100%;
    padding: 20px 0 20px 0;
}
		.notespyramid ol li {
    font-weight: bold;
    margin-top: 10px;
			  list-style-type: none;

}
		.notespyramid ul li {
    display: inline;
    font-weight: normal;
    border-bottom: 0;
}
		.notespyramid {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
		.notespyramid ol {
		padding-left: 0px;
		}
		
		
		
            .canvasjs-chart-credit {
	        font-size: 0px;
	}
		#frag_desc {
			color: black;
			border-width: 1px;
    		background: honeydew;
			margin: 5px;
		}
		img, iframe, embed {
			display: inline;
   			 margin: 5px;
			line-height: 3;
		}
			div.data_info , div.data_info span {
			border: solid;
    		border-width: 1px;
    		background: honeydew;
    		padding: 4px;
    		line-height: 3;
				width: 25%;
}
		}
		#customers {
		  font-family: Arial, Helvetica, sans-serif;
		  width: auto;
}

		#customers td, #customers th {
		  border: 1px solid #CACACA;
		  padding: 8px;
			border-collapse: collapse;
			text-align: center;
			background-color: honeydew;
		}
		#customers tr:hover {background-color: #ddd;}

		#customers th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  background-color: black;
		  color: #13ee61;
			
		}
		#youtube_link  a {
			color:red;
			border: 1px solid #000000;	
			border-width: 1px;
			padding: 4px;
			line-height: 3;
		}
		 #chartContainer > div > a {
			display: none;
			
		}
		.carousel-inner img {
    width: 100%;
    height: 100%;
  }
		.carousel {
			width: 50%;
			text-align: center; 
			margin-left: 25%;
		}
		.data_info span {
			color: black;
			background-color: white;
		}
		 .video_perfume {
						margin: 5px;
						padding: 5px;
						text-align: center;							
						}
		.video_perfume video {
					  width: 100%;
					  height: auto;
					}




		
		@media only screen and (max-width: 600px) {
						  /* For mobile phones: */
						  div.data_info , div.data_info span{
							width: 100%;
			}
							  .carousel {
							width: 100%;
								  margin-left: 0%;
						}
						img {width:200px}
			}
		
		
		
		
			
	</style>

			
	<script src=" https://canvasjs.com/assets/script/canvasjs.min.js"></script>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
						<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

						<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

						<meta charset="utf-8">
						<meta name="viewport" content="width=device-width, initial-scale=1">

						</head>

						<body>



							<script>
								< script src = "path/to/chartjs/dist/chart.js" >
							</script>
							<script>
								Chart.defaults.global.defaultFontColor = 'red';
								Chart.defaults.global.defaultFontSize = 0;
								Chart.defaults.global.legend.display = false;


								num11 = <?php echo $num1  ?>;
								num12 = <?php echo $num2  ?>;
								num13 = <?php echo $num3  ?>;
								num14 = <?php echo $num4  ?>;
								num15 = <?php echo $num5  ?>;
								num16 = <?php echo $num6  ?>;
								num17 = <?php echo $num7  ?>;
								num18 = <?php echo $num8  ?>;
								num19 = <?php echo $num9  ?>;
								num110 = <?php echo $num10  ?>;
								num111 = <?php echo $num11  ?>;
								num112 = <?php echo $num12  ?>;
								num113 = <?php echo $num13  ?>;
								num114 = <?php echo $num14  ?>;
								num115 = <?php echo $num15  ?>;



								var ctx = document.getElementById('myChart');
								var myChart = new Chart(ctx, {
									type: 'radar',
									data: {
										label: '00',
										labels: ['Floral', 'Oriental', 'Woody', 'Leather', 'Gourmand', 'Chypre', 'Citrus', 'Fruity', 'Green', 'Aquatic', 'Fougère', 'Abstract', 'Aromatic', 'Powdery', 'Amber'],
										datasets: [{
											fontSize: 15,
											data: [num11, num12, num13, num14, num15, num16, num17, num18, num19, num110, num111, num112, num113, num114, num115],
											backgroundColor: [
												'rgba(255, 99, 132, 0.2)',
												'rgba(54, 162, 235, 0.2)',
												'rgba(255, 206, 86, 0.2)',
												'rgba(75, 192, 192, 0.2)',
												'rgba(153, 102, 255, 0.2)',
												'rgba(255, 159, 64, 0.2)',
												'rgba(255, 99, 132, 0.2)',
												'rgba(54, 162, 235, 0.2)',
												'rgba(255, 206, 86, 0.2)',
												'rgba(75, 192, 192, 0.2)',
												'rgba(153, 102, 255, 0.2)',
												'rgba(255, 159, 64, 0.2)',
												'rgba(255, 99, 132, 0.2)',
												'rgba(54, 162, 235, 0.2)',
												'rgba(255, 206, 86, 0.2)',
												'rgba(75, 192, 192, 0.2)',
												'rgba(153, 102, 255, 0.2)',
												'rgba(255, 159, 64, 0.2)'
											],
											borderColor: [
												'rgba(255, 99, 132, 1)',
												'rgba(54, 162, 235, 1)',
												'rgba(255, 206, 86, 1)',
												'rgba(75, 192, 192, 1)',
												'rgba(153, 102, 255, 1)',
												'rgba(255, 159, 64, 1)',
												'rgba(255, 99, 132, 1)',
												'rgba(54, 162, 235, 1)',
												'rgba(255, 206, 86, 1)',
												'rgba(75, 192, 192, 1)',
												'rgba(153, 102, 255, 1)',
												'rgba(255, 159, 64, 1)',
												'rgba(255, 99, 132, 1)',
												'rgba(54, 162, 235, 1)',
												'rgba(255, 206, 86, 1)',
												'rgba(75, 192, 192, 1)',
												'rgba(153, 102, 255, 1)',
												'rgba(255, 159, 64, 1)'
											]


										}]
									},
									options: {
										legend: {
											labels: {
												"fontSize": 12,

											},
											lable: {}
										},

										scale: {

											angleLines: {
												display: true
											},
											ticks: {
												beginAtZero: true
											},
											pointLabels: {
												fontSize: 17,
											}
										}
									},
									plugins: {
										datalabels: {
											font: {
												weight: 'bold',
												size: 20,
											}
										}
									}


								});
							</script>
						</body>

						</html>