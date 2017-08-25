<?php
/**
 * @Author: Abhilash Lohar
 */

$this->set('title', 'Login');
?>
<style>
.hide { display:none; }
</style>
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
	<div class="form-actions">
		<div class="pull-left">
			<label class="rememberme check">
			<input type="checkbox" name="remember" value="1"/>Remember me </label>
		</div>
		<div class="pull-right forget-password-block">
			<a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
		</div>
	</div>
<?= $this->Form->end() ?>
<!-- END LOGIN FORM -->
<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form main_form" >
	<div class="form-title">
		<span class="form-title">Forget Password ?</span>
		<span class="form-subtitle">Enter your mobile no to reset it.</span>
	</div>
	<div class="form-group">
		<?php  echo $this->Form->control('mobile_no',['label'=>false,'class'=>'form-control form-control-solid placeholder-no-fix mobileno smssend','autocomplete'=>'off','placeholder'=>'Mobile No.']); ?>
	</div>
	<div class="form-actions">
		<button type="button" id="back-btn" class="btn btn-default">Back</button>
		<button type="button" class="btn btn-primary pull-right submit">Submit</button>
	</div>
</form>
<!-- END FORGOT PASSWORD FORM -->
<!-- BEGIN otp FORM -->
<form class="register-form hide otpshow"  method="post">
	<p class="hint">
		 Enter your OTP:
	</p>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Mobile No.</label>
		<?php  echo $this->Form->control('mobile_no',['label'=>false,'class'=>'form-control form-control-solid placeholder-no-fix','autocomplete'=>'off','placeholder'=>'Mobile No.']); ?>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">OTP</label>
		<?php  echo $this->Form->control('otp',['label'=>false,'class'=>'form-control form-control-solid placeholder-no-fix','autocomplete'=>'off','placeholder'=>'otp']); ?>
	</div>
	<div class="form-actions">
		<button type="button"  class="btn btn-primary uppercase pull-right">Submit</button>
	</div>
</form>
<!-- END otp FORM -->
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() { 

	$(".submit").on('click',function() 
	{ 
		//$('.main_form').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
		var mobileno = $('.mobileno').val();
		if(mobileno !='')
		{
			var smssend = $('.smssend').val();
			var obj=$(this);
			var url="<?php echo $this->Url->build(['controller'=>'Users','action'=>'sendotpmobile']);?>";
			url=url+'/'+smssend,
			
			$.ajax({
				url: url,
				type: 'GET',
			}).done(function(response) {
				alert(response);
				if(response==1)
				{
					$('.main_form').html('<div style="color:#63F588">Your password reset successfully</div><div align="center"><a class="btn btn-success" href="login.php">Sign In</a></div>');
					$('.otpshow').removeClass('hide');

					
				}else
					{
					
					$('.main_form').html('<div style="color:#F43737">Your mobile no not registered</div>');
				}	
			});
		}else
		{
			alert('Please Enter Valid No');
			$('.firstdate').val('');
		}	

	});
	
			
});
</script>
