<div class="form-horizontal">
    <?php foreach ($this->additionForm->getFieldsets() as $name => $fieldset): ?>
        <fieldset class="adminform">
            <legend><?php echo JText::_($fieldset->label); ?></legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php foreach ($this->additionForm->getFieldset($name) as $field): ?>
                        <div class="control-group">
                            <div class="control-label"><?php echo $field->label; ?></div>
                            <div class="controls"><?php echo $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </fieldset>
    <?php endforeach; ?>
</div>
