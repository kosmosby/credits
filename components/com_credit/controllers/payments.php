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

class CreditControllerPayments extends JControllerAdmin
{
	public function getModel($name = 'Payments', $prefix = 'CreditModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

    public function publish () {

        echo "<pre>";
        print_r($_REQUEST); die;

        $task = JRequest::getVar('task');
        if($task == 'unpublish') {
            $this->unpublish();
        }
        else {

            $mainframe =& JFactory::getApplication();

            $data = JRequest::getVar('cid',  0, '');

            $model	= $this->getModel('payments');
            $upditem	= $model->updItem($data);

            $request_string = explode(',',$data[0]);

            $id= $request_string[0];

            // check if ok and display appropriate message.  This can also have a redirect if desired.
            if ($upditem) {
                $msg = "Записть успешно обновлена";
            } else {
                echo "Произошла ошибка во время обновления записи";
            }

            $mainframe->Redirect('index.php?option=com_credit&view=payments&id='.$id,$msg);
        }
    }

    public function unpublish() {

        $mainframe =& JFactory::getApplication();

        $data = JRequest::getVar('cid',  0, '');

//        echo "<pre>";
//        print_r($data); die;

        $model	= $this->getModel('payments');
        $upditem	= $model->deleteItem($data);

        $request_string = explode(',',$data[0]);

        $id= $request_string[0];

        // check if ok and display appropriate message.  This can also have a redirect if desired.
        if ($upditem) {
            $msg = "Записть успешно обновлена";
        } else {
            echo "Произошла ошибка во время обновления записи";
        }

        $mainframe->Redirect('index.php?option=com_credit&view=payments&id='.$id,$msg);

    }
}
