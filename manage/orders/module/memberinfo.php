
<div class="act_form">
	<table width="100%" border="0" cellpadding="0" cellspacing="1">
		<tr align="center" class="act_form_title">
			<td width="50%" nowrap><strong>学生信息</strong></td>
			<td width="50%" nowrap><strong>老师信息</strong></td>
		</tr>
		<tr>
			<td valign="top" style="padding:10px;" class="flh_150">
            	<?php $student = $db->get_one('member',"MemberId={$order_row['MemberId']}");?>
				<div id="shipping_address_info" style="display:;">
                	<strong>会员ID:</strong> <?=$student['ID']?><br />
					<strong>昵称:</strong> <?=$student['UserName']?><br />
                    <strong>性别:</strong> <?=$student['Title']?><br />
                    <strong>邮箱:</strong> <?=$student['Email']?><br />
                    <strong>电话:</strong> <?=$student['Phone']?><br />
				</div>
			</td>
			<td valign="top" style="padding:10px;" class="flh_150">
            	<?php $teacher = $db->get_one('member',"MemberId={$order_row['TeacherId']}");?>
				<div id="billing_address_info" style="display:;">
                	<strong>会员ID:</strong> <?=$teacher['ID']?><br />
					<strong>昵称:</strong> <?=$teacher['UserName']?><br />
                    <strong>性别:</strong> <?=$teacher['Title']?><br />
                    <strong>邮箱:</strong> <?=$teacher['Email']?><br />
                    <strong>电话:</strong> <?=$teacher['Phone']?><br />
				</div>
			</td>
		</tr>
	</table>
</div>