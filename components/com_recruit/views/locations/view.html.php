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
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 */
class RecruitViewLocations extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{

        // Get application
        $app = JFactory::getApplication();
        $context = "location.list.admin.location";

        // Get data from the model
        $this->items			= $this->get('Items');
        $this->pagination		= $this->get('Pagination');
        $this->state			= $this->get('State');
        $this->filter_order 	= $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'name', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        //$this->filterForm    	= $this->get('FilterForm');
        $this->activeFilters 	= $this->get('ActiveFilters');

        // Set the toolbar
        //$input->set('hidemainmenu', true);
        $this->toolbar = $this->addToolbar();

        $model	= $this->getModel('locations');
        //$this->items	= $model->getAdditionPaymentInfo($this->items);

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}

		// Display the view
		parent::display($tpl);


	}

    protected function addToolBar()
    {
        JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');

        $this->toolbar = JToolbar::getInstance();

        JToolbarHelper::addNew('location.add','Создать месторасположение');
        JToolBarHelper::deleteList('', 'locations.delete', 'Удалить');

        return $this->toolbar;
    }
}
