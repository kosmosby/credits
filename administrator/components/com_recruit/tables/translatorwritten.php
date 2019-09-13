<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Hello Table class
 *
 * @since  0.0.1
 */
class RecruitTableTranslatorwritten extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__recruit_translatorwritten', 'id', $db);
	}

	public function getId($request_id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('id'));
        $query->from('#__recruit_translatorwritten');
        $query->where('request_id = '.$request_id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;

    }

}
