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


    public function archive() {

        $mainframe = JFactory::getApplication();

        $cids = implode(',', $_REQUEST['cid']);

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('id') . ' IN ( '.$cids.' ) '
        );

        $fields = array(
            $db->quoteName('archive') . ' = 1'
        );

        $query->update('#__recruit_requests');
        $query->set($fields);
        $query->where($conditions);

        //echo($query->__toString()); die;
        $db->setQuery($query);
        $result = $db->execute();

        if ($result) {
            $rows = $this->getRequestByCids($cids);

            for($i=0;$i<count($rows);$i++) {
                $model = $this->getModel('requesthr');
                $user = JFactory::getUser($rows[$i]->created_by);
                $recipient=$user->get('email');

                $body = $model->_bodyRequestCreation($rows[$i]);
                $model->_mail( $body, 'Письмо о закрытии вакансии', $recipient);
            }

            $msg = "Заявка добавлена в архив";
        } else {
            echo "Произошла ошибка во время добавления в архив";
        }

        $mainframe->Redirect('index.php?option=com_recruit&view=requests',$msg);
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
//
//        echo "<pre>";
//        print_r($data); die;
        $isSuperUser = JFactory::getUser()->authorise('core.admin');


        if(!$data['created_by']) {
            $data['created_by'] = JFactory::getUser()->id;
        }

        if($isSuperUser && $data['id'] && $data['employee_id'] && $model->ifRearrangeRequest($data['id'], $data['employee_id'])) {
            if($model->delRecord($data['id'])){
                $data['id'] = '';
            }
        }

        if(!isset($data['manual']) && $isSuperUser) {

            $return = $model->estimate($data['type_id'], $data['employee_id'], $data['typeemployee_id'], $data['count'], $data['start_date'], $data['id'], $data['level_id']);

            $data['estimate_date'] = $return['estimate_date'];
            $data['public_date'] = $return['public_date'];

            $data['manual'] = 0;
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


        // check if ok and display appropriate message.  This can also have a redirect if desired.
        if ($upditem) {

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
        $level_id = JRequest::getString('jform_level_id');


        $model	= $this->getModel('requesthr');
        $result = $model->estimate($type_id, $employee_id, $typeemployee_id, $count, $start_date, $id, $level_id);

        echo json_encode($result);
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
        $array['year'] = date('Y',strtotime($item['public_date']));
        $array['month'] = date('n',strtotime($item['public_date']));
        $array['day'] = date('j',strtotime($item['public_date']));
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
        $array['publish_up'] = date('Y-n-d',strtotime($item['public_date']));
        $array['publish_up2'] = date('Y-m-j',strtotime($item['public_date']));
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
        $array['byyearday'] = date('z',strtotime($item['public_date']));
        $array['bymonth'] = date('n',strtotime($item['public_date']));
        $array['byweekno'] = date('w',strtotime($item['public_date']));
        $array['bymonthday'] = date('j',strtotime($item['public_date']));
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


    public function getRequestByCids($cids) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('*'));
        $query->from('#__recruit_requests');
        $query->where('id IN ('.$cids.')');

        $db->setQuery($query);
        $rows = $db->loadObjectList();

        return $rows;
    }

}