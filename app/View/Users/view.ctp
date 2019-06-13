<!-- File: /app/View/Users/view.ctp -->

<p>Name:<?php echo $user['User']['username']; ?></p>
<p>image:<?php var_dump($img); ?></p>
<p>Email:<?php echo $user['User']['email']; ?></p>
<p>Comment:<?php echo $user['User']['comment']; ?></p>
編集リンク
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
