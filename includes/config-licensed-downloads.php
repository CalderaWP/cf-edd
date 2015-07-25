<?php
/**
 * CF EDD Licensed Downloads
 *
 * @package   Caldera_Forms_EDD
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock for CalderaWP
 */

?>

<?php //next ?>
<div class="caldera-config-group">
	<label for="edd_licensed_downloads">
		<?php _e( 'Field', 'cf-form-connector' ); ?>
	</label>
	{{{_field slug="edd_licensed_downloads" type="dropdown,select2,radio" exclude="system,variables" required="true"}}}
	<p class="description">
		<?php _e( 'Choose a select field to populate with licensed downloads for user specified in next option.', 'cf-edd' ); ?>
	</p>
</div>

<div class="caldera-config-group">
	<label for="edd_licensed_downloads_user">
		<?php _e( 'User ID', 'cf-form-connector' ); ?>
	</label>
	<div class="caldera-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled" id="edd_licensed_downloads" name="{{_name}}[edd_licensed_downloads_user]" value="{{edd_licensed_downloads_user}}" >
	</div>
	<p class="description">
		<?php _e( 'User ID to get licensed downloads for. Leave empty for current user ID. ', 'cf-edd' ); ?>
	</p>
</div>


<div class="caldera-config-group">
	<label for="edd_licensed_downloads_none">
		<?php _e( 'No licensed Downloads Found Message', 'cf-form-connector' ); ?>
	</label>
	<div class="caldera-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled" id="edd_licensed_downloads_none" name="{{_name}}[edd_licensed_downloads_none]" value="{{edd_licensed_downloads_none}}" >
	</div>

</div>



