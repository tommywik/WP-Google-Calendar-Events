<?php

/**
 * Display for Feed Custom Post Types
 *
 * @package   GCE
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014 Phil Derksen
 */

	global $post;
	
	$post_id = $post->ID;
	
	// Clear the cache if the button was clicked to do so
	if( isset( $_GET['clear_cache'] ) && $_GET['clear_cache'] == 1 ) {
		gce_clear_cache( $post_id );
	}
	
	// Load up all post meta data
	$gce_feed_url                    = get_post_meta( $post->ID, 'gce_feed_url', true );
	$gce_date_format                 = get_post_meta( $post->ID, 'gce_date_format', true );
	$gce_time_format                 = get_post_meta( $post->ID, 'gce_time_format', true );
	$gce_cache                       = get_post_meta( $post->ID, 'gce_cache', true );
	$gce_multi_day_events            = get_post_meta( $post->ID, 'gce_multi_day_events', true );
	$gce_display_mode                = get_post_meta( $post->ID, 'gce_display_mode', true );
	$gce_search_query                = get_post_meta( $post->ID, 'gce_search_query', true );
	$gce_expand_recurring            = get_post_meta( $post->ID, 'gce_expand_recurring', true );
	$gce_paging                      = get_post_meta( $post->ID, 'gce_paging', true );
	$gce_events_per_page             = get_post_meta( $post->ID, 'gce_events_per_page', true );
	$gce_per_page_num                = get_post_meta( $post->ID, 'gce_per_page_num', true );
	$gce_per_page_from               = get_post_meta( $post->ID, 'gce_per_page_from', true );
	$gce_per_page_to                 = get_post_meta( $post->ID, 'gce_per_page_to', true );
	$gce_list_start_offset_num       = get_post_meta( $post->ID, 'gce_list_start_offset_num', true );
	$gce_list_start_offset_direction = get_post_meta( $post->ID, 'gce_list_start_offset_direction', true );
	$gce_feed_start                  = get_post_meta( $post->ID, 'gce_feed_start', true );
	$gce_feed_start_num              = get_post_meta( $post->ID, 'gce_feed_start_num', true );
	$gce_feed_start_custom           = get_post_meta( $post->ID, 'gce_feed_start_custom', true );
	$gce_feed_end                    = get_post_meta( $post->ID, 'gce_feed_end', true );
	$gce_feed_end_num                = get_post_meta( $post->ID, 'gce_feed_end_num', true );
	$gce_feed_end_custom             = get_post_meta( $post->ID, 'gce_feed_end_custom', true );
	
	
	if( empty( $gce_events_per_page ) ) {
		$gce_events_per_page = 'days';
	}
	
	if( empty( $gce_list_start_offset_num ) ) {
		$gce_list_start_offset_num = 0;
	}
	
	if( empty( $gce_feed_start ) ) {
		$gce_feed_start = 0;
	}
	
	if( empty( $gce_feed_end ) ) {
		$gce_feed_end = 0;
	}
?>

<div id="gce-admin-promo">
	<?php echo __( 'We\'re <strong>smack dab</strong> in the middle of building additional features for this plugin. Have ideas?', 'gce' ); ?>
	<strong>
		<a href="https://trello.com/b/ZQSzsarY" target="_blank">
			<?php echo __( 'Visit our roadmap and tell us what you\'re looking for', 'gce' ); ?>
		</a>
	</strong>
	<br/>
	<br/>

	<?php echo __( 'Want to be in the know?', 'gce' ); ?>
	<strong>
		<a href="http://eepurl.com/0_VsT" target="_blank">
			<?php echo __( 'Get notified when new features are released', 'gce' ); ?>
		</a>
	</strong>
</div>

<table class="form-table">
	<tr>
		<th scope="row"><?php _e( 'Feed Shortcode', 'gce' ); ?></th>
		<td>
			<code>[gcal id="<?php echo $post_id; ?>"]</code>
			<p class="description">
				<?php _e( 'Copy and paste this shortcode to display this Google Calendar feed on any post or page.', 'gce' ); ?>
				<?php _e( 'To avoid display issues, make sure to paste the shortcode in the Text tab of the post editor.', 'gce' ); ?>
			</p>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="gce_feed_url"><?php _e( 'Google Calendar ID', 'gce' ); ?></label></th>
		<td>
			<input type="text" class="regular-text" style="width: 30em;" name="gce_feed_url" id="gce_feed_url" value="<?php echo $gce_feed_url; ?>" />
			<p class="description">
				<?php _e( 'The Google Calendar ID.', 'gce' ); ?> <?php _e( 'Example', 'gce' ); ?>:<br/>
				<code>umsb0ekhivs1a2ubtq6vlqvcjk@group.calendar.google.com</code><br/>
				<a href="<?php echo gce_ga_campaign_url( 'http://wpdocs.philderksen.com/google-calendar-events/getting-started/find-calendar-id/', 'gce_lite', 'settings_link', 'docs' ); ?>" target="_blank"><?php _e( 'How to find your GCal calendar ID', 'gce' ); ?></a>
			</p>
		</td>
	</tr>

	<tr>
		<th scope="row"><label for="gce_search_query"><?php _e( 'Search Query', 'gce' ); ?></label></th>
		<td>
			<input type="text" class="" name="gce_search_query" id="gce_search_query" value="<?php echo $gce_search_query; ?>" />
			<p class="description"><?php _e( 'Find and show events based on a search query.', 'gce' ); ?></p>
		</td>
	</tr>

	<tr>
		<th scope="row"><label for="gce_expand_recurring"><?php _e( 'Expand Recurring Events?', 'gce' ); ?></label></th>
		<td>
			<input type="checkbox" name="gce_expand_recurring" id="gce_expand_recurring" value="1" <?php checked( $gce_expand_recurring, '1' ); ?> /> <?php _e( 'Yes', 'gce' ); ?>
			<p class="description"><?php _e( 'This will show recurring events each time they occur, otherwise it will only show the event the first time it occurs.', 'gce' ); ?></p>
		</td>
	</tr>

	<tr>
		<th scope="row"><label for="gce_date_format"><?php _e( 'Date Format', 'gce' ); ?></label></th>
		<td>
			<input type="text" class="" name="gce_date_format" id="gce_date_format" value="<?php echo $gce_date_format; ?>" />
			<p class="description">
				<?php printf( __( 'Use %sPHP date formatting%s.', 'gce' ), '<a href="http://php.net/manual/en/function.date.php" target="_blank">', '</a>' ); ?>
				<?php _e( 'Leave blank to use the default.', 'gce' ); ?>
			</p>
		</td>
	</tr>

	<tr>
		<th scope="row"><label for="gce_time_format"><?php _e( 'Time Format', 'gce' ); ?></label></th>
		<td>
			<input type="text" class="" name="gce_time_format" id="gce_time_format" value="<?php echo $gce_time_format; ?>" />
			<p class="description">
				<?php printf( __( 'Use %sPHP date formatting%s.', 'gce' ), '<a href="http://php.net/manual/en/function.date.php" target="_blank">', '</a>' ); ?>
				<?php _e( 'Leave blank to use the default.', 'gce' ); ?>
			</p>
		</td>
	</tr>

	<tr>
		<th scope="row"><label for="gce_cache"><?php _e( 'Cache Duration', 'gce' ); ?></label></th>
		<td>
			<input type="text" class="" name="gce_cache" id="gce_cache" value="<?php echo $gce_cache; ?>" />
			<p class="description"><?php _e( 'The length of time, in seconds, to cache the feed (43200 = 12 hours). If this feed changes regularly, you may want to reduce the cache duration.', 'gce' ); ?></p>
		<td>
	</tr>

	<tr>
		<th scope="row"><label for="gce_multi_day_events"><?php _e( 'Multiple Day Events', 'gce' ); ?></label></th>
		<td>
			<input type="checkbox" name="gce_multi_day_events" id="gce_multi_day_events" value="1" <?php checked( $gce_multi_day_events, '1' ); ?> /> <?php _e( 'Show on each day', 'gce' ); ?>
			<p class="description"><?php _e( 'Show events that span multiple days on each day that they span, rather than just the first day.', 'gce' ); ?></p>
		</td>
	</tr>

	<tr>
		<th scope="row"><label for="gce_display_mode"><?php _e( 'Display Mode', 'gce' ); ?></label></th>
		<td>
			<select name="gce_display_mode" id="gce_display_mode">
				<option value="grid" <?php selected( $gce_display_mode, 'grid', true ); ?>><?php _e( 'Grid', 'gce' ); ?></option>
				<option value="list" <?php selected( $gce_display_mode, 'list', true ); ?>><?php _e( 'List', 'gce' ); ?></option>
				<option value="list-grouped" <?php selected( $gce_display_mode, 'list-grouped', true ); ?>><?php _e( 'Grouped List', 'gce' ); ?></option>
			</select>
			<p class="description"><?php _e( 'Choose how you want your calendar to be displayed.', 'gce' ); ?></p>
		</td>
	</tr>
	
	<tr>
		<th scope="row"><label for="gce_paging"><?php _e( 'Show Paging Links', 'gce' ); ?></label></th>
		<td>
			<input type="checkbox" name="gce_paging" id="gce_paging" value="1" <?php checked( $gce_paging, '1' ); ?> /> <?php _e( 'Check this option to display Next and Back navigation links.', 'gce' ); ?>
		</td>
	</tr>
	
	<tr>
		<th scope="row"><label for="gce_events_per_page"><?php _e( 'Events per Page', 'gce' ); ?></label></th>
		<td>
			<select id="gce_events_per_page" name="gce_events_per_page">
				<option value="days" <?php selected( $gce_events_per_page, 'days', true ); ?>><?php _e( 'Number of Days', 'gce' ); ?></option>
				<option value="events" <?php selected( $gce_events_per_page, 'events', true ); ?>><?php _e( 'Number of Events', 'gce' ); ?></option>
				<option value="week" <?php selected( $gce_events_per_page, 'week', true ); ?>><?php _e( 'This Week', 'gce' ); ?></option>
				<option value="month" <?php selected( $gce_events_per_page, 'month', true ); ?>><?php _e( 'This Month', 'gce' ); ?></option>
				<option value="custom" <?php selected( $gce_events_per_page, 'custom', true ); ?>><?php _e( 'Custom Date Range', 'gce' ); ?></option>
			</select>
			<span class="gce_per_page_num_wrap <?php echo ( $gce_events_per_page != 'days' && $gce_events_per_page != 'events' ? 'gce-admin-hidden' : '' ); ?>">
				<input type="number" min="0" step="1" class="small-text" name="gce_per_page_num" id="gce_per_page_num" value="<?php echo $gce_per_page_num; ?>" />
			</span>
			<span class="gce_per_page_custom_wrap <?php echo ( $gce_events_per_page != 'custom' ? 'gce-admin-hidden' : '' ); ?>">
				<input type="text" name="gce_per_page_from" id="gce_per_page_from" value="<?php echo $gce_per_page_from; ?>" /> 
				<?php _ex( 'to', 'separator between custom date range fields', 'gce' ); ?> 
				<input type="text" name="gce_per_page_to" id="gce_per_page_to" value="<?php echo $gce_per_page_to; ?>" />
			</span>
		</td>
	</tr>
	
	<tr>
		<th scope="row"><label for="gce_list_start_offset_num"><?php _e( 'Display Start Date Offset', 'gce' ); ?></label></th>
		<td>
			<input type="number" min="0" step="1" class="small-text" id="gce_list_start_offset_num" name="gce_list_start_offset_num" value="<?php echo $gce_list_start_offset_num; ?>" />
			<?php _e( 'Days', 'gce' ); ?>
			<select name="gce_list_start_offset_direction" id="gce_list_start_offset_direction">
				<option value="back" <?php selected( $gce_list_start_offset_direction, 'back', true ); ?>><?php _e( 'Back', 'gce' ); ?></option>
				<option value="ahead" <?php selected( $gce_list_start_offset_direction, 'ahead', true ); ?>><?php _e( 'Ahead', 'gce' ); ?></option>
			</select>
			<p class="description"><?php _e( 'Change if you need to initially display events on a date other than today (List View only).', 'gce' ); ?></p>
		</td>	
	</tr>
	
	<tr>
		<th scope="row"><label for="gce_feed_start"><?php _e( 'Earliest Available Event Date', 'gce' ); ?></label></th>
		<td>
			<select id="gce_feed_start" name="gce_feed_start">
				<option value="days" <?php selected( $gce_feed_start, 'days', true ); ?>><?php _e( 'Number of Days Back', 'gce' ); ?></option>
				<option value="months" <?php selected( $gce_feed_start, 'months', true ); ?>><?php _e( 'Number of Months Back', 'gce' ); ?></option>
				<option value="years" <?php selected( $gce_feed_start, 'years', true ); ?>><?php _e( 'Number of Years Back', 'gce' ); ?></option>
				<option value="custom" <?php selected( $gce_feed_start, 'custom', true ); ?>><?php _e( 'Custom Date', 'gce' ); ?></option>
			</select>
			<span class="gce_feed_start_num_wrap <?php echo ( $gce_feed_start == 'custom' ? 'gce-admin-hidden' : '' ); ?>">
				<input type="number" min="0" step="1" class="small-text" id="gce_feed_start_num" name="gce_feed_start_num" value="<?php echo $gce_feed_start_num; ?>" />
			</span>
			<span class="gce_feed_start_custom_wrap <?php echo ( $gce_feed_start != 'custom' ? 'gce-admin-hidden' : '' ); ?>">
				<input type="text" id="gce_feed_start_custom" name="gce_feed_start_custom" value="<?php echo $gce_feed_start_custom; ?>" />
			</span>
		</td>	
	</tr>
	
	<tr>
		<th scope="row"><label for="gce_feed_end"><?php _e( 'Latest Available Event Date', 'gce' ); ?></label></th>
		<td>
			<select id="gce_feed_end" name="gce_feed_end">
				<option value="days" <?php selected( $gce_feed_end, 'days', true ); ?>><?php _e( 'Number of Days Forward', 'gce' ); ?></option>
				<option value="months" <?php selected( $gce_feed_end, 'months', true ); ?>><?php _e( 'Number of Months Forward', 'gce' ); ?></option>
				<option value="years" <?php selected( $gce_feed_end, 'years', true ); ?>><?php _e( 'Number of Years Forward', 'gce' ); ?></option>
				<option value="custom" <?php selected( $gce_feed_end, 'custom', true ); ?>><?php _e( 'Custom Date', 'gce' ); ?></option>
			</select>
			<span class="gce_feed_end_num_wrap <?php echo ( $gce_feed_end == 'custom' ? 'gce-admin-hidden' : '' ); ?>">
				<input type="number" min="0" step="1" class="small-text" id="gce_feed_end_num" name="gce_feed_end_num" value="<?php echo $gce_feed_end_num; ?>" />
			</span>
			<span class="gce_feed_end_custom_wrap <?php echo ( $gce_feed_end != 'custom' ? 'gce-admin-hidden' : '' ); ?>">
				<input type="text" id="gce_feed_end_custom" name="gce_feed_end_custom" value="<?php echo $gce_feed_end_custom; ?>" />
			</span>
		</td>
	</tr>
</table>
