<?php
/**
 * Created by PhpStorm.
 * User: kosmos
 * Date: 2/9/16
 * Time: 1:06 PM
 */


 defined('_JEXEC') or die('Restricted access');
 jimport('joomla.html.toolbar');
 class CreditHelperToolbar extends JObject
 {
     function getToolbar($view) {
         $bar = new JToolbar($view);
         return $bar;
     }
 }