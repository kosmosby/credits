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

class RecruitModelRequestvr extends JModelAdmin
{
	/**
	 * @var object item
	 */
	protected $item;
	protected $select;
	//public $additionForm;

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
		$this->setState('requestvr.id', $id);

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
            'com_recruit.requestvr',
            'requestvr',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form))
        {
            return false;
        }

//        echo "<pre>";
//        print_r($form); die;

        return $form;
    }

    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
            'com_recruit.edit.requestvr.data',
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

    public function estimate($type_id,$jform_employee_id,$jform_typeemployee_id, $jform_count_employee, $start_date, $id) {

        $db = JFactory::getDbo();

        $estimate_date = '';

        switch ($type_id) {
            case 1:

                $prev_date = $this->findPreviousRequest($jform_employee_id, $id, $start_date);

                if(count($prev_date)) {

                    $half_all_count_days = (strtotime($prev_date->estimate_date) - strtotime($prev_date->start_date))/2;
                    $start_date_seconds = strtotime($prev_date->start_date) + $half_all_count_days;

                    $start_date = date("Y-m-d",$start_date_seconds);
                }

                $query = $db->getQuery(true);
                $query->select(array('norm'));
                $query->from('#__recruit_norms');
                $query->where('typeemployee_id = '.$jform_typeemployee_id);
                $db->setQuery($query);
                $norm = $db->loadResult();

                $index = $jform_count_employee - 1;
                $days = $norm * 7 + ($norm*7)/2 * $index;



                $estimate_date = date("Y-m-d", strtotime($start_date.'+'.$days.' days'));


            break;
            case 2:
                $estimate_date = '';
            break;

            default:
                $estimate_date = '';
        }
        return $estimate_date;
    }

    public function findPreviousRequest ($employee_id, $id, $start_date) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('id', 'start_date', 'estimate_date'));
        $query->from('#__recruit_requests');
        $query->where('employee_id = '.$employee_id);
        $query->where('start_date <= \''.$start_date.'\'');
        $query->where('estimate_date >= \''.$start_date.'\'');

        if($id) {
            $query->where('id < '.$id);
        }

        $query->order('start_date DESC ');
        $query->setlimit(1);
        $db->setQuery($query);
        $row = $db->loadObject();

        return $row;
    }

    public function getLevels() {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('*'));
        $query->from('#__recruit_levels');
//        $query->where('employee_id = '.$employee_id);
//        $query->where('start_date <= \''.$start_date.'\'');
//        $query->where('estimate_date >= \''.$start_date.'\'');
//
//        if($id) {
//            $query->where('id < '.$id);
//        }
//
//        $query->order('start_date DESC ');
//        $query->setlimit(1);
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_recruit/models', 'RecruitModel');
        $levels_model = JModelLegacy::getInstance('Levels', 'RecruitModel', array('ignore_request' => true));

        $rows = $levels_model->getLanguages($rows);

        $rows = $this->getLevelsNames($rows);


        $db = JFactory::getDBO();
        $sql = "CREATE TEMPORARY TABLE `#__recruit_levels_tmp` (
  `id` int(11) NOT NULL,
  `languages` varchar(255) NOT NULL
)";
        $db->setQuery($sql);
        $db->query();
        //$options = $db->loadObjectList();
        //return $options;
        for($i=0;$i<count($rows); $i++) {
            // Create and populate an object.
            $obj = new stdClass();
            $obj->id = $rows[$i]->id;
            $obj->languages = $rows[$i]->languages. ' - ' . $rows[$i]->level_name;

// Insert the object into the user profile table.
            $result = JFactory::getDbo()->insertObject('#__recruit_levels_tmp', $obj);
        }
        //return $rows;

    }

    public function getLevelsNames($rows) {

        $db = JFactory::getDbo();

        for($i=0;$i<count($rows);$i++) {
            $query = $db->getQuery(true);
            $query->select(array('name'));
            $query->from('#__recruit_themes');
            $query->where('id = '.$rows[$i]->theme_id);
            $db->setQuery($query);
            $level_name = $db->loadResult();

            $rows[$i]->level_name = $level_name;
        }
        return $rows;
    }

    public function LevelsById($rows) {

        for($i=0;$i<count($rows);$i++) {

            if(isset($rows[$i]->level_id) && $rows[$i]->level_id) {

                $obj = $this->getLevelObject($rows[$i]->level_id);
                $rows[$i]->theme_name = $obj->theme_name;
                $rows[$i]->languages = $obj->languages;

            }
        }

        return $rows;

    }


    public function getLevelObject($id) {

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select(array('a.*', 'b.name as theme_name'));
        $query->from('#__recruit_levels as a, #__recruit_themes as b');
        $query->where('a.id = '.$id.' AND b.id = a.theme_id');
        $db->setQuery($query);
        $row = $db->loadObject();

        $registry = new JRegistry;
        $registry->loadString($row->language_id);
        $string = implode(',',$registry->toArray());

        $query = $db->getQuery(true);
        $query
            ->select('a.name')
            ->from('#__recruit_languages as a')
            ->where('a.id IN( '.$string.')');

        $db->setQuery($query);
        $results = $db->loadObjectList();

        $array = array();
        for($j=0;$j<count($results);$j++) {
            $array[] = $results[$j]->name;
        }
        $row->languages = implode(',',$array);

        return $row;
    }

    public function loadAdditionFormData($tpl, $id) {

        $additionForm = new JForm($tpl);
        $additionForm->loadFile(JPATH_ROOT.'/components/com_recruit/models/forms/'.$tpl.'.xml');

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array('*'));
        $query->from('#__recruit_'.$tpl);
        $query->where('request_id = '.$id);

        $db->setQuery($query);
        $row = $db->loadAssoc();

//        echo "<pre>";
//        print_r($additionForm); die;

        if(count($row)) {
            foreach ($row as $k => $v) {
                $additionForm->setValue($tpl.'[' . $k . ']', '', $v);
            }
        }

        //$additionForm->setValue('translatorwritten[language_pair]','','Языковая пара');
        //$additionForm->setFields($row);
//        echo "<pre>";
//        print_r($additionForm); die;


        return $additionForm;

    }



}
