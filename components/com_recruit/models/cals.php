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
 * HelloWorldList Model
 *
 * @since  0.0.1
 */
jimport('joomla.application.component.modellist');

class RecruitModelCals extends JModelList
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
    public function __construct($config = array())
    {


        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id','a.id',
                'name','a.name', 'a.type_id', 'a.employee_id'
            );
        }
        parent::__construct($config);
    }

    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery()
    {

        $user = JFactory::getUser();
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select(
            $this->getState(
                'list.select',
                'a.*'
            )
        );
        $query->from('#__recruit_requests AS a');

        // Filter company
        $type= $db->escape($this->getState('filter.type'));
        if (!empty($type)) {
            $query->where('(a.type_id='.$type.')');
        }

        // Filter company
        $employee= $db->escape($this->getState('filter.employee'));
        if (!empty($employee)) {
            $query->where('(a.employee_id='.$employee.')');
        }

        // Filter: like / search
        $search = $this->getState('filter.search');
        if (!empty($search))
        {
            $like = $db->quote('%' . $search . '%');
            $query->where('a.name LIKE ' . $like);
        }

        $query->where('a.archive = 0 AND estimate_date != 0');

        $isSuperUser = JFactory::getUser()->authorise('core.admin');
        if(!$isSuperUser) {
            JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_recruit/models', 'RecruitModel');
            $requests_model = JModelLegacy::getInstance('requests', 'RecruitModel', array('ignore_request' => true));

            $employee_id = $requests_model->getEmployeeIdByUserId();
            //$query->where('a.type_id = 1');
            $query->where('a.id NOT IN (SELECT id FROM #__recruit_requests WHERE archive = 0 AND type_id = 1 AND created_by != '.$user->id.' )');
            if($employee_id) {
                $query->where('a.id NOT IN (SELECT id FROM #__recruit_requests WHERE archive = 0 AND type_id = 1 AND employee_id !=' . $employee_id . ')');
            }
        }


//        $isSuperUser = JFactory::getUser()->authorise('core.admin');
//        $user_id = JFactory::getUser()->id;
//        if(!$isSuperUser) {
//            $query->where('(a.created_by='.$user_id.')');
//        }

        // Filter by published state
//        $published = $this->getState('filter.published');

//        if (is_numeric($published))
//        {
//            $query->where('published = ' . (int) $published);
//        }
//        elseif ($published === '')
//        {
//            $query->where('(published IN (0, 1))');
//        }

        // Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering', 'a.id');
        $orderDirn 	= $this->state->get('list.direction', 'DESC');


        $query->order('a.priority DESC, '.$db->escape($orderCol) . ' ' . $db->escape($orderDirn));
//
        //echo $query->__toString(); die;

        return $query;
    }


//    public function getAdditionPaymentInfo($rows) {
//
//        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_credit/models', 'CreditModel');
//        $payments_model = JModelLegacy::getInstance('payments', 'CreditModel', array('ignore_request' => true));
//
//        for($i=0;$i<count($rows);$i++) {
//
//            $rows[$i]->percent_all_time = $rows[$i]->percent * $payments_model->getCountMonths($rows[$i]);
//
//            switch($rows[$i]->credit_conditions) {
//                case 1:
//                    $rows[$i]->sum_in_month = $payments_model->getJustPercentForEachMonth($rows[$i]);
//                    break;
//                case 2:
//                    $rows[$i]->sum_in_month = $payments_model->getSumWithPercentForEachMonth($rows[$i]);
//                    break;
//            }
//
//
//            $rows[$i]->full_return_sum = $payments_model->getFullReturnSum($rows[$i]);
//            $rows[$i]->already_returned_sum = $payments_model->getAlreadyReturnedSum($rows[$i]);
//        }
//
//        return $rows;
//
//
//    }

    protected function populateState($ordering = null, $direction = null)
    {

        $app = JFactory::getApplication();
        $context = $this->context;

        // Load the filter state.
        $search = $this->getUserStateFromRequest($context . '.search', 'filter_search');
        $this->setState('filter.search', $search);

        //Filter (dropdown) company
        $type= $app->getUserStateFromRequest($this->context.'.filter.type', 'filter_type', '', 'string');
        $this->setState('filter.type', $type);

        //Filter (dropdown) company
        $employee= $app->getUserStateFromRequest($this->context.'.filter.employee', 'filter_employee', '', 'string');
        $this->setState('filter.employee', $employee);

//        $level = $this->getUserStateFromRequest($context . '.filter.level', 'filter_level', 0, 'int');
//        $this->setState('filter.level', $level);


//        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->get('list_limit'), 'uint');
//        $this->setState('list.limit', $limit);
//
//        $limitstart = $app->input->get('limitstart', 0, 'uint');
//        $this->setState('list.start', $limitstart);

//        $state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
//        $this->setState('filter.state', $state);

//
//        echo "<pre>";
//        print_r($limitstart);
//        echo "</pre>";

        //$this->getPagination()->set('limitstart',$limitstart);

        // List state information.
        parent::populateState('a.id', 'ASC');
    }

    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');

        return parent::getStoreId($id);
    }

    public function getTable($type = 'Types', $prefix = 'RecruitTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
	
	public function showCal() {
		
		
		
		//echo date("F",strtotime("now -1 month")); 
		/*
		echo "<pre>";
		print_r($this->getMonths()); 
		echo "</pre>";
		*/
	}
	
	public function getMonths() {

        $startDate = $this->get_first_request();
        $endDate = $this->get_last_request();


        //echo $startDate; die;
        $number_months = $this->nb_mois($startDate,$endDate);

        //echo $number_months; die;

        $months = array();
        for($i=0;$i<$number_months;$i++) {

            $key = date("F, Y",strtotime($startDate." + ".$i." month"));
            $value = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime($startDate." +".$i." month")), date("Y",strtotime($startDate." +".$i." month")));

            $months[$key] = $value;
        }


//        echo "<pre>";
//        print_r($months); die;


		/*
		for($i=-1;$i<6;$i++) {
			
			$key = date("F, Y",strtotime("now ".$i." month"));			
			$value = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime("now ".$i." month")), date("Y",strtotime("now ".$i." month"))); 
			
			$months[$key] = $value;	
		}
		*/

		
		return $months;
	}

	public function get_first_request() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select(array('public_date'))
            ->from($db->quoteName('#__recruit_requests'))
            ->where('archive = 0 AND estimate_date != 0 ')
            ->order($db->quoteName('public_date') . ' ASC')
            ->setLimit('1');

        //echo $query->__toString(); die;

        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        $row = $db->loadResult();

        return $row;
    }

    public function get_last_request() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select(array('estimate_date'))
            ->from($db->quoteName('#__recruit_requests'))
            ->where('archive = 0 AND estimate_date != 0')
            ->order($db->quoteName('estimate_date') . ' DESC')
            ->setLimit('1');


        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        $row = $db->loadResult();

        return $row;
    }
	
	public function getRequests() {
		
		// Get a db connection.
		$db = JFactory::getDbo();

		// Create a new query object.
		$query = $db->getQuery(true);

		// Select all articles for users who have a username which starts with 'a'.
		// Order it by the created date.
		// Note by putting 'a' as a second parameter will generate `#__content` AS `a`
		$query
		    ->select(array('a.*'))
		    ->from($db->quoteName('#__recruit_requests', 'a'))
		    ->order($db->quoteName('a.id') . ' ASC');

		// Reset the query using our newly populated query object.
		$db->setQuery($query);

		// Load the results as a list of stdClass objects (see later for more options on retrieving data).
		$results = $db->loadObjectList();
		
		return $results;
	}

    public function nb_mois($date1, $date2)
    {
        $begin = new DateTime( $date1 );
        $end = new DateTime( $date2 );
        $end = $end->modify( '+1 month' );

        $interval = DateInterval::createFromDateString('1 month');

        $period = new DatePeriod($begin, $interval, $end);
        $counter = 0;
        foreach($period as $dt) {
            $counter++;
        }

        return $counter;
    }


}
