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
// $route['business'] = "userinfo/userinfo/index";

//list
$route['getMainMenuNameById'] = "misc/listinfo/getMainMenuNameById";
$route['getSubMenuNameByMainId'] = "misc/listinfo/getSubMenuNameByMainId"; 
$route['getMenuListBySubId'] = "misc/listinfo/getMenuListBySubId"; 
$route['getStoreMarkByStoreId'] = "misc/listinfo/getStoreMarkByStoreId";
$route['getStroeInfoByStoreId'] = "misc/listinfo/stroeInfoByStoreId";
$route['addUserLog'] = "misc/listinfo/addUserLog";
$route['editUserLog'] = "misc/listinfo/addUserLog";


//store
$route['addStore'] = "misc/store/addStore";
$route['editStoreInfo'] = "misc/store/addStore";
$route['getStoreList'] = "misc/listinfo/getStoreList";

//user
$route['createUser'] = "misc/store/createUserInfo";
$route['editUserInfo'] = "misc/store/createUserInfo";
$route['userLogin'] = "misc/userdo/userLogin";


//userdo
$route['doComments'] = "misc/userdo/doComments";
$route['addUserLog'] = "misc/userdo/addUserLog";
$route['editUserLog'] = "misc/userdo/addUserLog";
$route['getUserLog'] = "misc/listinfo/getUserLogByUserId";

//recommend
$route['recommends'] = "misc/userdo/recommends";
$route['getRecommend'] = "misc/listinfo/getRecommendsList";

//comments
$route['getComments'] = "misc/listinfo/getCommentsList";

//collect 
$route['getCollect'] = "misc/listinfo/getCollectList";

//load admin
$route['login'] = "userinfo/userinfo/login";
$route['logout'] = "userinfo/userinfo/logout";
$route['storeList'] = "userinfo/store/storeList";
$route['pass'] = "userinfo/userinfo/pass";
$route['deyn'] = "userinfo/userinfo/deny";


$route['default_controller'] = "userinfo/store/storeList";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */