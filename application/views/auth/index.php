<h1><?php echo lang('index_heading');?></h1>
<p><?php echo lang('index_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<table cellpadding=0 cellspacing=10>
	<tr>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
        <?php
        if($this->ion_auth->is_admin()){
        ?>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
        <th>Elimina</th>
        <? } ?>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
            <?php if($this->ion_auth->is_admin()){	?>
            <td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php  echo ($user->active) ? anchor("dashboard/auth/deactivate/".$user->id, lang('index_active_link')) : anchor("dashboard/auth/activate/". $user->id, lang('index_inactive_link')); ?></td>
			<td><?php echo anchor("dashboard/auth/edit_user/".$user->id, 'Edit');?></td>
            <td><a href="#"> Elimina </a></td>
            <? } ?>

            </tr>
	<?php endforeach;?>
</table>
<? if($this->ion_auth->is_admin()){ ?>
<p><?php echo anchor('dashboard/auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
<?}?>
<a class="btn" href="<? echo base_url().'dashboard';?>"><i class="fa fa-angle-left"></i> Back </a>