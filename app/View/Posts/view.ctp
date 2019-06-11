<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p>Name:<?php echo $post['User']['username']; ?></p>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>

<?php echo $this->Html->link('Top', array('action' => 'index')); ?>
