<?php

/**
 * @package		Joomla.Tutorials
 * @subpackage	Component
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;

//jimport('joomla.application.component.controlleradmin');

class RecruitControllerLocations extends JControllerAdmin
{
	public function getModel($name = 'Locations', $prefix = 'RecruitModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

    public function delete() {

        $mainframe = JFactory::getApplication();

        $cids = implode(',', $_REQUEST['cid']);

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('id') . ' IN ('.$cids.')  ',
        );

        $query->delete('#__recruit_locations');
        $query->where($conditions);

        //echo($query->__toString()); die;
        $db->setQuery($query);
        $result = $db->execute();


        if ($result) {
            $msg = "Записть успешно удалена";
        } else {
            echo "Произошла ошибка во время сохранения записи";
        }
        $mainframe->Redirect('index.php?option=com_recruit&view=locations',$msg);

    }

}
