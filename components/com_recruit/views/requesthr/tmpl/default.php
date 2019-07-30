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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

JHtml::script(Juri::base() . 'components/com_recruit/js/recruit.js');
?>

<style type="text/css">
    #toolbar-cancel {
        float: left;
    }
    #toolbar-new {
        float: left;
        margin-left: 20px;
    }
    .container {
        min-width: 500px;
    }
    body.site {
        border-top: 0px;
    }
    .adminform .span6 {
        width: 100%;
    }
</style>



<?php echo $this->toolbar->render(); ?>

<div style="clear: both;"></div>

<br />

<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'requesthr.cancel' || document.formvalidator.isValid(document.id('requesthr-form')))
        {

            if(task == 'requesthr.cancel') {
                Joomla.submitform('requests.cancel', document.getElementById('requesthr-form'));
            }
            else {
                Joomla.submitform(task, document.getElementById('requesthr-form'));
            }
        }
    }
</script>

<?php echo ($this->item->id == 0)?"<h2>Создание новой записи</h2>":"<h2>Редактирование записи</h2>";?>

<form action="<?php echo JRoute::_('index.php');?>"
      method="post" name="requesthr-form" id="requesthr-form" class="form-validate">
    <div class="form-horizontal">
        <?php foreach ($this->form->getFieldsets() as $name => $fieldset): ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_($fieldset->label); ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php foreach ($this->form->getFieldset($name) as $field): ?>
                            <div class="control-group">
                                <div class="control-label"><?php echo $field->label; ?></div>
                                <div class="controls"><?php echo $field->input; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </fieldset>
        <?php endforeach; ?>
        <fieldset class="adminform">
            <legend></legend>
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <div class="control-label">расчет срока закрытия</div>
                        <div class="controls">
                            <button class="btn btn-small button-new btn-success" id="estimate">
                                <span class="icon-apply icon-white" aria-hidden="true"></span>
                                Рассчитать</button>
                    </div>
                </div>
                    <div id="estimate_div"></div>
        </fieldset>
    </div>
    <input type="hidden" name="option" value="com_recruit" />
    <input type="hidden" name="task" value="requesthr.submit" />
    <?php echo JHtml::_('form.token'); ?>
</form>