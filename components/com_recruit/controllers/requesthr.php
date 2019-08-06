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

        $data['estimate_date'] = $model->estimate($data['type_id'], $data['employee_id'], $data['typeemployee_id'], $data['count'], $data['start_date'], $data['id']);

        // Now update the loaded data to the database via a function in the model
        $upditem	= $model->updItem($data);

        include_once(JPATH_ADMINISTRATOR . "/components/com_jevents/jevents.defines.php");

        $cfg = & JEVConfig::getInstance();

        $this->dataModel = new JEventsDataModel("JEventsAdminDBModel");
        $this->queryModel = new JEventsDBModel($this->dataModel);

        $array = $this->generateArray($data);

        $rrule = SaveIcalEvent::generateRRule($array);

        if ($event = SaveIcalEvent::save($array, $this->queryModel, $rrule)) {

            $row = new jIcalEventDB($event);

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

    public function cancel() {

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
        $array['evid'] = 0;
        $array['valid_dates'] = 1;
        $array['title'] = 'Иванов И.И.';
        $array['priority'] = 0;
        $array['jev_creatorid'] = -1;
        $array['ics_id'] = 1;
        $array['catid'] = 10;
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

}