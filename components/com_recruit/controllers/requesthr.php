<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * flexpaper Controller
 */
class RecruitControllerRequesthr extends JControllerForm
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
        $model	= $this->getModel('requesthr');

        // Get the data from the form POST
        $data = JRequest::getVar('jform', array(), 'post', 'array');

        $data['estimate_date'] = $model->estimate($data['type_id'], $data['employee_id'], $data['typeemployee_id'], $data['count']);

        // Now update the loaded data to the database via a function in the model
        $upditem	= $model->updItem($data);

        // check if ok and display appropriate message.  This can also have a redirect if desired.
        if ($upditem) {
            $msg = "Записть успешно сохранена";
        } else {
            echo "Произошла ошибка во время сохранения записи";
        }

        $mainframe->Redirect('index.php?option=com_recruit&view=requests',$msg);
    }

    public function estimate() {

        $type_id = JRequest::getInt('type_id');
        $employee_id = JRequest::getInt('jform_employee_id');
        $typeemployee_id = JRequest::getInt('jform_typeemployee_id');
        $count = JRequest::getInt('jform_count');

        $model	= $this->getModel('requesthr');
        $result = $model->estimate($type_id, $employee_id, $typeemployee_id, $count);

        echo $result;
        exit;
    }

}