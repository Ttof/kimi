<?php echo $this->load->view('header'); ?>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="list-group">
				 <a href="#" class="list-group-item active">入口</a>
				
				<div class="list-group-item">
					

					<div class="row clearfix main-box">
						<div class="col-md-12 column login-box">
							<form class="form-horizontal" role="form" method="POST">
								<div class="form-group">
									 <label for="inputEmail3" class="col-sm-2 control-label">账号</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="inputEmail3" name="name" value= "<?php echo set_value('name'); ?>" />
									</div>
								</div>
								<div class="form-group">
									 <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="inputPassword3" name="passwd" value="<?php set_value('passwd');  ?>" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										 <button type="submit" class="btn btn-default">登陆</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				 <a class="list-group-item active"><span class="badge"></span>Copyright © ******** 2013 备000000号 All rights reserved. 	</a>
			</div>
		</div>
	</div>
</div>



<?php echo $this->load->view('footer'); ?>