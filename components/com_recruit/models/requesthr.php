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
        $row =& JTable::getInstance('Requests', 'RecruitTable');

        if(!$row->bind($data))
        {
            JError::raiseError(500, $row->getError() );
            return false;
        }
        if(!$row->store()){
            JError::raiseError(500, $row->getError() );
            return false;
        }

        return true;

    }

    public function estimate($type_id,$jform_employee_id,$jform_typeemployee_id, $jform_count_employee, $start_date, $id, $level_id) {

        if($this->ifRearrangeRequest($id, $jform_employee_id)) {
            $id='';
        }

        $db = JFactory::getDbo();

        $estimate_date = '';

        $public_date = $start_date;

        switch ($type_id) {
            case 1:
                $prev_date = $this->findPreviousRequest($jform_employee_id, $id, $start_date, $type_id);

                if(count($prev_date)) {

                    $half_all_count_days = (strtotime($prev_date->estimate_date) - strtotime($prev_date->public_date))/2;

                    $half_date = strtotime($prev_date->public_date) + $half_all_count_days;

                    if(strtotime($start_date) < $half_date) {
                        $start_date_seconds = strtotime($prev_date->public_date) + $half_all_count_days;
                        $public_date = date("Y-m-d", $start_date_seconds);
                    }
                }

                $query = $db->getQuery(true);
                $query->select(array('norm'));
                $query->from('#__recruit_norms');
                $query->where('typeemployee_id = '.$jform_typeemployee_id);

                //echo $query->__toString(); die;

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

                    $half_date = strtotime($prev_date->public_date) + $half_all_count_days;

                    if(strtotime($start_date) < $half_date) {
                        $start_date_seconds = strtotime($prev_date->public_date) + $half_all_count_days;
                        $public_date = date("Y-m-d", $start_date_seconds);
                    }
                }

                $query = $db->getQuery(true);
                $query->select(array('point'));
                $query->from('#__recruit_levels');
                $query->where('id = '.$level_id);
                $db->setQuery($query);
                $point = $db->loadResult();

                //$index = $jform_count_employee - 1;
                //echo $point; die;

                $index = round((($jform_count_employee-1)*$point)/2);

                //echo round($index); die;
                $days = 3 + $point  + $index;
//                echo $start_date; die;

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

//        echo $employee_id; die;

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('id', 'public_date', 'estimate_date'));
        $query->from('#__recruit_requests');
        $query->where('employee_id = '.$employee_id);
        //$query->where('start_date <= \''.$start_date.'\'');
        //$query->where('estimate_date >= \''.$start_date.'\'');
        $query->where('type_id = \''.$type_id.'\'');

        //echo $query->__toString(); die;

        if($id) {
            $query->where('id < '.$id);
        }

        $query->order('id DESC ');
        $query->setlimit(1);
        $db->setQuery($query);
        $row = $db->loadObject();

//        echo "<pre>";
//        print_r($row); die;

        return $row;
    }


}
