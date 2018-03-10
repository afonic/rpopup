<?php
/**
 * @copyright	Copyright © 2018 - All rights reserved.
 * @license		GNU General Public License v2.0
 */
defined('_JEXEC') or die;
$app = JFactory::getApplication();
use \Joomla\CMS\Input\Cookie;
if (!class_exists('Mobile_Detect')) {
	require_once JPATH_ROOT.'/modules/mod_rpopup/vendor/Mobile_Detect.php';
}

// Don't run on mobile

$detect = new Mobile_Detect;
if (($params->get('mobile') == '1') && $detect->isMobile()) {
	return; 
}

// Lets get this banner

$db = JFactory::getDbo();

$query = $db->getQuery(true);

$query->select($db->quoteName(array('id', 'name', 'alias' ,'clickurl', 'params', 'state', 'publish_down')));
$query->from($db->quoteName('#__banners'));
$query->where($db->quoteName('id') . ' = '. $params->get('banner'));
$db->setQuery($query);
$banner = $db->loadObject();

// If the banner is unpublished, do nothing

if ($banner->state == 0){
	return;
}

//If the date has passed, do not show
$now = new DateTime;
if ((DateTime::createFromFormat('Y-m-d H:i:s', $banner->publish_down) < $now) && ($banner->publish_down != '0000-00-00 00:00:00')) {
	return;
}

// Check for cookie is enabled
if ($params->get('cookie') == '1') {
	$cookie = new Cookie;
	$closedBefore = $cookie->get('rpopup-'.$banner->id, null);

	// If the user has closed before, skip
	if ($closedBefore == 'true')
	{
	    return;
	}
}

require JModuleHelper::getLayoutPath('mod_rpopup', $params->get('layout', 'default'));