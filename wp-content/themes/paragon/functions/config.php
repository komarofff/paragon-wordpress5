<?php

define('HOME', 'Главная');

$property_status = [
  '1' => 'Active',
  '2' => 'Pending',  
];

$property_type = [
  '1' => 'Multi-family',
  '2' => 'Land',
  '3' => 'Office',
  '4' => 'Retail',
  '5' => 'Industrial',
];

if ( is_user_logged_in() ) {
    show_admin_bar(true);
}
$keyAPI = 'KEY';

function show_map(){
  global  $keyAPI;
    echo '
    <script  src="https://maps.googleapis.com/maps/api/js?key='.$keyAPI.'&callback=initMap&v=weekly"  async></script>
    ';
}

$linkedin_link='https://www.linkedin.com/company/paragon-real-estate-advisors-inc/';
$instagram_link = 'https://www.instagram.com/paragonrealestateadvisors/';
$post_mail = 'Info@ParagonREA.com';