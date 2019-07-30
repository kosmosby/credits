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


    <br />


    <br />
    <br />
    <br />

    <br />

    <table class="table table-striped table-hover" id="credits_table">
        <thead>
        <tr>
            <th style="border-left: 1px solid #ddd;" width="5%">
                №
            </th>
            <th width="5%">
                <?php echo JHtml::_('grid.checkall'); ?>
            </th>
            <th>

            </th>
            <th>
                Тип заявки
            </th>
            <th>
                Сотрудник
            </th>
            <th>
                Тип
            </th>
            <th>
                Кол-во
            </th>
            <th>
                Дата разм.
            </th>
            <th>
                Дата закр.
            </th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="14" style="border-top: 1px solid #ddd; border-right: 0px; background: none;">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) :
                $link = JRoute::_('index.php?option=com_recruit&task=requesthr.edit&id=' . $row->id);
                ?>
                <tr>
                    <td style="border-left: 1px solid #ddd;"><?php echo $this->pagination->getRowOffset($i); ?></td>
                    <td>
                        <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                    </td>
                    <td>
                        <?php echo $row->type_name; ?>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>" title="Редактировать">
                            <?php echo $row->name; ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $row->typeemployee_name; ?>
                    </td>
                    <td>
                        <?php echo $row->count; ?>
                    </td>
                    <td>
                        <?php echo $row->start_date; ?>
                    </td>
                    <td>
                        <?php echo $row->estimate_date; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>


<!--    <input type="hidden" name="view" value="credit" />-->
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>


<!--<button type="button" class="btn btn-success">Создать</button>-->
