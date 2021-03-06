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
class RecruitViewUnit extends JViewLegacy
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
        // Get the Data
        $this->item = $this->get('Item');

        $this->form = $this->get('Form');


        $this->toolbar = $this->addToolbar();

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

        $document = JFactory::getDocument();

        $isNew = ($this->item->id == 0);

        if ($isNew)
        {
            $title = "Создание новой записи";
        }
        else
        {
            $title = "Редактирование записи";
        }

        $document->setTitle($title);

        JToolBarHelper::cancel('unit.cancel','Вернуться');
        JToolbarHelper::addNew('unit.submit','Сохранить');


        return $this->toolbar;
    }
}
