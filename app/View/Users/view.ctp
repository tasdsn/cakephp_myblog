<!-- File: /app/View/Users/view.ctp -->
<p>Name:<?php echo $user['User']['username']; ?></p>
<p>image:<br>
<?php if ($user['User']['image_name']): ?>
<?php echo $this->Html->image($user['User']['image_name'], array('alt' => '未登録')); ?>
<?php else: ?>
未登録
<?php endif; ?>
</p>
<p>Email:<?php echo $user['User']['email']; ?></p>
<p>Comment:<?php echo $user['User']['comment']; ?></p>
<p>
<?php
if ($user['User']['id'] == $login_user['id']) {
    echo $this->Html->link(
        'Edit',
        array('action' => 'edit', $user['User']['id'])
    );
}
?>
</p>
<?php echo $this->Html->link('Top', array('controller' => 'posts', 'action' => 'index')); ?>
