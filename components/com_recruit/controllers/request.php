<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * flexpaper Controller
 */
class RecruitControllerRequest extends JControllerForm
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
        $model	= $this->getModel('request');

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

        $mainframe->Redirect('index.php?option=com_recruit&view=requests',$msg);
    }

    public function delete() {

        $mainframe = JFactory::getApplication();

        $cids = implode(',', $_REQUEST['cid']);

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('ev_id') . ' IN ( SELECT evid FROM #__recruit_requests WHERE ID IN ('.$cids.') ) ',
        );

        $query->delete('#__jevents_vevent');
        $query->where($conditions);

        //echo($query->__toString()); die;
        $db->setQuery($query);
        $result = $db->execute();



        $query = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('id') . ' IN ('.$cids.')'
        );

        $query->delete($db->quoteName('#__recruit_requests'));
        $query->where($conditions);
        $db->setQuery($query);

        $result = $db->execute();


        $query = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('request_id') . ' IN ('.$cids.')'
        );

        $query->delete($db->quoteName('#__recruit_translatorwritten'));
        $query->where($conditions);
        $db->setQuery($query);

        $result = $db->execute();

        $query = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('request_id') . ' IN ('.$cids.')'
        );

        $query->delete($db->quoteName('#__recruit_translatorspoken'));
        $query->where($conditions);
        $db->setQuery($query);

        $result = $db->execute();


        if ($result) {
            $msg = "Записть успешно удалена";
        } else {
            echo "Произошла ошибка во время сохранения записи";
        }
        $mainframe->Redirect('index.php?option=com_recruit&view=requests',$msg);

    }

}