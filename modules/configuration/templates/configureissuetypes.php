<?php

	$bugs_response->setTitle(__('Configure issue types'));
	$bugs_response->addJavascript('config/issuetypes.js');

?>
<table style="table-layout: fixed; width: 100%" cellpadding=0 cellspacing=0>
<tr>
<?php include_component('configleftmenu', array('selected_section' => 6)); ?>
<td valign="top">
	<div style="width: 750px;" id="config_issuetypes">
		<div class="configheader"><?php echo __('Configure issue types'); ?></div>
		<div class="content"><?php echo __('Edit issue types and their settings here.'); ?></div>
		<div class="header_div" style="margin-top: 15px;"><?php echo __('Issue types'); ?></div>
		<?php foreach ($issue_types as $type): ?>
			<div class="rounded_box borderless" style="margin: 5px 0 0 0;">
				<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
				<div class="xboxcontent" style="padding: 5px; font-size: 12px;">
					<?php echo image_tag('spinning_32.gif', array('style' => 'float: right; margin-left: 5px; display: none;', 'id' => 'issuetype_' . $type->getID() . '_indicator')); ?>
					<div class="header"><a href="javascript:void(0);" onclick="showIssuetypeOptions('<?php echo make_url('configure_issuetypes_getoptions', array('id' => $type->getID())); ?>', <?php echo $type->getID(); ?>);" id="issuetype_<?php echo $type->getID(); ?>_name_link"><?php echo $type->getName(); ?></a></div>
					<a title="<?php echo __('Edit this issue type'); ?>" href="javascript:void(0);" onclick="$('edit_issuetype_<?php echo $type->getID(); ?>_form').toggle();$('issuetype_<?php echo $type->getID(); ?>_info').toggle();" class="image" style="float: right; margin-right: 5px;"><?php echo image_tag('icon_edit.png'); ?></a>
					<a title="<?php echo __('Show and edit available choices'); ?>" href="javascript:void(0);" onclick="showIssuetypeOptions('<?php echo make_url('configure_issuetypes_getoptions', array('id' => $type->getID())); ?>', <?php echo $type->getID(); ?>);" class="image" style="float: right; margin-right: 5px;"><?php echo image_tag('action_dropdown_small.png'); ?></a>
					<div id="issuetype_<?php echo $type->getID(); ?>_info">
						<b><?php echo __('Description'); ?>:</b>&nbsp;<span id="issuetype_<?php echo $type->getID(); ?>_description_span"><?php echo $type->getDescription(); ?></span><br>
					</div>
					<form accept-charset="<?php echo BUGScontext::getI18n()->getCharset(); ?>" action="<?php echo make_url('configure_issuetypes_update_issuetype', array('id' => $type->getID())); ?>" onsubmit="updateIssuetype('<?php echo make_url('configure_issuetypes_update_issuetype', array('id' => $type->getID())); ?>', <?php echo $type->getID(); ?>);return false;" id="edit_issuetype_<?php echo $type->getID(); ?>_form" style="display: none;">
						<div class="rounded_box white" style="margin: 5px 0 0 0;">
							<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
							<div class="xboxcontent" style="padding: 3px; font-size: 12px;">
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td style="vertical-align: top; padding-top: 5px;"><label for="issuetype_<?php echo $type->getID(); ?>_name"><?php echo __('Name'); ?></label></td>
										<td><input type="text" name="name" id="issuetype_<?php echo $type->getID(); ?>_name" value="<?php echo $type->getName(); ?>" style="width: 300px;"><br></td>
									</tr>
									<tr>
										<td style="vertical-align: top; padding-top: 5px;"><label for="issuetype_<?php echo $type->getID(); ?>_icon"><?php echo __('Issue type'); ?></label></td>
										<td>
											<select name="icon" id="issuetype_<?php echo $type->getID(); ?>_icon">
												<?php foreach ($icons as $icon => $description): ?>
													<option value="<?php echo $icon; ?>"<?php if ($type->getIcon() == $icon): ?> selected<?php endif; ?>><?php echo $description; ?></option>
												<?php endforeach; ?>
											</select>
											<div class="faded_medium" style="margin-bottom: 10px; padding: 2px; font-size: 12px;"><?php echo __('Whether to forward the user to the reported issue after it has been reported'); ?>.</div>
										</td>
									</tr>
									<tr>
										<td style="vertical-align: top; padding-top: 5px;"><label for="issuetype_<?php echo $type->getID(); ?>_reportable"><?php echo __('Reportable'); ?></label></td>
										<td>
											<select name="reportable" id="issuetype_<?php echo $type->getID(); ?>_reportable">
												<option value="1"<?php if ($type->isReportable()): ?> selected<?php endif; ?>><?php echo __('Users can report new issues with this issue type'); ?></option>
												<option value="0"<?php if (!$type->isReportable()): ?> selected<?php endif; ?>><?php echo __('Users cannot report new issues with this issue type'); ?></option>
											</select>
											<div class="faded_medium" style="margin-bottom: 10px; padding: 2px; font-size: 12px;"><?php echo __('Whether to forward the user to the reported issue after it has been reported'); ?>.</div>
										</td>
									</tr>
									<tr>
										<td style="vertical-align: top; padding-top: 5px;"><label for="issuetype_<?php echo $type->getID(); ?>_description"><?php echo __('Description'); ?></label></td>
										<td>
											<input type="text" name="description" id="issuetype_<?php echo $type->getID(); ?>_description" value="<?php echo $type->getDescription(); ?>" style="width: 600px;">
											<div class="faded_medium" style="margin-bottom: 10px; padding: 2px; font-size: 12px;"><?php echo __('Users see this description when choosing an issue type to report'); ?>.</div>
										</td>
									</tr>
									<tr>
										<td style="vertical-align: top; padding-top: 5px;"><label for="issuetype_<?php echo $type->getID(); ?>_redirect"><?php echo __('Redirect'); ?></label></td>
										<td>
											<select name="redirect_after_reporting" id="issuetype_<?php echo $type->getID(); ?>_redirect">
												<option value="1"<?php if ($type->getRedirectAfterReporting()): ?> selected<?php endif; ?>><?php echo __('Redirect to the reported issue after it has been reported'); ?></option>
												<option value="0"<?php if (!$type->getRedirectAfterReporting()): ?> selected<?php endif; ?>><?php echo __('Reload a blank "%report_issue%" page with a link to the reported issue at the top', array('%report_issue%' => __('Report issue'))); ?></option>
											</select>
											<div class="faded_medium" style="margin-bottom: 10px; padding: 2px; font-size: 12px;"><?php echo __('Whether to forward the user to the reported issue after it has been reported'); ?>.</div>
										</td>
									</tr>
								</table>
								<input type="submit" value="<?php echo __('Update details'); ?>" style="font-weight: bold; font-size: 13px;">
								<?php echo __('%update_details% or %cancel%', array('%update_details%' => '', '%cancel%' => '<a href="javascript:void(0);" onclick="$(\'edit_issuetype_' . $type->getID() . '_form\').toggle();$(\'issuetype_' . $type->getID() . '_info\').toggle();"><b>' . __('cancel') . '</b></a>')); ?>
								<?php echo image_tag('spinning_20.gif', array('style' => 'margin-left: 5px; display: none;', 'id' => 'edit_issuetype_' . $type->getID() . '_indicator')); ?>
							</div>
							<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
						</div>
					</form>
					<div class="content" id="issuetype_<?php echo $type->getID(); ?>_content" style="display: none;"> </div>
				</div>
				<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
			</div>
		<?php endforeach; ?>
		<div class="header_div" style="margin-top: 20px;"><?php echo __('Add a new issue type'); ?></div>
		<div class="rounded_box lightyellow_borderless" style="margin: 5px 0 0 0;">
			<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
			<div class="xboxcontent" style="padding: 3px; font-size: 12px;">
				<form accept-charset="<?php echo BUGScontext::getI18n()->getCharset(); ?>" action="<?php echo make_url('configure_issuefields_add_customtype'); ?>" onsubmit="addIssuefieldCustom('<?php echo make_url('configure_issuefields_add_customtype'); ?>');return false;" id="add_issuetype_form">
					<label for="new_issuetype_name"><?php echo __('Issue type name'); ?></label>
					<input type="text" name="name" id="new_issuetype_name" style="width: 200px;">
					<input type="submit" value="<?php echo __('Add'); ?>" style="font-weight: bold;" id="add_issuetype_button">
					<?php echo image_tag('spinning_16.gif', array('style' => 'margin-right: 5px; display: none;', 'id' => 'add_issuetype_indicator')); ?>
				</form>
			</div>
			<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
		</div>
	</div>
</td>
</tr>
</table>