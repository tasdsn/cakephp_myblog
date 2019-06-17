<!-- app/View/Users/forgot_pass.ctp -->
<h1>Forgot Password</h1>
<?php echo $this->Form->create(); ?>
<fieldset>
    <legend>
        <?php echo __('Please enter your email'); ?>
    </legend>
    <?php echo $this->Form->input('email'); ?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<?php echo $this->Html->link('Top', array('controller' => 'posts', 'action' => 'index')); ?>
