<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 					= 'Landing_page_controller/view';
$route['directive/dataGrid1'] 					= 'Landing_page_controller/dataGrid1';
$route['trucking/view'] 						= 'Trucking_controller/view';
$route['shippingline/view'] 					= 'Shipping_line_controller/view';
$route['shippingline/(:num)']['get'] 			= 'Shipping_line_controller/getShippingLines/$1';
$route['shippingline']['post'] 					= 'Shipping_line_controller/postShippingLine';
$route['shippingline/(:num)']['put'] 			= 'Shipping_line_controller/putShippingLine/$1';
$route['shippingline/(:num)']['delete'] 		= 'Shipping_line_controller/deleteShippingLine/$1';
$route['vessel/view'] 							= 'Vessel_controller/view';
$route['vessel/(:num)/(:num)']['get'] 			= 'Vessel_controller/getVessels/$1/$2';
$route['vessel']['post'] 						= 'Vessel_controller/postVessel';
$route['vessel/(:num)']['put'] 					= 'Vessel_controller/putVessel/$1';
$route['vessel/(:num)']['delete'] 				= 'Vessel_controller/deleteVessel/$1';
$route['vesselvoyage/view'] 					= 'Vessel_voyage_controller/view';
$route['vesselvoyage/(:num)/(:num)']['get'] 	= 'Vessel_voyage_controller/getVessels/$1/$2';
$route['vesselvoyage']['post'] 					= 'Vessel_voyage_controller/postVessel';
$route['vesselvoyage/(:num)']['put'] 			= 'Vessel_voyage_controller/putVessel/$1';
$route['vesselvoyage/(:num)']['delete'] 		= 'Vessel_voyage_controller/deleteVessel/$1';
$route['404_override'] 							= '';
$route['translate_uri_dashes'] 					= FALSE;