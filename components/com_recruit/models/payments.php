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

class CreditModelPayments extends JModelList
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
    public $count_months = 0;
    //public $previous_month_fine_sum = 0;

    public function __construct($config = array())
    {


//        if (empty($config['filter_fields']))
//        {
//            $config['filter_fields'] = array(
//                'id','a.id',
//                'name','a.name',
//                'sum', 'a.sum',
//                'start_date','a.start_date',
//                'end_date','a.end_date'
//            );
//        }
        parent::__construct($config);
    }

    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery()
    {

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
        $query->from('#__credit AS a');

        // Filter: like / search
        $search = $this->getState('filter.search');


        if (!empty($search))
        {
            $like = $db->quote('%' . $search . '%');
            $query->where('a.name LIKE ' . $like);
        }

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
        $orderCol	= $this->state->get('list.ordering', 'a.name');
        $orderDirn 	= $this->state->get('list.direction', 'asc');


        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));


        return $query;
    }

    protected function populateState($ordering = null, $direction = null)
    {

        $app = JFactory::getApplication();
        $context = $this->context;

        // Load the filter state.
        $search = $this->getUserStateFromRequest($context . '.search', 'filter_search');
        $this->setState('filter.search', $search);

        // List state information.
        parent::populateState('a.name', 'asc');
    }

    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');

        return parent::getStoreId($id);
    }

    public function getTable($type = 'Credit', $prefix = 'CreditTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItem() {
        $credit_id = JRequest::getInt('id');

        $row =& JTable::getInstance('credit', 'CreditTable');
        $row->load( $credit_id );

        $row->return_sum = $row->currency." ".$this->getFullReturnSum($row);

        $row->alredy_returned = $row->currency." ".$this->getAlreadyReturnedSum($row);

        return $row;
    }


    public function getItems() {

        $row= $this->getItem();

        $start_payment_date = $this->getPaymentReplacedDate($row);

        $count_months = $this->getCountMonths($row);

        $rows = array();


        switch($row->credit_conditions) {
            case 1:
                $sum = $this->getJustPercentForEachMonth($row);
            break;
            case 2:
                $sum = $this->getSumWithPercentForEachMonth($row);
            break;
        }

//        echo "<pre>";
//        print_r($sum);
//        echo "</pre>";


        for($i=0;$i<$count_months;$i++) {
            $start_date = new DateTime($start_payment_date);
            $next_month = $i+1;
            $next_date = $start_date->modify("+".$next_month." months");

            $rows[$i] = new stdClass();
            $rows[$i]->payment_date =  $next_date->format("Y-m-d");

            $rows[$i]->sum_for_payment = $this->checkPaymentSumForFine($rows[$i]->payment_date,$sum, $row);

            $rows[$i]->currency = $row->currency;

            $rows[$i]->payment_id = $this->checkIfItemPayed($row->id, $rows[$i]->payment_date);
            $rows[$i]->payed = ($rows[$i]->payment_id)?1:0;

            $rows[$i]->credit_id = $row->id;

            $rows[$i]->next_payment_date = $this->checkIfItsTheNextPaymentDate($rows[$i]->payment_date);
        }

        return $rows;
    }


    public function checkIfItsTheNextPaymentDate($date) {
        if(new DateTime() < new DateTime($date)) {
            return true;
        }
        return false;
    }

    public function checkPaymentSumForFine($date,$sum,$row) {
        $fine = 0;

        $sumInDb = $this->checkIfItemInDb($row->id, $date);

        if(new DateTime() > new DateTime($date) && !$sumInDb) {
            //$fine = $sum*$row->percent_fine_day/100;
        }
        elseif($sumInDb) {
            $sum = $sumInDb;
        }
//        else {
//
//        }
        return $sum + $fine;
    }

    public function getFineForPeriod($date) {

    }


    public function checkIfItemInDb($credit_id, $payment_date) {

        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        $query = "SELECT payment_sum FROM #__credit_payments WHERE credit_id = ".$credit_id." AND payment_date = '".$payment_date."'";

        $db->setQuery($query);
        $row = $db->loadObject();

        if($row->payment_sum) {
            return $row->payment_sum;
        }
        else {
            return 0;
        }

    }

    public function checkIfItemPayed($credit_id, $payment_date) {


        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        $query = "SELECT id FROM #__credit_payments WHERE credit_id = ".$credit_id." AND payment_date = '".$payment_date."'";

        $db->setQuery($query);
        $row = $db->loadObject();

        if($row->id) {
            return $row->id;
        }
        else {
            return 0;
        }


    }

    public function getPaymentReplacedDate($row) {

        $date = $row->start_date;

        $date = explode('-', $date);

        $date[2] = $row->date_of_payment;

        $date = implode('-', $date);

        return $date;

    }

    public function getCountMonths($row) {

        $d1 = new DateTime($row->start_date);
        $d2 = new DateTime($row->end_date);

        return $d1->diff($d2)->m + ($d1->diff($d2)->y*12);
    }

    public function getJustPercentForEachMonth($row) {
        return round($row->percent*$row->sum/100,1);
    }


    public function getSumWithPercentForEachMonth($row) {
        $sum_without_percents = $row->sum/$this->getCountMonths($row);
        $sum_percent_per_month = $row->percent*$row->sum/100;

        return round($sum_without_percents + $sum_percent_per_month,1);
    }

    public function getFullReturnSum($row) {
        return round((($row->sum*$row->percent)/100) * $this->getCountMonths($row) + $row->sum,1);
    }

    public function getAlreadyReturnedSum($row) {

        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        $query = "SELECT sum(payment_sum) as sum FROM #__credit_payments WHERE credit_id = ".$row->id;

        $db->setQuery($query);
        $row = $db->loadObject();

        if(!$row->sum) {
            $row->sum = 0;
        }

        return round($row->sum,0);

    }


    public function updItem($request)
    {

        $row =& JTable::getInstance('payments', 'CreditTable');
        $request_string = explode(',',$request[0]);

        $data = array();
        $data['credit_id'] = $request_string[0];
        $data['payment_date'] = $request_string[1];
        $data['payment_sum'] = $request_string[2];
        $date['id'] = $request_string[3];

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

    public function deleteItem($request)
    {
        $row =& JTable::getInstance('payments', 'CreditTable');
        $request_string = explode(',',$request[0]);

        $id = $request_string[3];


        if(!$row->delete($id))
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
}
