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
jimport( 'joomla.html.html.jgrid' );


?>

<style type="text/css">
    .table th, .table td {
        text-align: center;
    }


    body.site {
        border-top: 0px;
    }

    .table input {
        width: 70px;
    }
</style>

<div style="float: left;">
<?php echo $this->toolbar->render(); ?>
</div>

<div style="clear: both;"></div>
<br />
<div>
    <h3>
    <?php echo $this->item->name;?>
    </h3>
</div>


<script type="text/javascript">

</script>


<form action="index.php" method="post" name="adminForm" id="adminForm">
    </div>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="1%">№</th>

            <th>
                <div style="visibility: hidden";>
                <?php echo JHtml::_('grid.checkall'); ?>
                </div>
            </th>

            <th align="center">
                Дата очередного платежа
            </th>
            <th >
                Сумма выплаты
            </th>
            <th>
                Отметка о платеже
            </th>
<!--            <th>-->
<!--                Оплата по факту-->
<!--            </th>-->
        </tr>
        </thead>
        <tfoot>

        <tbody>
<!---->
<!--        --><?php
//        echo "<pre>";
//        print_r($this->items);
//        echo "</pre>";
//        ?>
<!---->

        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) :

                $variables = array($row->credit_id, $row->payment_date, $row->sum_for_payment, $row->payment_id);

                $style="style='background-color: #fffe99;'";
                $class = ($row->next_payment_date)?'':$style;

                ?>
                <tr>
                    <td <?php echo $class;?>><?php echo $this->pagination->getRowOffset($i); ?></td>

                    <td <?php echo $class;?>>
                        <div style="visibility: hidden";>
                        <?php echo JHtml::_('grid.id', $i, implode(',',$variables)); ?>
                        </div>
                    </td>

                    <td <?php echo $class;?>>
                        <?php echo $row->payment_date;?>
                    </td>
                    <td align="center" <?php echo $class;?>>
                        <?php echo $this->item->currency; ?>
                        <input type="text" name="sum_for_payment" id="payment_<?php echo $row->payment_id;?>" value="<?php echo $row->sum_for_payment;?>">
                    </td>
                    <td <?php echo $class;?>>
                        <?php //echo JHtml::_('jgrid.published', $row->payed, $i, 'payments.');?>

                        <a
                            class="btn btn-micro active hasTooltip"
                            href="javascript:void(0);"
                            onclick="return listItemTask('cb<?php echo $i;?>','payments.<?php echo ($row->payed)?"publish":"unpublish";?>')"
                            title=""
                            data-original-title="Отметка о платеже">
                            <span class="icon-<?php echo ($row->payed)?"publish":"unpublish";?>">
                            </span>
                        </a>


                    </td>
<!--                    <td>-->
<!--                        <form action="/" name="form1">-->
<!--                            <input type="text" name="inserted_payment" style="width: 60px;">-->
<!--                        </form>-->
<!--                    </td>-->

                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>


<!--    <input type="hidden" name="view" value="credit" />-->
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo JHtml::_('form.token'); ?>
</form>

<table style="float: right; margin-right: 60px;">
    <tr>
        <td align="right">
            Уже вернул:
        </td>
        <td>&nbsp;
            <?php echo $this->item->alredy_returned;?>

        </td>
    </tr>
    <tr>
        <td align="right">
            Сумма возврата:
        </td>
        <td>&nbsp;
            <?php echo $this->item->return_sum;?>
        </td>
    </tr>
</table>

<!--<div style="float: right; margin-right: 50px; ">-->
<!--    <div style="float: left;">Уже вернул:</div>-->
<!--    <div style="width: 200px;">-->
<!---->
<!--    </div>-->
<!--</div>-->
<!--<br />-->
<!---->
<!--<div style="float: right; margin-right: 50px;">-->
<!--    <div style="float: left;">Сумма возврата: &nbsp;</div>-->
<!--    <div style="width: 200px;" >-->
<!--        --><?php //echo $this->item->return_sum;?>
<!--    </div>-->
<!---->
<!--</div>-->




<!--<button type="button" class="btn btn-success">Создать</button>-->
