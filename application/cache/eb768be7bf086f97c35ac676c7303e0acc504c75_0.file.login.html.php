<?php
/* Smarty version 3.1.31, created on 2017-08-03 11:09:23
  from "D:\www\yaf\application\views\Admin\login.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_598293e36a0db8_65800071',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb768be7bf086f97c35ac676c7303e0acc504c75' => 
    array (
      0 => 'D:\\www\\yaf\\application\\views\\Admin\\login.html',
      1 => 1501729721,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598293e36a0db8_65800071 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

		
		
		
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_706598293e369b798_11120975', "body");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "Admin/index.php");
}
/* {block "body"} */
class Block_706598293e369b798_11120975 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_706598293e369b798_11120975',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


	
		<style type="text/css">
			body { background: url(/static/images/bg-login.jpg) !important; }
		</style>
<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Login to your account</h2>
					<form class="form-horizontal" action="index.html" method="post">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="username" id="username" type="text" placeholder="type username"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
							</div>
							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>

							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
					</form>
					<hr>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	    <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-content">
				<ul class="list-inline item-details">
					<li><a href="#">Admin templates</a></li>
					<li><a href="http://themescloud.org">Bootstrap themes</a></li>
				</ul>
			</div>
		</div>
<?php
}
}
/* {/block "body"} */
}