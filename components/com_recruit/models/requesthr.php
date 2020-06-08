<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */

//jimport('joomla.application.component.modelitem');

class RecruitModelRequesthr extends JModelAdmin
{
	/**
	 * @var object item
	 */
	protected $item;

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	2.5
	 */
	protected function populateState()
	{
		// Get the message id
		$jinput = JFactory::getApplication()->input;
		$id     = $jinput->get('id', 1, 'INT');
		$this->setState('requesthr.id', $id);

		// Load the parameters.
		$this->setState('params', JFactory::getApplication()->getParams());
		parent::populateState();
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'Requests', $prefix = 'RecruitTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
//	public function getItem()
//	{
//
////        echo "<pre>";
////        print_r($_REQUEST); die;
//
//        if (!isset($this->_item))
//        {
//            $cache = JFactory::getCache('com_credit', '');
//            $id = $this->getState('credit.id');
//            $this->_item =  $cache->get($id);
//            if ($this->_item === false) {
//
//            }
//        }
//
//
////        echo "<pre>";
////        print_r($this->_item); die;
//
//        return $this->_item;
//
//	}

    /**
     * Method to get the record form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed    A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {

        // Get the form.
        $form = $this->loadForm(
            'com_recruit.requesthr',
            'requesthr',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
            'com_recruit.edit.requesthr.data',
            array()
        );

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }


    public function updItem($data)
    {
        $row = JTable::getInstance('Requests', 'RecruitTable');


//        echo "<pre>";
//        print_r($data); die;

        if(!$row->bind($data))
        {
            JError::raiseError(500, $row->getError() );
            return false;
        }
        if(!$row->store()){
            JError::raiseError(500, $row->getError() );
            return false;
        }


//        echo "<pre>";
//        print_r($row); die;
        return $row;

    }

    public function estimate($type_id,$jform_employee_id,$jform_typeemployee_id, $jform_count_employee, $start_date, $id, $level_id) {

        if($id && $jform_employee_id) {
            if ($this->ifRearrangeRequest($id, $jform_employee_id)) {
                $id = '';
            }
        }

        $db = JFactory::getDbo();

        $estimate_date = '';

        $public_date = $start_date;


        switch ($type_id) {
            case 1:
                $prev_date = $this->findPreviousRequest($jform_employee_id, $id, $start_date, $type_id);



                if(count((array)$prev_date)) {



                    $half_all_count_days = (strtotime($prev_date->estimate_date) - strtotime($prev_date->public_date))/2;
                    $count_days = round($half_all_count_days/60/60/24);

                    $half_date = strtotime($prev_date->public_date."+".$count_days." days");

                    if(strtotime($start_date) < $half_date) {
                        $start_date_seconds = strtotime($prev_date->public_date."+".$count_days." days");
                        $public_date = date("Y-m-d", $start_date_seconds);
                    }
                }

//                echo "<pre>";
//                print_r(count((array)$prev_date)); die;

                $query = $db->getQuery(true);
                $query->select(array('norm'));
                $query->from('#__recruit_norms');
                $query->where('typeemployee_id = '.$jform_typeemployee_id);


                $db->setQuery($query);
                $norm = $db->loadResult();

                $index = $jform_count_employee - 1;
                $days = $norm * 7 + ($norm*7)/2 * $index;

                $estimate_date = date("Y-m-d", strtotime($public_date.'+'.$days.' days'));

            break;
            case 2:
                $prev_date = $this->findPreviousRequest($jform_employee_id, $id, $start_date, $type_id);


                if(count($prev_date)) {
                    $half_all_count_days = (strtotime($prev_date->estimate_date) - strtotime($prev_date->public_date))/2;
                    $count_days = round($half_all_count_days/60/60/24);

                    $half_date = strtotime($prev_date->public_date."+".$count_days." days");

                    if(strtotime($start_date) < $half_date) {
                        $start_date_seconds = strtotime($prev_date->public_date."+".$count_days." days");
                        $public_date = date("Y-m-d", $start_date_seconds);
                    }
                }

                $query = $db->getQuery(true);
                $query->select(array('point'));
                $query->from('#__recruit_levels');
                $query->where('id = '.$level_id);
                $db->setQuery($query);
                $point = $db->loadResult();

                $index = round((($jform_count_employee-1)*$point)/2);

                if($this->ifTranslationSpoken()) {
                    $days = $this->translationSpokenDays($point, $index, $level_id);
                }
                else {
                    $days = 3 + $point + $index;
                }

                $estimate_date = date("Y-m-d", strtotime($public_date.'+'.$days.' weekdays'));

            break;

            default:
                $estimate_date = '';
        }

        $arr = array();
        $arr['public_date'] = $public_date;
        $arr['estimate_date'] = $estimate_date;


        return $arr;
    }

    public function translationSpokenDays($point, $index, $level_id) {

        $data = JRequest::getVar('translatorspoken', array(), 'post', 'array');

        $additionDays = $this->translationSpokenAdditionDays($data['locationoptions']);

        $additionPoints = $this->traslationSpokenAdditionPoints($level_id);

        $days = $additionDays + $point + $index + $additionPoints;

        return $days;
    }

    public function traslationSpokenAdditionPoints($id) {

        if($id) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(array('	addition_points'));
            $query->from('#__recruit_levels');
            $query->where('id = ' . $id);
            $db->setQuery($query);
            $row = $db->loadResult();

            return $row;
        }
        else {
            return 0;
        }

    }

    public function translationSpokenAdditionDays($id) {

        if($id) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(array('addition_days'));
            $query->from('#__recruit_locations');
            $query->where('id = ' . $id);
            $db->setQuery($query);
            $row = $db->loadResult();

            return $row;
        }
        else {
            return 0;
        }

    }

    public function ifTranslationSpoken() {

        $data = JRequest::getVar('translatorspoken', array(), 'post', 'array');

        if (count($data)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function ifRearrangeRequest ($id, $employee_id) {


        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('employee_id'));
        $query->from('#__recruit_requests');
        $query->where('id = '.$id);
        $db->setQuery($query);
        $row = $db->loadResult();

        if($row != $employee_id) {
            return true;
        }
        else {
            return false;
        }
    }

    public function delRecord($id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $conditions = array(
            $db->quoteName('id') . ' = '.$id
        );

        $query->delete($db->quoteName('#__recruit_requests'));
        $query->where($conditions);

        $db->setQuery($query);

        $result = $db->execute();

        return $result;
    }


    public function findPreviousRequest ($employee_id, $id, $start_date, $type_id) {

        //echo $employee_id; die;

        $row = array();
        if($employee_id && $type_id) {

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(array('id', 'public_date', 'estimate_date'));
            $query->from('#__recruit_requests');
            $query->where('employee_id = ' . $employee_id);
            //$query->where('start_date <= \''.$start_date.'\'');
            //$query->where('estimate_date >= \''.$start_date.'\'');
            $query->where('type_id = \'' . $type_id . '\'');

            //echo $query->__toString(); die;

            if ($id) {
                $query->where('id < ' . $id);
            }

            $query->order('id DESC ');
            $query->setlimit(1);
            $db->setQuery($query);
            $row = $db->loadObject();
        }

//        echo "<pre>";
//        print_r($row); die;

        return $row;
    }

    public function _mail( $body, $subject, $recipient) {

        $mailer = JFactory::getMailer();

        $config = JFactory::getConfig();
        $sender = array(
            $config->get( 'mailfrom' ),
            $config->get( 'fromname' )
        );

        $mailer->setSender($sender);

//        $user = JFactory::getUser();
//        $recipient = $user->email;


        $mailer->isHtml(true);
        $mailer->addRecipient($recipient);

        //$body   = "Your body string\nin double quotes if you want to parse the \nnewlines etc";
        $mailer->setSubject($subject);
        $mailer->setBody($body);

        $send = $mailer->Send();
        if ( $send !== true ) {
            echo 'Error sending email: ';
        } else {
            echo 'Mail sent';
        }

    }


    public function _bodyRequestCreation($data) {

        $str = '';

        $str .= "Запрос от ".JFactory::getUser()->name."<br/><br />";

        if(isset($data->type_id) && $data->type_id) {
            $str .= "тип заявки: " . $this->getTypebyId($data->type_id) . "<br/>";
        }

//        if($data->type_id == 1) {
            $str .= "позиция: " . $this->getTypeEmployebyId($data->typeemployee_id) . "<br/>";
//        }
        if($data->employee_id) {
            $str .= "исполнитель: " . $this->getEmployeeName($data->employee_id) . "<br/>";
        }

        if($data->start_date != '0000-00-00') {
            $str .= "дата открытия: ".$data->start_date."<br/>";
        }
        $str .= "Название: ".$data->name."<br/>";
        $str .= "Подразделение: ".$this->getDepartment($data->department)."<br/>";
        $str .= "Руководитель подразделения: ".$data->department_head."<br/>";
        $str .= "Подчиненные: ".$data->subordinates."<br/>";
        $str .= "Локация (регион): ".$data->location."<br/>";
        $str .= "Офис/удаленно: ".$data->office_remote."<br/>";
        $str .= "Тип вакансии: ".$data->vacancy_type."<br/>";
        $str .= "Причина открытия вакансии: ".$data->reason_open."<br/>";
        $str .= "Наличие вакансии в штатном расписании: ".$data->available_staff_list."<br/>";
        $str .= "Предположительная дата выхода на работу: ".$data->estimate_date."<br/>";
        $str .= "Количество сотрудников: ".$data->count."<br/>";
        $str .= "Образование : ".$data->education."<br/>";
        $str .= "Опыт работы: ".$data->experience."<br/>";
        $str .= "Профессиональные навыки/компетенции: ".$data->сompetencies."<br/>";

        $str .= "Иностранные языки: ".$data->foreign_languages."<br/>";
        $str .= "Знание специализированного ПО: ".$data->special_software."<br/>";
        $str .= "Основные обязанности: ".$data->information."<br/>";
        $str .= "Особые факторы работы (командировки, переработки, переезд): ".$data->description."<br/>";
        $str .= "заработная плата на испытательный срок: ".$data->probationary_salary."<br/>";
        $str .= "заработная плата постоянная: ".$data->salary."<br/>";
        $str .= "бонусы/проценты: ".$data->bonuses_interest."<br/>";
        $str .= "приоритетность: ";
        $str .= (!$data->priority)?"нормальная<br/>":"высокая<br/>";




//        $str .= "описание задачи: ".$data->description."<br/>";
        //$str .= "приоритетность: ";
        //$str .= (!$data->priority)?"нормальная<br/>":"высокая<br/>";



        if($data->type_id == 2) {
            $str .= "тип переводчика: ".$this->getTypeInterpreterbyId($data->interpreter_type)."<br/>";
        }

//        if($data->start_date != '0000-00-00' && $data->estimate_date != '0000-00-00') {
//            $str .= "дата размещения заявки: ".$data->start_date."<br/>";
//            $str .= "дата окончания заявки: ".$data->estimate_date."<br/>";
//        }


        if(!$data->employee_id) {
            $uri =JURI::base();
            $type=($data->type_id==1)?"requesthr":"requestvr";
            $uri .= 'index.php?option=com_recruit&view=' . $type . '&layout=edit&id=' . $data->id;
            $str .= "ссылка на заявку: <a href='" . $uri . "' target='_blank'>" . $uri . "</a>";
        }


//        echo "<pre>";
//        print_r($str); die;

        return $str;
    }

    public function getFullForm($loadData) {

//        echo "<pre>";
//        print_r($loadData);
//        echo "</pre>";
//        die;
        // Get the form.
        $form = $this->loadForm(
            'com_recruit.requesthr',
            'requesthr',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        $str = '';
        foreach ($form->getFieldsets() as $name => $fieldset) {
            foreach ($form->getFieldset($name) as $field) {

//                echo "<pre>";
//                print_r($field->value); die;
                $str .= $field->label . " : " . $field->value . "<br/>";
            }
        }


//            echo "<pre>";
//            print_r($str);
//            echo "</pre>";
//
//        die;

//        echo "<pre>";
//        print_r($loadData); die;


    }

    public function getLevelbyId($id) {

        $rows = array();
        $rows[0] = new stdClass();
        $rows[0]->level_id = $id;

        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_recruit/models', 'RecruitModel');
        $levels_model = JModelLegacy::getInstance('requestvr', 'RecruitModel', array('ignore_request' => true));

        $level = $levels_model->LevelsById($rows);

        return $level[0];
    }


    public function getTypebyId($id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('name'));
        $query->from('#__recruit_types');
        $query->where('id = '.$id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }


    public function getTypeInterpreterbyId($id) {

        switch ($id) {
            case 0:
                $row = 'письменный';
            break;
            case 1:
                $row = 'устный';
            break;
            case 2:
                $row = 'верстальщик';
            break;
            default:
        }

        return $row;
    }

    public function getTypeEmployebyId($id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('name'));
        $query->from('#__recruit_typeemployee');
        $query->where('id = '.$id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }

    public function getEmployeeUser_id($employee_id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('user_id'));
        $query->from('#__recruit_employee');
        $query->where('id = '.$employee_id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }

    public function getEmployeeName($id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('name'));
        $query->from('#__recruit_employee');
        $query->where('id = '.$id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }
    public function getDepartment($id) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('name'));
        $query->from('#__recruit_units');
        $query->where('id = '.$id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }

    public function saveAdditionForm($request_id, $additionFormName) {

        $data = JRequest::getVar($additionFormName, array(), 'post', 'array');

        //echo $request_id; die;

        if(isset($request_id) && $request_id && count($data) && $additionFormName) {

            $row = JTable::getInstance($additionFormName, 'RecruitTable');

            $data['id'] = $row->getId($request_id);
            $data['request_id'] = $request_id;

//            echo "<pre>";
//            print_r($data); die;

            if(!$row->bind($data))
            {
                JError::raiseError(500, $row->getError() );
                return false;
            }
            if(!$row->store()){
                JError::raiseError(500, $row->getError() );
                return false;
            }
        }

    }


    public function agreement($data) {

//        echo "<pre>";
//        print_r($data); die;

        $string = $this->_bodyRequestCreation($data);
//        die;
//        echo $string;


        if($data->type_id == 1) {

            $this->send_agreement($string, $data);
        }


    }

    public function send_agreement($body, $data) {

        $app = &JFactory::getApplication();
        $live_url = JFactory::getURI();
        $params = JComponentHelper::getParams('com_recruit');


        $body1 = $body;
        $uri1 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_division_head&field2=date_division_head&value=1';
        $body1 .= "<br />утвердить заявку: <a href='" . $uri1 . "' target='_blank'>утверждаю</a>";

        $uri11 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_division_head&field2=date_division_head&value=2';
        $body1 .= "<br />уточнить заявку: <a href='" . $uri11 . "' target='_blank'>уточнить</a>";

        $uri111 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_division_head&field2=date_division_head&value=3';
        $body1 .= "<br />отклонить заявку: <a href='" . $uri111 . "' target='_blank'>отклонить</a>";


        $division_head_email = $this->get_divisiton_head_email($data);

        $email1 = $division_head_email;//change it

        //echo $email1; die;


        $this->_mail( $body1, 'согласование заявки', $email1);


        $body2 = $body;
        $uri2 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_fin_director&field2=date_fin_director&value=1';
        $body2 .= "<br />утвердить заявку: <a href='" . $uri2 . "' target='_blank'>утверждаю</a>";

        $uri22 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_fin_director&field2=date_fin_director&value=2';
        $body2 .= "<br />уточнить заявку: <a href='" . $uri22 . "' target='_blank'>уточнить</a>";

        $uri222 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_fin_director&field2=date_fin_director&value=3';
        $body2 .= "<br />отклонить заявку: <a href='" . $uri222 . "' target='_blank'>отклонить</a>";


        $email2 = $params->get('fin_director_email');
        $this->_mail( $body2, 'согласование заявки', $email2);


        $body3 = $body;
        $uri3 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_chief_accountant&field2=date_chief_accountant&value=1';
        $body3 .= "<br />утвердить заявку: <a href='" . $uri3 . "' target='_blank'>утверждаю</a>";

        $uri33 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_chief_accountant&field2=date_chief_accountant&value=2';
        $body3 .= "<br />уточнить заявку: <a href='" . $uri33 . "' target='_blank'>уточнить</a>";

        $uri333 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_chief_accountant&field2=date_chief_accountant&value=3';
        $body3 .= "<br />отклонить заявку: <a href='" . $uri333 . "' target='_blank'>отклонить</a>";

        $uri3333 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_chief_accountant&field2=date_chief_accountant&value=4';
        $body3 .= "<br />ознакомлен: <a href='" . $uri3333 . "' target='_blank'>ознакомлен</a>";


        $email3 = $params->get('chief_accountant_email');
        $this->_mail( $body3, 'согласование заявки', $email3);


        $body4 = $body;
        $uri4 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_general_director&field2=date_general_director&value=1';
        $body4 .= "<br />утвердить заявку: <a href='" . $uri4 . "' target='_blank'>утверждаю</a>";

        $uri44 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_general_director&field2=date_general_director&value=2';
        $body4 .= "<br />уточнить заявку: <a href='" . $uri44 . "' target='_blank'>уточнить</a>";

        $uri444 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_general_director&field2=date_general_director&value=3';
        $body4 .= "<br />отклонить заявку: <a href='" . $uri444 . "' target='_blank'>отклонить</a>";


        $email4 = $params->get('general_director_email');
        $this->_mail( $body4, 'согласование заявки', $email4);


        $body5 = $body;
        $uri5 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_vendor_management&field2=date_vendor_management&value=1';
        $body5 .= "<br />утвердить заявку: <a href='" . $uri5 . "' target='_blank'>утверждаю</a>";

        $uri55 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_vendor_management&field2=date_vendor_management&value=2';
        $body5 .= "<br />уточнить заявку: <a href='" . $uri55 . "' target='_blank'>уточнить</a>";

        $uri555 = $live_url. '&task=requesthr.agreement&id='.$data->id.'&field1=status_vendor_management&field2=date_vendor_management&value=3';
        $body5 .= "<br />отклонить заявку: <a href='" . $uri555 . "' target='_blank'>отклонить</a>";


        $email5 = $params->get('vendor_management_email');
        $this->_mail( $body5, 'согласование заявки', $email5);


    }

    public function get_divisiton_head_email($data) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('email'));
        $query->from('#__recruit_units');
        $query->where('id = '.$data->department);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;

    }

    //public function getIdForAdditionFormRecord

}
