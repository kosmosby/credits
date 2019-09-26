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

class RecruitModelLocations extends JModelList
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
                'name','a.name'
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
        $query->from('#__recruit_locations AS a');

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
        parent::populateState('a.name', 'asc');
    }

    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');

        return parent::getStoreId($id);
    }

    public function getTable($type = 'Locations', $prefix = 'RecruitTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }


}
