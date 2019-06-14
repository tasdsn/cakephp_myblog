<!-- app/View/Users/edit.ctp -->
<h1>Edit Post</h1>
<?php echo $this->Form->create('Document', array('enctype' => 'multipart/form-data')); ?>
<fieldset>
<?php echo $this->Form->input('image', array('type' => 'file')); ?>
</fieldset>
<?php echo $this->Form->create('User'); ?>
<fieldset>
<?php echo $this->Form->input('comment'); ?>
</fieldset>
<?php echo $this->Form->end('Save User'); ?>
<p><?php echo $this->Html->link('View', array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?></p>
<p><?php echo $this->Html->link('Top', array('controller' => 'posts', 'action' => 'index')); ?></p>

