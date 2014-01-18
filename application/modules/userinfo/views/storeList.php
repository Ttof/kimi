<?php echo $this->load->view('header'); ?>
<?php echo $this->load->view('menu'); ?>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table">
				<thead>
					<tr>
						<th>
							id
						</th>
						<th>
							店名
						</th>
						<th>
							主营项目
						</th>
						<th>
							地址
						</th>
						<th>
							人员
						</th>
						<th>
							工位
						</th>
						<th>
							面积
						</th>
						<th>
							设备
						</th>
						<th>
							主营配件
						</th>
						<th>
							营业时间
						</th>
						<th style="width:700px;">
							自我描述
						</th>
						<th>
							<!-- <form onchange="this.submit()" method="GET"> -->
								<select id="viewstatus">
								  <option name ='pending' value ="pending">未审核</option>
								  <option value ="pass">已审核</option>
								  <option value="all">全部</option>
								</select>
							<!-- </form>							 -->
						</th>
						<th>
							操作
						</th>
					</tr>
				</thead>
				<tbody id="maintable">
					<?php foreach ($storeInfo as $value) {						
					 ?>
					<tr class="row_<?php echo $value['id']; ?>">
						<td>
							<?php echo $value['id'] ?>
						</td>
						<td>
							<?php echo $value['storeName'] ?>
						</td>
						<td>
							<?php echo $value['mainItem'] ?>
						</td>
						<td>
							<?php echo $value['address'] ?>
						</td>
						<td>
							<?php echo $value['workers'] ?>
						</td>
						<td>
							<?php echo $value['workStations'] ?>
						</td>
						<td>
							<?php echo $value['area'] ?>
						</td>
						<td>
							<?php echo $value['equipment'] ?>
						</td>
						<td>
							<?php echo $value['mainParts'] ?>
						</td>
						<td>
							<?php echo $value['openTime'] ?>
						</td>
						<td>
							<?php echo $value['selfContents'] ?>
						</td>
						<td>
							未审核
						</td>
						<td>
							<!-- <input type="hidden" name="id" value=""> -->
							<?php if( $value['status'] == 'pending'){ ?>
							<button id="shenhe_<?php echo $value['id']; ?>" onclick='pass( <?php echo $value['id']; ?>)'>合格</button>
							<button id="shenhe_<?php echo $value['id']; ?>" onclick='deny( <?php echo $value['id']; ?>)'>不合格</button>
							<?php } ?>
							<?php if( $value['status'] == 'pass'){?>
							<button id="shenhe_<?php echo $value['id']; ?>" onclick='overView( <?php echo $value['id']; ?>)'>已审核</button>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
					
					
					
		
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php echo $this->load->view('footer'); ?>
<script type="text/javascript">
function pass( id){
	$.post( ' <?php echo base_url('userinfo/store/pass') ?>',{'id':id},
		function(data){
			if(data){
				location.reload();
			}

	});
	// window.location.reload();
}
function deny( id){
	$.post( ' <?php echo base_url('userinfo/store/deny') ?>',{'id':id},
		function( data){
			if( data){
				location.reload();
			}
		});
}
$(document).ready(function(){
	$("#viewstatus").change(function(){
		var value = $("#viewstatus").val();
		$.get(' <?php echo base_url('userinfo/store/storeList') ?>',{'selectVal':value},function( data){

			$('body').html(data);
		});
	});
});

</script>