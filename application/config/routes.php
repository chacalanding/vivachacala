<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['terms-and-conditions'] = 'home/common_pages';
$route['privacy-policy'] = 'home/common_pages';
$route['disclaimer-and-user-policy'] = 'home/common_pages';
$route['review-rules-and-guidelines'] = 'home/common_pages';
$route['about-chacala-mexico'] = 'home/about_us';
// $route['contact-us'] = 'home/contact_us';
$route['chacala-photo-gallery'] = 'home/gallery';
// $route['why-viva-chacala'] = 'home/why_viva_chacala';
$route['chacala-activities'] = 'home/activities';
// $route['team'] = 'home/teams';
$route['reviews'] = 'home/reviews';
$route['dining-in-chacala-mexico'] = 'home/dining';
$route['marina-chacala'] = 'home/marina_chacala';

$route['viva-guest-services'] = 'home/guest_services';
$route['viva-owner-services'] = 'home/owner_services';

$route['viva-beaches'] = 'home/viva_beaches';

$route['community'] = 'home/community';

$route['chacala-maps'] = 'home/chacala_maps';

$route['chacala-vacation-rentals'] = 'rental';
$route['chacala-vacation-rentals/:any'] = 'property/details';

$route['local-chacala-business'] = 'business';
$route['local-chacala-business/:any'] = 'property/details';

$route['chacala-mexico-real-estate'] = 'Real_estate';
$route['chacala-mexico-real-estate/:any'] = 'property/details';

$route['export/calendar/:any'] = 'home/export_calendar';

//$route['404_override'] = '';
$route['404_override'] = 'home/fzfPage';
$route['404'] = 'home/fzfPage';

///////////////// Backend Controller //////////////////////

$adminDirName = str_replace('/','',$this->config->item('admin_directory_name'));
$route["$adminDirName"] = "$adminDirName/home/index";
$route["$adminDirName/profile"] = "$adminDirName/home/profile";
$route["$adminDirName/forgot_password"] = "$adminDirName/home/forgot_password";
$route["$adminDirName/recover_password/:any"] = "$adminDirName/home/recover_password";
$route["$adminDirName/setting/configuration/manage"] = "$adminDirName/home/manage_configuration";
$route["$adminDirName/setting/notification/send"] = "$adminDirName/home/send_notification";
$route["$adminDirName/setting/email_templates/manage"] = "$adminDirName/home/manage_email_templates";
$route["$adminDirName/setting/email_templates/edit"]="$adminDirName/home/edit_email_templates";
$route["$adminDirName/cms/home/welcome"] = "$adminDirName/cms/welcome_content";
/*$route["$adminDirName/sub_admins"] = "$adminDirName/sub_admins/index";
$route["$adminDirName/sub_admins"] = "$adminDirName/sub_admins/delete_guest";*/
$route["$adminDirName/logout"] = "$adminDirName/home/logout";
$route["$adminDirName/logo"] = "$adminDirName/Configuration/logo";

$route['translate_uri_dashes'] = FALSE;
