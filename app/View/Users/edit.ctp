<!-- app/View/Users/edit.ctp -->
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Document', array('enctype' => 'multipart/form-data'));
//echo $this->Form->input('image', array('type' => 'file'));
echo $this->Form->input('image', array('type' => 'file'));
echo $this->Form->create('User');

echo $this->Form->input('comment');
echo $this->Form->end('Save User');
?>
<p><?php echo $this->Html->link('View', array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?></p>
<p><?php echo $this->Html->link('Top', array('controller' => 'posts', 'action' => 'index')); ?></p>

