<?php
require_once($_SERVER['DOCUMENT_ROOT']."/dashboard/includes/listing-index.inc.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/form_functions_checkboxes.inc.php");//to display location features
// make sure to free results from recordsets at the end of this PHP page
?>
<!doctype html>
<html class="fixed">
  <head>
    <!-- Basic -->
    <meta charset="UTF-8">
	<title>My Dashboard | Realty Rebel</title>
	<!-- <meta name="keywords" content="Career, Work for Realty Rebel, Work at Realty Rebel, FSBO, For Sale By Owner, Realtor, Real Estate Brokerage Ottawa" /> -->
    <meta name="description" content="Realty Rebel | Empowering the Next Generation of Homeowners" />
    <meta name="author" content="realtyrebel.com" />
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<?php include($_SERVER['DOCUMENT_ROOT']."/dashboard/includes/head.inc.php"); ?>
    <!-- PhotoSwipe Core CSS file -->
    <link rel="stylesheet" href="/dashboard/assets/vendor/photoswipe/css/photoswipe.css">
    <!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
     <link rel="stylesheet" href="/dashboard/assets/vendor/photoswipe/css/default-skin/default-skin.css">
     <!-- PhotoSwipe Core JS file -->
     <script src="/dashboard/assets/vendor/photoswipe/photoswipe.min.js"></script>
     <!-- PhotoSwipe UI JS file -->
     <script src="/dashboard/assets/vendor/photoswipe/photoswipe-ui-default.min.js"></script>
     <!--[if lt IE 9]>
     <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
     <![endif]-->
     <link rel="stylesheet" href="/dashboard/assets/vendor/owl.carousel/assets/owl.carousel.min.css">
     <link rel="stylesheet" href="/dashboard/assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
     <style type="text/css">
	 .my-gallery {
		 width: 100%;
		 float: left;
	}
	.my-gallery img {
		width: 100%;
		height: auto;
	}
	.my-gallery figure {
		display: block;
		float: left;
		margin: 0 5px 5px 0;
		width: 150px;
	}
	.my-gallery figcaption {
		display: none;
	}
     </style>
  </head>
  <body>
    <section class="body">
      <!-- start: header -->
      <?php include($_SERVER['DOCUMENT_ROOT']."/dashboard/includes/header.inc.php"); ?>
      <!-- end: header -->
      <div class="inner-wrapper">
        <!-- start: sidebar -->
        <?php include($_SERVER['DOCUMENT_ROOT']."/dashboard/includes/sidebars/sidebar_listings.inc.php"); ?>
        <!-- end: sidebar -->
        
        <section role="main" class="content-body">
          <header class="page-header">
            <!-- <h2>Listing #<?php //echo $lid; ?></h2> -->
            
            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="/dashboard/index.php">
                    <i class="fa fa-dashboard"></i>
                  </a>
                </li>
                <li><span>Selling</span></li>
                <li><a href="/dashboard/listings.php"><span>My Property Listings</span></a></li>
                <li><a href="/dashboard/listing/index.php?lid=<?php echo $lid; ?>"><span>Listing #<?php echo $lid; ?></span></a></li>
              </ol>
              <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>
          
          <!-- start: page -->
          <div class="row">
            <div class="col-md-6">
            	<a href="../../preview-listing.php?lid=<?php echo $lid;?>" target="new"><button class="btn btn-outline btn-primary btn-xl mb-2"><i class="fa fa-eye fa-lg"></i> Preview Listing #<?php echo $lid;?></button></a>          	
            </div>
          	<div class="col-md-6 text-right">
            	<a href="/dashboard/shop/shop.php?lid=<?php echo $lid;?>" class="btn btn-success btn-outline" role="button"><i class="fa fa-shopping-cart"></i> Buy MLS Listing</a>
            </div>
          </div>
          
          <hr />
          
          <div class="row">
            <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Address</h2>
                  <!-- <p class="panel-subtitle">Notes & Instructions</p> -->
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
<?php
if($rs_listing_address) {
	$row = mysqli_fetch_assoc($rs_listing_address);
	echo $row['streetNumber'] . ' ';
	echo $row['streetName'] . ' ' . $row['streetSuffixName'];
	if(isset($row['streetDirectionID']) && $row['streetDirectionID'] !== '0') {
		echo ' ' . $row['streetDirName'];
	}
	if(isset($row['unitNumber']) && $row['unitNumber'] !== '0') {
		echo ', Suite #' . $row['unitNumber'] . ' ';
	}
	echo ', ' . $row['city'] . ', ' . $row['stateProvinceName'] . ', ' . $row['zipPostalCode'] . ', ' . $row['countryName'];
	echo '<br />';
} else {
	echo 'No results.';
}
?>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
<?php if($rs_listing_address) echo '<a href="/dashboard/listing/listing-address.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>'; ?>
                      </div>
                    </div>                    
                  </div><!-- end class="row" -->
                </div>
              </section>
            </div><!-- end class="col-md-6" -->
            
            <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <h2 class="panel-title">Listing Status</h2>
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-8">
                      <h2 class="panel-title">
<?php
if($rs_listing_status) {
	$row = mysqli_fetch_assoc($rs_listing_status);
	if($row['status'] == '0') {
		echo '<strong class="text-danger">Inactive Listing';
	} elseif($row['status'] == '1') {
		echo '<strong class="text-success">Active Listing';
	} elseif($row['status'] == '2') {
		echo '<strong class="text-warning">Conditionally Sold';
	} elseif($row['status'] == '3') {
		echo '<strong class="text-primary">Sold';
	}
} else {
	echo 'No results.';
}
echo '</strong>';
?>
                      </h2>
                    </div>
                    <div class="col-sm-4">
<?php if($rs_listing_status) echo '<a href="/dashboard/listing/listing-status.php?lid=' . $lid . '"><button class="btn btn-primary">Change Status</button></a>'; ?>
                    </div>
                  </div>
                </div>
              </section>               
            </div><!-- end class="col-md-6" -->
          </div><!-- end class="row" -->
          
          <div class="row">            
            <div class="col-md-12">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Listing Headline, Summary and Description</h2> 
                  <!-- <p class="panel-subtitle">Notes & Instructions</p> -->
                </header>
                <div class="panel-body">
<?php if($rs_listing_desc) $row = mysqli_fetch_assoc($rs_listing_desc);?>
                  
                  <div class="row">
                    <div class="col-sm-11">
                      <div class="form-group">
                            <b>Headline</b>*:
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
<?php if($rs_listing_desc) echo '<a href="/dashboard/listing/listing-description.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>';?>
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
<?php if($rs_listing_desc) echo $row['headline'];?>
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                            <b>Summary Description</b>*:
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
<?php if($rs_listing_desc) echo $row['summary'];?>
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                  
                  <hr/>
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <b>Detailed Description</b>*:
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
<?php if($rs_listing_desc) echo $row['description'];?>
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                                  
                </div><!-- end class="panel-body" -->
              </section>
            </div><!-- end class="col-md-6" -->
          </div><!-- end class="row" -->
          
          <div class="row">
            <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Listing Type</h2> 
                  <!-- <p class="panel-subtitle">Notes & Instructions</p> -->
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
<?php
if($rs_listing_type) {
	$row = mysqli_fetch_assoc($rs_listing_type);
	$start_row = '<div class="row"><div class="col-sm-12">';
	$end_row = '</div></div>';
	
	echo $start_row . '<b>Property Use</b>: ' . $row['property_use'] . $end_row;
	echo $start_row . '<b>Property Type</b>: ' . $row['property_type'] . $end_row;
	echo $start_row . '<b>Income Property</b>: ';
	if($row['income_property'] === '1') {
		echo 'Yes';
	} else echo 'No';
	echo $end_row;
	echo $start_row . '<b>Seasonal Property</b>: ';
	if($row['seasonal_property'] === '1') {
		echo 'Yes';
	} else echo 'No';
	echo $end_row;
} else {
	echo 'No results.';
}
?>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
<?php if($rs_listing_type) echo '<a href="/dashboard/listing/listing-type.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>'; ?>
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                </div>
              </section>
            </div>
            
            <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Listing Price</h2>
                  <p class="panel-subtitle">Click Edit button to add or delete information.</p>
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
<?php
if($rs_listing_price) {
	$row = mysqli_fetch_assoc($rs_listing_price);
	$start_row = '<div class="row"><div class="col-sm-12">';
	$end_row = '</div></div>';
	
	echo $start_row . '<b>Asking Price</b>: ' . '$' . number_format($row['price'],0) . $end_row;
	echo $start_row . '<b>Property Assessment</b>: ';
	if(!empty($row['assessment'])) {
		echo '$' . number_format($row['assessment'],0);
	}
	echo $end_row;
	echo $start_row . '<b>Property Taxes</b>: ';
	if(!empty($row['property_taxes'])) {
		echo '$' . number_format($row['property_taxes'],0);
	}
	echo $end_row;
} else {
	echo 'No results.';
}
?>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
<?php if($rs_listing_price) echo '<a href="/dashboard/listing/listing-price.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>'; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div><!-- end class="row" -->          
          
          <div class="row">
            <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Building Features</h2>
                  <p class="panel-subtitle">Click Edit button to add or delete Building Features.</p>
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
<?php
if($rs_listing_building) {
	$row = mysqli_fetch_assoc($rs_listing_building);
	$start_row = '<div class="row"><div class="col-sm-12">';
	$end_row = '</div></div>';
	
	if($row['year_built'] === '0') {
		echo $start_row . '<b>Year Built</b>: Unknown' . $end_row;
	} else {
		echo $start_row . '<b>Year Built</b>: Approx. ' . $row['year_built'] . $end_row;
	}
	
	echo $start_row . '<b>Bedrooms</b>: ' . $row['bedrooms'] . $end_row;
	echo $start_row . '<b>Bathrooms</b>: ' . $row['bathrooms'] . $end_row;
	
	if(isset($row['floor_levels']) && $row['floor_levels'] !== '0' ) {
		echo $start_row . '<b>Floor Levels</b>: ' . $row['floor_levels'] . $end_row;
	}
	
	echo $start_row . '<b>Basement</b>: ' . $row['basement'] . $end_row;
	echo $start_row . '<b>Foundation</b>: ' . $row['foundation'] . $end_row;
	echo $start_row . '<b>Roof Type</b>: ' . $row['roofing'] . $end_row;
	echo $start_row . '<b>Roof Age</b>: Installed ' . $row['roof_age'] . 'year(s) ago.' . $end_row;
	echo $start_row . show_checkbox_selections('exterior_finishes', $lid) . $end_row;
	echo $start_row . show_checkbox_selections('flooring', $lid) . $end_row;
	echo $start_row . show_checkbox_selections('countertop', $lid) . $end_row;
	echo $start_row . show_checkbox_selections('cabinet', $lid) . $end_row;
	echo $start_row . show_checkbox_selections('heating', $lid) . $end_row;
	echo $start_row . show_checkbox_selections('heating_fuel', $lid) . $end_row;
	echo $start_row . '<b>Air Conditioning</b>: ' . $row['airconditioning'] . $end_row;
	
	if(isset($row['fireplace']) && $row['fireplace'] !== '0' ) {
		echo $start_row . '<b>Fireplace(s)</b>: ' . $row['fireplace'] . $end_row;
		echo $start_row . '<b>Fireplace Fuel</b>: ' . $row['fireplace_type'] . $end_row;
	}
	
	echo $start_row . '<b>Garage</b>: ' . $row['garageType'] . ' ' . $row['garageSize'] . $end_row;
	echo $start_row . show_checkbox_selections('driveway', $lid) . $end_row;
	
	if(isset($row['parking_spaces']) && $row['parking_spaces'] !== '0' ) {
		echo $start_row . '<b>Parking Spaces</b>: ' . $row['parking_spaces'] . $end_row;
	}
	
	echo $start_row . show_checkbox_selections('exterior_features', $lid) . $end_row;
	echo $start_row . show_checkbox_selections('interior_features', $lid) . $end_row;
	echo $start_row . show_checkbox_selections('included_items', $lid) . $end_row;
	
	if(!empty($row['remarks'])) {
		echo $start_row . '<b>Remarks</b>: ' . $row['remarks'] . $end_row;
	}	
}
?>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
<?php if($rs_listing_building) echo '<a href="/dashboard/listing/listing-building-features.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>'; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            
            <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Lot Features</h2> 
                  <p class="panel-subtitle">Notes & Instructions</p>
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">						
<?php
if($rs_listing_lot) {
	$row = mysqli_fetch_assoc($rs_listing_lot);
	$start_row = '<div class="row"><div class="col-sm-12">';
	$end_row = '</div></div>';
	
	if(!empty($row['frontage']) && !empty($row['frontage'])) {//Lot Dimensions
		echo $start_row . '<b>Lot Dimensions</b>: ' . $row['frontage'] . ' ';
		if($row['frontage'] === '1') {echo 'metres';}
		else echo 'foot';
		echo ' frontage x ' . $row['depth'] . ' ';
		if($row['depth'] === '1') {echo 'metres';}
		else echo 'foot';
		echo ' depth' . $end_row;
	}
	if($row['irregular'] === '1') echo $start_row . 'Irregular Shaped Lot' . $end_row;//Lot Irregular?
	if(!empty($row['area'])) echo $start_row . '<b>Lot Area</b>: approx. ' . $row['area'] . $end_row;//Lot Area
	if(!empty($row['zoning'])) echo $start_row . '<b>Zoning</b>: ' . $row['zoning'] . $end_row;//Zoning
	if(!empty($row['water']) && $row['water'] != 'Select') echo $start_row . '<b>Water Supply</b>: ' . $row['water'] . $end_row;//Water Supply
	if(!empty($row['sewer']) && $row['sewer'] != 'Select') echo $start_row . '<b>Sewer Connection</b>: ' . $row['sewer'] . $end_row;//Sewer Connection
	if(!empty($row['remarks'])) echo $start_row . '<b>Remarks</b>: ' . $row['remarks'] . $end_row; else echo 'No information provided.';//Remarks
}
?>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
<?php if($rs_listing_lot) echo '<a href="/dashboard/listing/listing-lot-features.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>'; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Location Features</h2> 
                  <p class="panel-subtitle">Click Edit button to add or delete Location Features.</p>
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12">
                            <?php							
							show_checkbox_selections('religion', $lid);
							show_checkbox_selections('education', $lid);
							show_checkbox_selections('recreation', $lid);
							show_checkbox_selections('health', $lid);
							show_checkbox_selections('transportation', $lid);
							?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <?php echo '<a href="/dashboard/listing/listing-location-features.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>'; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>            
          </div><!-- end class="row" -->
          
          <div class="row">            
            <div class="col-md-12">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Photos</h2> 
                  <!-- <p class="panel-subtitle">Notes & Instructions</p> -->
                </header>
                
                <div class="panel-body">                  
                  
                  <div class="my-gallery" itemscope itemtype="https://schema.org/ImageGallery">
                    
                    <!-- <div class="owl-carousel owl-theme stage-margin" data-plugin-options='{"items": 6, "margin": 10, "loop": false, "nav": true, "dots": false, "stagePadding": 40}'> 
                    <div class="owl-carousel owl-theme manual" id="carousel">-->
                  
                    <?php if($totalRows_rs_listing_photos > 0) { // Show if recordset not empty ?>
                    <?php while($row_rs_listing_photos = mysqli_fetch_assoc($rs_listing_photos)) { ?>
                      <?php 
					  $photo = BASE_URI . 'photos/' . $lid . '/' . $row_rs_listing_photos['image_path'] . '';
					  list($img_width, $img_height, $img_type) = getimagesize($photo);//
					  
					  //echo '<div>';
					  echo '<figure itemprop="associatedMedia" itemscope itemtype="https://schema.org/ImageObject">';
					  echo '<a href="https://' . BASE_URL . 'photos/' . $lid . '/' . $row_rs_listing_photos['image_path'] . '" itemprop="contentUrl" data-size="' . $img_width . 'x' . $img_height . '">';
					  echo '<img class="img-responsive img-rounded" src="https://' . BASE_URL . 'photos/' . $lid . '/thumbs/' . $row_rs_listing_photos['image_path'] . '" itemprop="thumbnail" alt="Image description" />';
					  echo '</a>';
					  echo '<figcaption itemprop="caption description">' .  $row_rs_listing_photos['caption'] . '</figcaption>';
					  echo '</figure>';
					  //echo '</div>';
					  /* Possible image types for PHP function getimagesize()
					  1 = GIF
					  2 = JPG
					  3 = PNG
					  4 = SWF
					  5 = PSD
					  6 = BMP
					  7 = TIFF(intel byte order)
					  8 = TIFF(motorola byte order)
					  9 = JPC
					  10 = JP2
					  11 = JPX
					  12 = JB2
					  13 = SWC
					  14 = IFF
					  15 = WBMP
					  16 = XBM
					  */
					  
					  ?>
                    <?php } ?>
                  <?php } // Show if recordset not empty ?>
                  <!-- </div> -->
                  </div>                
                  
                  
                  
                  
                  <!-- Root element of PhotoSwipe. Must have class pswp. -->
                  <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                    
                    <!-- Background of PhotoSwipe. It's a separate element, as animating opacity is faster than rgba(). -->
                    <div class="pswp__bg"></div>
                    
                    <!-- Slides wrapper with overflow:hidden. -->
                    <div class="pswp__scroll-wrap">
                      
                      <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                      <div class="pswp__container">
                        
                        <!-- don't modify these 3 pswp__item elements, data is added later on -->
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                      </div>
                      
                      <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                      <div class="pswp__ui pswp__ui--hidden">
                        
                        <div class="pswp__top-bar">
                          
                          <!--  Controls are self-explanatory. Order can be changed. -->
                          <div class="pswp__counter"></div>
                          
                          <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>                          
                          <button class="pswp__button pswp__button--share" title="Share"></button>                          
                          <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>                          
                          <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                          
                          <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                          <!-- element will get class pswp__preloader--active when preloader is running -->
                          <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                              <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                          <div class="pswp__share-tooltip"></div>
                        </div>
                        
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>                        
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                        
                        <div class="pswp__caption">
                          <div class="pswp__caption__center"></div>
                        </div>
                      </div>                      
                    </div>
                  </div>

                </div><!-- end class="panel-body" -->
                <footer class="panel-footer">
                  <?php echo '<a href="/dashboard/listing/listing-images.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>';?>
                </footer>
              </section>
            </div><!-- end class="col-md-6" -->
          </div><!-- end class="row" -->
          
          <div class="row">
            <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  </div>
                  <h2 class="panel-title">Room Dimensions</h2> 
                  <p class="panel-subtitle">Add rooms by clicking Edit button below</p>
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
                      	<table class="table table-striped">
                  	<thead>
                    	<tr>
                      	<th class="col-sm-2">Level</th>
                        <th class="col-sm-4">Name</th>
                        <th class="col-sm-1">Length</th>
                        <th class="col-sm-1"></th>
                        <th class="col-sm-1">Width</th>
                      </tr>
                    </thead>
                    <tbody>
<?php

	
	if (mysqli_more_results($db_listings)) mysqli_next_result($db_listings);		
		
	// Get listing address fields from database
	$q = "SELECT lr.id, lr.name, lr.length_feet, lr.length_inch, lr.width_feet, lr.width_inch, fl.name AS floor_level
	FROM listingrooms AS lr
	INNER JOIN select_floor_level AS fl
		ON lr.floor_levelID = fl.id 
	WHERE listing_id = '$lid' 
	ORDER BY lr.sort_order ASC";
	$rs_listing_rooms = mysqli_query($db_listings, $q);
	
	$totalRows = mysqli_num_rows($rs_listing_rooms);
	for ($i = 0; $i < $totalRows; ++$i) {
		$row = mysqli_fetch_assoc($rs_listing_rooms);
		echo '<tr>
		<td class="col-sm-2">'.$row['floor_level'].'</td>
		<td class="col-sm-4">'.$row['name'].'</td>
		<td class="col-sm-1">'.$row['length_feet'].'\' - '.$row['length_inch'].'"</td>
		<td class="col-sm-1">x</td>
		<td class="col-sm-1">'.$row['width_feet'].'\' - '.$row['width_inch'].'"</td>
		</tr>';
	}	
?>
                    </tbody>
                  </table>
                      
                      </div>
                    </div>
                  </div><!-- end class="row" -->
                </div>
                <footer class="panel-footer">
<?php if($rs_listing_type) echo '<a href="/dashboard/listing/listing-rooms.php?lid=' . $lid . '"><button class="btn btn-primary">Edit</button></a>'; ?>
                </footer>
              </section>
            </div>
            
          </div>
          
          <!-- end: page -->
        </section><!-- end class="content-body" -->
      </div>
      
      <?php include($_SERVER['DOCUMENT_ROOT']."/dashboard/includes/right_sidebar.inc.php"); ?>
    </section><!-- end class="body" -->
    <?php include($_SERVER['DOCUMENT_ROOT']."/dashboard/includes/javascript.inc.php"); ?>
    <script src="/dashboard/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/dashboard/js/examples.carousels.js"></script>
    <script src="/dashboard/js/examples.gallery.js"></script>
<script type="text/javascript">

var initPhotoSwipeFromDOM = function(gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements 
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes 
            if(figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML; 
            }

            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            } 

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) { 
                continue; 
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');  
            if(pair.length < 2) {
                continue;
            }           
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)

        options = {

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect(); 

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }

        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used 
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};

// execute above function
initPhotoSwipeFromDOM('.my-gallery');

</script>
  </body>
</html>
<?php
if (isset($rs_listing_address)) mysqli_free_result($rs_listing_address);
if (isset($rs_listing_type)) mysqli_free_result($rs_listing_type);
if (isset($rs_listing_price)) mysqli_free_result($rs_listing_price);
if (isset($rs_listing_building)) mysqli_free_result($rs_listing_building);
if (isset($rs_listing_lot)) mysqli_free_result($rs_listing_lot);
if (isset($rs_listing_desc)) mysqli_free_result($rs_listing_desc);
if (isset($rs_listing_checkboxes)) mysqli_free_result($rs_listing_checkboxes);
?>