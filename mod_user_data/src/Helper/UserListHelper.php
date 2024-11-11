<?php
namespace Joomla\Module\ModUserList\Site\Helper;

use Joomla\CMS\Factory;

class UserListHelper {

    // Fetch users based on selected groups and return user data
    public static function getFilteredUsers($params) {

        // Check if $params is an object and has a get method
        if (!is_object($params) || !method_exists($params, 'get')) {
            Factory::getApplication()->enqueueMessage('Invalid parameters passed. Expected Joomla Registry object.', 'error');
            return [];
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select(['u.id', 'u.name', 'u.username', 'u.email', 'u.registerDate', 'u.lastvisitDate', 'ug.title AS usergroup'])
            ->from($db->quoteName('#__users', 'u'))
            ->join('LEFT', $db->quoteName('#__user_usergroup_map', 'map') . ' ON u.id = map.user_id')
            ->join('LEFT', $db->quoteName('#__usergroups', 'ug') . ' ON map.group_id = ug.id');

        // Get selected user groups (ensure it's an array)
        $selectedGroups = $params->get('user_groups', []);
        if (!empty($selectedGroups) && is_array($selectedGroups)) {
            $query->whereIn('ug.id', $selectedGroups);
        }

        try {
            $db->setQuery($query);
            $users = $db->loadObjectList();

            // If no users found, return an empty array or handle the case
            if (empty($users)) {
                return [];
            }

            return $users;

        } catch (\RuntimeException $e) {
            // Handle errors gracefully
            Factory::getApplication()->enqueueMessage('Error fetching users: ' . $e->getMessage(), 'error');
            return [];
        }
    }
}

?>