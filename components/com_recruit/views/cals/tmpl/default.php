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


$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);

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

    <div style="float: right;">
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
    </div>
		
	
<div style="width: 100%; overflow-x: scroll;">
<div style="width: 4100px;" >

    <table class="table table-striped table-hover" id="credits_table">
        <thead>
        <tr>
            <th style="border-left: 1px solid #ddd;" width="10px">
                №
            </th>
            <th width="350px;">
                Название вакансии
            </th>
			
			<?php foreach($this->months as $k=>$v) {?>							
					<th style="text-align: center; padding: 0px;">
						
						<?php echo "<div>".$k."</div>";?>
						
						<?php 
						echo "<div>";
							for($y=1;$y<=$v;$y++) {
								echo "<div style='float: left; border: 1px solid #ddd; width: 15px;'>".$y."</div>";								
							}	
						echo "</div>"		
						?>
					
					</th>
			<?php }?>
        </tr>
        </thead>
		
        <tfoot>
            <td colspan="9" style="border-top: 1px solid #ddd; border-right: 0px; background: none;">
                <?php //echo $this->pagination->getListFooter(); ?>
            </td>
        </tfoot>
		
		
        <tbody>
        <?php if (!empty($this->requests)) : ?>
            <?php foreach ($this->requests as $i => $row) :?>
                <tr>
                    <td style="border-left: 1px solid #ddd;">
						<?php echo $this->pagination->getRowOffset($i); ?>
					</td>
                    <td> 
						<?php 
						$link = "index.php?option=com_recruit&view=requesthr&layout=edit&id=".$row->id;
						
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
								
								//echo date("Y-m-d", $current); die;
								
								$request_public = strtotime($row->public_date);
								$request_estimate = strtotime($row->estimate_date);
								
								if($current >= $request_public && $current <= $request_estimate) {
									echo "<div style='float: left; border: 1px solid #ddd; width: 15px; height: 32px; background-color: #ffff00;'>&nbsp;</div>";	
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


<!--    <input type="hidden" name="view" value="credit" />-->
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
</div>


<!--<button type="button" class="btn btn-success">Создать</button>-->