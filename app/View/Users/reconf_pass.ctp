<!-- File:  /app/View/Users/reconf_pass.ctp -->
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Reset Password'); ?>
        </legend>
        <?php echo $this->Form->input('password'); ?>
    </fieldset>
<?php echo $this->Form->end(__('Reset')); ?>
<?php echo $this->Html->link('Top', array('controller' => 'posts', 'action' => 'index')); ?>
    