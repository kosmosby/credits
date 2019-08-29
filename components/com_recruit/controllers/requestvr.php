<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * flexpaper Controller
 */
class RecruitControllerRequestvr extends JControllerForm
{

    public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, array('ignore_request' => false));
    }

    public function submit()
    {

        $mainframe = JFactory::getApplication();

        // Check for request forgeries.
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables.
        $app	= JFactory::getApplication();
        $model	= $this->getModel('requesthr');

        // Get the data from the form POST
        $data = JRequest::getVar('jform', array(), 'post', 'array');

        $model = $this->getModel('requesthr');


        $isSuperUser = JFactory::getUser()->authorise('core.admin');
        if(!$isSuperUser) {
            $data['created_by'] = JFactory::getUser()->id;
        }

        if(!isset($data['manual']) && $isSuperUser) {
            $return  = $model->estimate($data['type_id'], $data['employee_id'], $data['typeemployee_id'], $data['count'], $data['start_date'], $data['id'], $data['level_id']);

            $data['estimate_date'] = $return['estimate_date'];
            $data['public_date'] = $return['public_date'];

            $data['manual'] = 0;
        }

        if($isSuperUser && $model->ifRearrangeRequest($data['id'], $data['employee_id'])) {
            if($model->delRecord($data['id'])){
                $data['id'] = '';
            }
        }


        /*
        include_once(JPATH_ADMINISTRATOR . "/components/com_jevents/jevents.defines.php");

        $cfg = & JEVConfig::getInstance();

        $this->dataModel = new JEventsDataModel("JEventsAdminDBModel");
        $this->queryModel = new JEventsDBModel($this->dataModel);

        $array = $this->generateArray($data);

        $rrule = SaveIcalEvent::generateRRule($array);

        if ($event = SaveIcalEvent::save($array, $this->queryModel, $rrule)) {

            $row = new jIcalEventDB($event);

            if($event->ev_id) {
                $data['evid'] = $event->ev_id;
            }
        }
        */

        // Now update the loaded data to the database via a function in the model
        $upditem	= $model->updItem($data);

        if(!$isSuperUser) {
            $user = JFactory::getUser(928);
            $recipient=$user->get('email');

            $body = $model->_bodyRequestCreation($upditem);
            $model->_mail( $body, 'Запрос на размещение заявки', $recipient);
        }

        if($isSuperUser && isset($data['employee_id'])) {


            $user = JFactory::getUser($data['created_by']);
            $recipient_created_by=$user->get('email');

            $user = JFactory::getUser($model->getEmployeeUser_id($data['employee_id']));
            $recipient_assign_to=$user->get('email');

            $recipient = array( $recipient_created_by, $recipient_assign_to);

            $body = $model->_bodyRequestCreation($upditem);
            $model->_mail( $body, 'Присвоение исполнителя на заявку', $recipient);


        }

        // check if ok and display appropriate message.  This can also have a redirect if desired.
        if ($upditem) {
            $msg = "Записть успешно сохранена";
        } else {
            echo "Произошла ошибка во время сохранения записи";
        }

        $mainframe->Redirect('index.php?option=com_recruit&view=requests',$msg);
    }

    public function estimate() {

        $id = JRequest::getInt('jform_id');
        $type_id = JRequest::getInt('type');
        $employee_id = JRequest::getInt('jform_employee_id');
        $typeemployee_id = JRequest::getInt('jform_typeemployee_id');
        $count = JRequest::getInt('jform_count');
        $start_date = JRequest::getString('jform_start_date');


        $model	= $this->getModel('requesthr');
        $result = $model->estimate($type_id, $employee_id, $typeemployee_id, $count, $start_date, $id);

        echo $result;
        exit;
    }

    public function cancel($key = NULL) {

        $mainframe =& JFactory::getApplication();
        $mainframe->Redirect('index.php?option=com_recruit&view=requests');

    }

    function generateArray($item) {

//        echo "<pre>";
//        print_r($item); die;

        $u =& JURI::getInstance( JURI::base() );
        //$u->setScheme( 'https' );

        $array['jevtype'] = 'icaldb';
        $array['rp_id'] = -1;
        $array['year'] = date('Y',strtotime($item['start_date']));
        $array['month'] = date('n',strtotime($item['start_date']));
        $array['day'] = date('j',strtotime($item['start_date']));
        $array['state'] = 1;
        $array['evid'] = $item['evid'];
        $array['valid_dates'] = 1;
        $array['title'] = $this->getEmployee($item['employee_id']). ' ' .strip_tags($item['description']);
        $array['priority'] = 0;
        $array['jev_creatorid'] = -1;
        $array['ics_id'] = 1;
        $array['catid'] = $this->getjEventsCategory($item['type_id']);
        $array['access'] = 1;

        $array['jevcontent'] = '';
        //$array['location'] = JRoute::_($u->toString().'index.php?option=com_videotranslation&view=session&ses_id='.$session->getId());
        $array['location'] = '';

        $array['contact_info'] = '';
        $array['extra_info'] = '' ;
        $array['view12Hour'] = 0;
        $array['publish_up'] = date('Y-n-d',strtotime($item['start_date']));
        $array['publish_up2'] = date('Y-m-j',strtotime($item['start_date']));
        $array['start_time'] = '00:00';
        $array['start_12h'] = '00:00';
        $array['start_ampm'] = 'none';
        $array['publish_down'] = date('Y-n-d',strtotime($item['estimate_date']));
        $array['publish_down2'] = date('Y-m-j',strtotime($item['estimate_date']));
        $array['end_time'] = '23:59';
        $array['end_12h'] = '23:59';
        $array['end_ampm'] = 'none';
        $array['multiday'] = 1;
        $array['freq'] = 'none';
        $array['rinterval'] = 1;
        $array['countuntil'] = 'count';
        $array['count'] = 1;
        $array['until'] = date('Y-n-d',strtotime($item['estimate_date']));
        $array['until2'] = date('Y-m-j',strtotime($item['estimate_date']));
        $array['byyearday'] = date('z',strtotime($item['start_date']));
        $array['bymonth'] = date('n',strtotime($item['start_date']));
        $array['byweekno'] = date('w',strtotime($item['start_date']));
        $array['bymonthday'] = date('j',strtotime($item['start_date']));
        $array['weekdays'] = array(0=>0);
        $array['boxchecked'] = 0;
        $array['updaterepeats'] = 0;
//        $array['jevcontent'] = '';
//        $array['jevcontent'] = '';
//        $array['jevcontent'] = '';
//        $array['jevcontent'] = '';

//                echo "<pre>";
//        print_r($array); die;

        return $array;
    }


    public function getjEventsCategory($type_id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('cat_id'));
        $query->from('#__recruit_types');
        $query->where('id = '.$type_id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }

    public function getEmployee($employee_id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('name'));
        $query->from('#__recruit_employee');
        $query->where('id = '.$employee_id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }


}