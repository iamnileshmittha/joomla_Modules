<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\ModUserList\Site\Helper\UserListHelper; 

// Include the helper file to fetch and filter users
require_once __DIR__ . '/src/Helper/UserListHelper.php';

// Get the parameters and current user
$params = is_object($module->params) ? $module->params : new Joomla\Registry\Registry();

// Get the current user
$user = Factory::getUser();

// Access Control: Only show module to users from allowed groups
$allowedGroups = $params->get('restrict_access', []);
if (!array_intersect($user->getAuthorisedGroups(), $allowedGroups)) {
    return; // If the user is not in allowed groups, return early and don't display the module
}


// Get filtered users based on the configuration
$userList = UserListHelper::getFilteredUsers($params);

// Include the layout file to render the user list
require ModuleHelper::getLayoutPath('mod_user_list');

?>
