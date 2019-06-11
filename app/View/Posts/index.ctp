<!--File: /app/View/Posts/index.ctp -->

<h1>Blog posts</h1>
<p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!--  ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <?php //投稿IDを表示 ?>
        <td><?php echo $post['Post']['id']; ?></td>
        <?php //投稿している人の名前を表示?>
        <td><?php echo $post['User']['username']; ?></td>
        <td>
            <?php 
                //タイトルにリンクを作成
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                ); 
            ?>
        </td>
        <td>
            <?php if ($post['Post']['user_id'] == $user['id']): ?>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                //ビューからヘルパーを利用する
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $post['Post']['id'])
                );
            ?>
            <?php endif; ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<p>
<?php 
if (empty($user)) {
    echo $this->Html->link(
        'Login',
        array('controller' => 'users', 'action' => 'login')
    ); 
} else {
    echo $this->Html->link(
        'Logout',
        array('controller' => 'users', 'action' => 'logout')
    );
}
    
?></p>
