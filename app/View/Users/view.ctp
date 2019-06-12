<!-- File: /app/View/Users/view.ctp -->

<p>Name:<?php echo h($user['User']['username']); ?></p>
<p>image:</p>
<p>Email:<?php echo $user['User']['email']; ?></p>
<p>Comment:<?php echo $user['User']['comment']; ?></p>
編集リンク
<p>
<?php
if ($user['id'] == $post['user_id']) {
    var_dump($user);
    echo $this->Html->link(
        'Edit',
        array('controlelr' => 'users', 'action' => 'edit')
    );
}
?>
</p>
<?php echo $this->Html->link('Top', array('controller' => 'posts', 'action' => 'index')); ?>
