<!-- File: /app/View/Users/login.ctp -->

<div class='users form'>
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your email and password'); ?>
        </legend>
        <?php 
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add')); ?><br>
<?php echo $this->Html->link('Top', array('controller' => 'posts', 'action' => 'index')); ?>
