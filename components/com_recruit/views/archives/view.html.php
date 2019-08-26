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
class RecruitViewArchives extends JViewLegacy
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
        $context = "request.
list.admin.request";

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

        //$this->items	= $model->getAdditionPaymentInfo($this->items);

        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_recruit/models', 'RecruitModel');
        $levels_model = JModelLegacy::getInstance('requestvr', 'RecruitModel', array('ignore_request' => true));

        $this->items = $levels_model->LevelsById($this->items);

//        echo "<pre>";
//        print_r($this->items); die;

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

//        JToolbarHelper::addNew('requesthr.add','Создать заявку HR');
//        JToolbarHelper::addNew('requestvr.add','Создать заявку VM');
        JToolbarHelper::spacer('10px');

        JToolbarHelper::archiveList('archives.unarchive','Достать из архива');
        JToolBarHelper::deleteList('', 'request.delete', 'Удалить');

        return $this->toolbar;
    }
}
