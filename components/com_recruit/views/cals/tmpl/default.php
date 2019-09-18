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

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');

$types = JFormHelper::loadFieldType('Type', false);
$typeOptions=$types->getOptions();

$employees = JFormHelper::loadFieldType('Employee', false);
$employeeOptions=$employees->getOptions();

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);


JHtml::script(Juri::base() . 'components/com_recruit/js/calendar.js');
?>
<style type="text/css">
    #toolbar-new {
        float: left;
    }
    #toolbar-delete {
        float: left;
        margin-left: 20px;
    }
    #credits_table th {
        font-size: 10px;
        border-top:1px solid #ddd;
    }

    .container {
        max-width: 960px;
        min-width: 960px;
    }
    body.site {
        border-top: 0px;
    }

    .table th, .table td {

        border-right: 1px solid #ddd;
    }

    #credits_table tr td:nth-child(odd){
        background: #f6f6f6;
    }

    #credits_table tr th:nth-child(odd){
        background: #f6f6f6;
    }

</style>
<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->

<div style="float: left;">
<?php echo $this->toolbar->render(); ?>
</div>


<form action="index.php" method="post" name="adminForm" id="adminForm">

    <div style="float: right; margin-bottom: 20px;">
        <div class="filter-search btn-group pull-left">
<!--            <label for="filter_search" class="element-invisible">--><?php //echo JText::_('COM_TAGS_ITEMS_SEARCH_FILTER');?><!--</label>-->
<!--            <input type="text" name="filter_search" id="filter_search" placeholder="--><?php //echo JText::_('JSEARCH_FILTER'); ?><!--" value="--><?php //echo $this->escape($this->state->get('filter.search')); ?><!--" class="hasTooltip" title="Поиск по имени" />-->
        </div>
        <div class="btn-group">
<!--            <button type="submit" class="btn hasTooltip" title="--><?php //echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?><!--"><span class="icon-search"></span></button>-->
<!--            <button type="button" class="btn hasTooltip" title="--><?php //echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?><!--" onclick="document.getElementById('filter_search').value='';this.form.submit();"><span class="icon-remove"></span></button>-->
        </div>
<!--        <div class="btn-group pull-right hidden-phone">-->
<!--            <label for="limit" class="element-invisible">--><?php //echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?><!--</label>-->
<!--            --><?php //echo $this->pagination->getLimitBox(); ?>
<!--        </div>-->

        <div class="filter-select fltrt">
            <select name="filter_type" class="inputbox" onchange="this.form.submit()">
                <option value=""> - Типы заявок - </option>
                <?php echo JHtml::_('select.options', $typeOptions, 'value', 'text', $this->state->get('filter.type'));?>
            </select>

            <select name="filter_employee" class="inputbox" onchange="this.form.submit()">
                <option value=""> - Сотрудники - </option>
                <?php echo JHtml::_('select.options', $employeeOptions, 'value', 'text', $this->state->get('filter.employee'));?>
            </select>
        </div>

    </div>

	
<div style="width: 100%; overflow-x: scroll;" id="main_calendar_container">
<div style="width: 4100px;" id="calendar_container" >

    <table class="table table-striped table-hover" id="credits_table">
        <thead>
        <tr>

            <th width="280px" style="border-left: 1px solid #ddd;">
                Название вакансии
            </th>
			
			<?php foreach($this->months as $k=>$v) {?>							
					<th style="text-align: center; padding: 0px;">
						
						<?php echo "<div>".$k."</div>";?>
						
						<?php 
						echo "<div>";
							for($y=1;$y<=$v;$y++) {
								echo "<div style='float: left; border: 1px solid #ddd; width: 15px;' id='".strtotime($y ." ".$k)."'>".$y."</div>";
							}	
						echo "</div>"		
						?>
					
					</th>
			<?php }?>
        </tr>
        </thead>
		

		
		
        <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) :?>
                <tr>

                    <td style="position: absolute; background-color: white; border-left: 1px solid #ddd;">
						<?php

                        switch ($row->type_id) {
                            case 1:
                                $link = "index.php?option=com_recruit&view=requesthr&layout=edit&id=".$row->id;
                            break;
                            case 2:
                                $link = "index.php?option=com_recruit&view=requestvr&layout=edit&id=".$row->id;
                            break;

                        }

						//$link = "index.php?option=com_recruit&view=requesthr&layout=edit&id=".$row->id;
						
						echo "<a href='".$link."'>".$row->name."</a>"; ?>	
                    </td>
					
					<?php foreach($this->months as $n=>$m) {?>							
					<td style="text-align: center; padding: 0px;">
						<?php 
						echo "<div>";
							for($y=1;$y<=$m;$y++) {
								
								//echo $n,",".$k; die;
								//echo "---". $y ." ".str_replace(","," ",$n); die;
								//." ".str_replace(","," ",$n)," ".$k." --- "; die;
								
								//echo "<pre>";
								//print_r($row); die;
								
								$current = strtotime($y ." ".str_replace(","," ",$n));

                                $weekday= date("l", $current );

								//echo date("Y-m-d", $current); die;
								
								$request_public = strtotime($row->public_date);
								$request_estimate = strtotime($row->estimate_date);

								$request_archive = $row->archive;

								$now = strtotime("now");

								$highPriority =  $row->priority;


								if($current >= $request_public && $current <= $request_estimate) {

								    if($request_archive) {
                                        echo "<div style='float: left; border: 1px solid #ddd; width: 15px; height: 32px; background-color: green;'>&nbsp;</div>";
                                    }
								    else if($request_estimate < $now) {
                                        echo "<div style='float: left; border: 1px solid #ddd; width: 15px; height: 32px; background-color: orange;'>&nbsp;</div>";
                                    }
								    else if($highPriority) {
                                        echo "<div style='float: left; border: 1px solid #ddd; width: 15px; height: 32px; background-color: red;'>&nbsp;</div>";
                                    }
								    else {
                                        echo "<div style='float: left; border: 1px solid #ddd; width: 15px; height: 32px; background-color: yellow;'>&nbsp;</div>";
                                    }
								}

								else if ($weekday =="Saturday" OR $weekday =="Sunday") {
                                    echo "<div style='float: left; border: 1px solid #ddd; width: 15px; height: 32px; background-color: #ededed;'>&nbsp;</div>";
                                }
								else {
									echo "<div style='float: left; border: 1px solid #ddd; width: 15px; height: 32px;'>&nbsp;</div>";
								}
								
								
																
							}	
						echo "</div>"		
						?>
						
					</td>
					<?php }?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
		
		
    </table>
	
	
</div>


    <input type="hidden" name="view" value="cals" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
</div>


<div>

    <?php echo $this->pagination->getListFooter(); ?>

</div>

<div style="display: none;" id="todays_date"><?php echo strtotime(date("j F, Y"));?></div>


<!--<button type="button" class="btn btn-success">Создать</button>-->
