<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'post';


$route['post/view'] = 'post/view'; //it's only sperimental


$route['auth'] = 'auth';
$route['auth/login'] = 'auth/login';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

$route['dashboard'] = 'admin/dashboard'; //index view of dashboard

$route['dashboard/users'] = 'auth'; //view of management user
$route['dashboard/auth/create_user'] = 'auth/create_user';//view of create new user
$route['auth/create_user'] = 'auth/create_user'; //route for create new user
$route['dashboard/auth/edit_user/(:num)'] = 'auth/edit_user/$1'; //view of edit user
$route['dashboard/auth/activate/(:num)'] = 'auth/activate/$1';//route for active new user
$route['dashboard/auth/deactivate/(:num)'] = 'auth/deactivate/$1';//route for deactive new user

$route['dashboard/post'] = 'admin/dashboard/display_post'; //view of management posts
$route['dashboard/post/(:any)'] = 'admin/dashboard/view/$1'; //view of new post
$route['dashboard/editpost/(:num)'] = 'admin/dashboard/edit_post/$1'; //view of edit post

$route['dashboard/createpost'] = 'admin/dashboard/create_post'; //route for create new post
$route['dashboard/editpost'] = 'admin/dashboard/update_post'; //route for update post
$route['dashboard/deletepost/(:num)'] = 'admin/dashboard/delete_post/$1'; //route for delete post

$route['dashboard/category'] = 'admin/dashboard/display_category'; //view of management categories
$route['dashboard/createcategory'] = 'admin/dashboard/create_category'; //route for create category
$route['dashboard/deletecategory/(:num)'] = 'admin/dashboard/delete_category/$1'; //route for delete category

$route['dashboard/media'] = 'admin/image';
$route['image/upload'] = 'admin/image/do_upload';
$route['dashboard/image/fillGallery'] = 'admin/image/fillGallery';
$route['dashboard/image/deleteimg'] = 'admin/image/deleteimg';

$route['p/index'] = 'post'; //route for pagination
$route['p/index/login'] = 'auth/login';
$route['p/index/logout'] = 'auth/logout';
$route['p/index/(:num)'] = 'post';//route for pagination
$route['p/index/(:any)'] = 'post/single/$1';//route for pagination
$route['(:any)'] = 'post/single/$1'; //route for single post

$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */