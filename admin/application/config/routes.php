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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/index';
$route['dashboard'] = 'dashboard/index';
$route['check_user'] = 'login/check_user';
$route['logout'] = 'login/logout';

$route['vendors'] = 'vendors';
$route['add_vendor'] = 'vendors/add';
$route['edit_vendor'] = 'vendors/edit_view';
$route['update_vendor'] = 'vendors/updateVendor';
$route['activate_vendor'] = 'vendors/active';

$route['product_category'] = 'productcategory';
$route['add_category'] = 'productcategory/add';
$route['edit_category'] = 'productcategory/edit_view';
$route['update_category'] = 'productcategory/updateCategory';
$route['activate_category'] = 'productcategory/active';

$route['product_color'] = 'productcolor';
$route['add_color'] = 'productcolor/add';
$route['edit_color'] = 'productcolor/edit_view';
$route['update_color'] = 'productcolor/updateColor';
$route['activate_color'] = 'productcolor/active';

$route['product_shape'] = 'productshape';
$route['add_shape'] = 'productshape/add';
$route['edit_shape'] = 'productshape/edit_view';
$route['update_shape'] = 'productshape/updateShape';
$route['activate_shape'] = 'productshape/active';

$route['products'] = 'products';
$route['add_product'] = 'products/add';
$route['edit_product'] = 'products/edit_view';
$route['update_product'] = 'products/updateProduct';
$route['activate_product'] = 'products/active';
$route['update_product_status'] = 'products/changeStatus';

$route['product_image_upload'] = 'products/productImageUpload';
$route['product_image_delete'] = 'products/productImageDelete';





