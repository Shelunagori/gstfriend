<?php
/**
 * @Author: Abhilash Lohar
 */

$this->set('title', 'Login');
?>
<!-- BEGIN LOGIN FORM -->
<?= $this->Form->create($user,['class'=>'login-form']) ?>
	<?= $this->Flash->render() ?>
	<div class="form-group">
		<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
		<label class="control-label visible-ie8 visible-ie9">Username</label>
		<?php  echo $this->Form->control('username',['label'=>false,'class'=>'form-control form-control-solid placeholder-no-fix','autocomplete'=>'off','placeholder'=>'Username']); ?>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Password</label>
		<?php  echo $this->Form->control('password',['label'=>false,'class'=>'form-control form-control-solid placeholder-no-fix','autocomplete'=>'off','placeholder'=>'Password']); ?>
	</div>
	<div class="form-actions">
		<?= $this->Form->button(__('Login'),['class'=>'btn btn-primary btn-block uppercase']) ?>
	</div>
<?= $this->Form->end() ?>
<!-- END LOGIN FORM -->