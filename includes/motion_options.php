<?php
#################################################
#################################################
####  This file contains all known options   ####
####  available from motion as well as any   ####
####  value limits and defaults (if any).    ####
####  By loading this file, we ensure that   ####
####  we always have all options available   ####
####  even if a given config file doesn't.   ####
#################################################
#################################################

$Motion = array();

#################################################
#################################################
####  These variables are unique to pMotion  ####
####  and will otherwise be ignored by       ####
####  Motion, however we want them stored    ####
####  in the Motion config files for ease.   ####
#################################################
#################################################

$Motion['max_stored_size'] = ''; # Integer in MegaBytes
$Motion['max_stored_age'] = ''; # Integer in hours
$Motion['feed_enabled'] = array('min' => 'off', 'max' => 'on', 'current' => 'on'); # Enables stream
$Motion['stream_wide'] = array('min' => '1', 'max' => '9', 'current' => '3'); # Number of streams to show wide, default is 3
#$Motion[''] = '';
#$Motion[''] = '';
#$Motion[''] = '';

#################################################
#################################################
####  The following variables are the        ####
####  known variables baked into Motion from ####
####  upstream as of 2017.12.23              ####
#################################################
#################################################

# From the System Processing category
$Motion['daemon'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['process_id_file'] = ''; #String
$Motion['setup_mode'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['logfile'] = ''; #String
$Motion['log_level'] = array('min' => '1', 'max' => '9', 'current' => '6');
$Motion['log_type'] = array('values' => array("COR", "STR", "ENC", "NET", "DBL", "EVT", "TRK", "ALL"), "current" => "ALL");
$Motion['camera'] = ''; #String
$Motion['camera_id'] = ''; # Integer
$Motion['camera_name'] = ''; #String
$Motion['camera_dir'] = ''; #String

# Video4Linux Devices
$Motion['videodevice'] = ''; #String
$Motion['v4l2_palette'] = array('min' => '0', 'max' => '21', 'current' => '17');
$Motion['tunerdevice'] = '/dev/tuner0'; #String
$Motion['input'] = array('min' => '-1', 'max' => '7', 'current' => 'off');
$Motion['norm'] = array('values' => array('PAL' => '0', 'NTSC' => '1', 'SECAM' => '2', 'PAL-NC' => '3'), "current" => '0');
$Motion['frequency'] = array('min' => '0', 'max' => '999999', 'current' => '0');
$Motion['power_line_frequency'] = array('min' => '-1', 'max' => '3', 'current' => '-1');
$Motion['auto_brightness'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['brightness'] = array('min' => '0', 'max' => '255', 'current' => '0');
$Motion['contrast'] = array('min' => '0', 'max' => '155', 'current' => '0');
$Motion['saturation'] = array('min' => 'off', 'max' => 'on', 'current' => '0');
$Motion['hue'] = array('min' => 'off', 'max' => 'on', 'current' => '0');
$Motion['roundrobin_frames'] = array('min' => '1', 'max' => '2147483647', 'current' => '1');
$Motion['roundrobin_skip'] = array('min' => '1', 'max' => '2147483647', 'current' => '1');
$Motion['switchfilter'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');

# Network Cameras
$Motion['netcam_url'] = 
$Motion['netcam_highres'] = ''; #String
$Motion['netcam_userpass'] = ''; #String
$Motion['netcam_keepalive'] = ''; #String
$Motion['netcam_proxy'] = ''; #String
$Motion['netcam_tolerant_check'] = ''; #String
$Motion['rtsp_uses_tcp'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');

# Raspberry Pi Camera
$Motion['mmalcam_name'] = ''; #String
$Motion['mmalcam_control_params'] = ''; #String

# Image Processing
$Motion['rotate'] = array('values' => array('0', '90', '180', '270'), 'current' => '0');
$Motion['flip_axis'] = array('alues' => array('none', 'h', 'v'), 'current' => 'none');
$Motion['width'] = array('min' => '0', 'max' => '3840', 'current' => '352');
$Motion['height'] = array('min' => '0', 'max' => '2160', 'current' => '288');
$Motion['framerate'] = array('min' => '2', 'max' => '100', 'current' => '100');
$Motion['minimum_frame_time'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['despeckle_filter'] = 'EedDl'; #String
$Motion['locate_motion_mode'] = array('values' => array('on', 'off', 'preview'), 'current' => 'off');
$Motion['locate_motion_style'] = array('values' => array('box', 'redbox', 'cross', 'redcross'), 'current' => 'redbox');
$Motion['text_left'] = ''; #String
$Motion['text_right'] = ''; #String
$Motion['text_changes'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['text_event'] = '%Y%m%d%H%M%S'; #String
$Motion['text_double'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');

# Motion Detection
$Motion['emulate_motion'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['threshold'] = array('min' => '1', 'max' => '2147483647', 'current' => '1500');
$Motion['threshold_tune'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['noise_level'] = array('min' => '1', 'max' => '255', 'current' => '32');
$Motion['noise_tune'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['area_detect'] = ''; #String
$Motion['mask_file'] = ''; #String
$Motion['mask_privacy'] = ''; #String
$Motion['smart_mask_speed'] = array('min' => '0', 'max' => '10', 'current' => '0');
$Motion['lightswitch'] = array('min' => '0', 'max' => '100', 'current' => '0');
$Motion['minimum_motion_frames'] = array('min' => '1', 'max' => '1000', 'current' => '1');
$Motion['event_gap'] = array('min' => '0', 'max' => '2147483647', 'current' => '60');

# Script Execution
$Motion['on_event_start'] = ''; #String
$Motion['on_event_end'] = ''; #String
$Motion['on_picture_save'] = ''; #String
$Motion['on_motion_detected'] = ''; #String
$Motion['on_area_detected'] = ''; #String
$Motion['on_movie_start'] = ''; #String
$Motion['on_movie_end'] = ''; #String
$Motion['on_camera_lost'] = ''; #String
$Motion['on_camera_found'] = ''; #String

# Output - General
$Motion['quiet'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['pre_capture'] = array('min' => '0', 'max' => '100', 'current' => '0');
$Motion['post_capture'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['target_dir'] = ''; #String

# Output - Picture
$Motion['output_pictures'] = array('values' => array('on', 'off', 'first', 'best'), 'current' => 'on');
$Motion['output_debug_pictures'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['quality'] = array('min' => '1', 'max' => '100', 'current' => '75');
$Motion['picture_type'] = ''; #String
$Motion['snapshot_interval'] = array('min' => 'off', '0' => '2147483647', 'current' => '0');
$Motion['snapshot_filename'] = '%v-%Y%m%d%H%M%S-snapshot'; #String
$Motion['picture_filename'] = '%v-%Y%m%d%H%M%S-%q'; #String
$Motion['exif_text'] = ''; #String

# Output - Movie
$Motion['max_movie_time'] = array('min' => '0', 'max' => '2147483647', 'current' => '3600');
$Motion['ffmpeg_output_movies'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['ffmpeg_output_debug_movies'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['ffmpeg_bps'] = array('min' => '0', 'max' => '9999999', 'current' => '400000');
$Motion['ffmpeg_variable_bitrate'] = array('min' => '0', 'max' => '100', 'current' => '0');
$Motion['ffmpeg_video_codec'] = array('values' => array('mpeg4', 'msmpeg4', 'swf', 'flv', 'flv1', 'mov', 'ogg', 'mp4', 'mkv', 'hevc'), 'current' => 'mpeg4');
$Motion['ffmpeg_duplicate_frames'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['movie_filename'] = '%v-%Y%m%d%H%M%S'; # String
$Motion['timelapse_filename'] = '%v-%Y%m%d-timelapse'; # String
$Motion['timelapse_interval'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['timelapse_mode'] = array('values' => array('hourly', 'daily', 'weekly-sunday', 'weekly-monday', 'monthly', 'manual'), 'current' => 'daily');
$Motion['timelapse_codec'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['timelapse_fps'] = array('min' => '0', 'max' => '2147483647', 'current' => '30');

# Output - Pipe
$Motion['video_pipe'] = ''; #String
$Motion['motion_video_pipe'] = ''; #String
$Motion['use_extpipe'] = ''; #String
$Motion['extpipe'] = ''; #String

# Stream and Webcontrol
$Motion['ipv6_enabled'] = ''; #String
$Motion['stream_port'] = array('min' => '0', 'max' => '65535', 'current' => '0');
$Motion['substream_port'] = array('min' => '0', 'max' => '65535', 'current' => '0');
$Motion['stream_quality'] = array('min' => '0', 'max' => '100', 'current' => '50');
$Motion['stream_motion'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['stream_maxrate'] = array('min' => '0', 'max' => '100', 'current' => '1');
$Motion['stream_localhost'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['stream_limit'] = ''; # String
$Motion['stream_auth_method'] = array('min' => '0', 'max' => '2', 'current' => '0');
$Motion['stream_authentication'] = ''; # String
$Motion['stream_preview_scale'] = array('min' => '0', 'max' => '', 'current' => '25');
$Motion['stream_preview_newline'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['webcontrol_port'] = array('min' => '0', 'max' => '65535', 'current' => '0');
$Motion['webcontrol_localhost'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['webcontrol_html_output'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['webcontrol_authentication'] = ''; # String
$Motion['webcontrol_parms'] = array('min' => '0', 'max' => '3', 'current' => '0');

# Database
$Motion['sql_log_picture'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['sql_log_snapshot'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['sql_log_movie'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['sql_log_timelapse'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['sql_query'] = ''; # String
$Motion['sql_query_start'] = ''; #String
$Motion['database_type'] = array('values' => array('mysql', 'postgresql', 'sqlite3'), 'value' => '');
$Motion['database_dbname'] = ''; # String
$Motion['database_host'] = 'localhost'; # String
$Motion['database_user'] = ''; # String
$Motion['database_password'] = ''; # String
$Motion['database_port'] = ''; # Integer
$Motion['database_busy_timeout'] = '';  # Integer

# Tracking
$Motion['track_type'] = array('values' => array('none' => '0', 'stepper' => '1', 'iomojo' => '2', 'pwc' => '3', 'generic' => '4', 'uvcvideo' => '5'), 'current' => '0');
$Motion['track_auto'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['track_port'] = ''; # Integer
$Motion['track_motorx'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_motory'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_motorx_reverse'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_maxx'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_minx'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_maxy'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_miny'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_homex'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_homey'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_iomojo_id'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_step_angle_x'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_step_angle_y'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_move_wait'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_speed'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['track_stepsize'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');


ksort($Motion);
?>