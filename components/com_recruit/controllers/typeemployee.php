<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * flexpaper Controller
 */
class RecruitControllerTypeemployee extends JControllerForm
{

    public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, array('ignore_request' => false));
    }

    public function submit()
    {
        $mainframe =& JFactory::getApplication();

        // Check for request forgeries.
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables.
        $app	= JFactory::getApplication();
        $model	= $this->getModel('typeemployee');

        // Get the data from the form POST
        $data = JRequest::getVar('jform', array(), 'post', 'array');

        // Now update the loaded data to the database via a function in the model
        $upditem	= $model->updItem($data);

        // check if ok and display appropriate message.  This can also have a redirect if desired.
        if ($upditem) {
            $msg = "Записть успешно сохранена";
        } else {
            echo "Произошла ошибка во время сохранения записи";
        }

        $mainframe->Redirect('index.php?option=com_recruit&view=typeemployees',$msg);
    }

}