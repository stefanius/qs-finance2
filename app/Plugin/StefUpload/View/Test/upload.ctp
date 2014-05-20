<?php
echo 'Upload a file';

echo $this->Form->create('Test', array('type' => 'file'));
echo $this->Form->input('field1', array('type' => 'file'));
echo $this->Form->input('field2', array('type' => 'text'));
//echo $this->Form->input('field3', array('type' => 'file'));
echo $this->Form->end(__('Submit'));