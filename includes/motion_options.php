<?php
#################################################
#################################################
#################################################
####  This file contains all known options   ####
####  Available inside motion as well as     ####
####  value limits.                          ####
#################################################
#################################################
#################################################

$Motion = array();

$Motion['SysProc']['daemon'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['SysProc']['process_id_file'] = ''; #String
$Motion['SysProc']['setup_mode'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['SysProc']['logfile'] = ''; #String
$Motion['SysProc']['log_level'] = array('min' => '1', 'max' => '9', 'current' => '6');
$Motion['SysProc']['log_type'] = array('values' => array("COR", "STR", "ENC", "NET", "DBL", "EVT", "TRK", "ALL"), "current" => "ALL");
$Motion['SysProc']['camera'] = ''; #String
$Motion['SysProc']['camera_id'] = array('min' => '0', 'max' => '999', 'current' => 'off');
$Motion['SysProc']['camera_name'] = ''; #String
$Motion['SysProc']['camera_dir'] = ''; #String

$Motion['v4l']['videodevice'] = ''; #String
$Motion['v4l']['v4l2_palette'] = array('min' => '0', 'max' => '21', 'current' => '17');
$Motion['v4l']['tunerdevice'] = '/dev/tuner0'; #String
$Motion['v4l']['input'] = array('min' => '-1', 'max' => '7', 'current' => 'off');
$Motion['v4l']['norm'] = array('values' => array('PAL' => '0', 'NTSC' => '1', 'SECAM' => '2', 'PAL-NC' => '3'), "current" => '0');
$Motion['v4l']['frequency'] = array('min' => '0', 'max' => '999999', 'current' => '0');
$Motion['v4l']['power_line_frequency'] = array('min' => '-1', 'max' => '3', 'current' => '-1');
$Motion['v4l']['auto_brightness'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['v4l']['brightness'] = array('min' => '0', 'max' => '255', 'current' => '0');
$Motion['v4l']['contrast'] = array('min' => '0', 'max' => '155', 'current' => '0');
$Motion['v4l']['saturation'] = array('min' => 'off', 'max' => 'on', 'current' => '0');
$Motion['v4l']['hue'] = array('min' => 'off', 'max' => 'on', 'current' => '0');
$Motion['v4l']['roundrobin_frames'] = array('min' => '1', 'max' => '2147483647', 'current' => '1');
$Motion['v4l']['roundrobin_skip'] = array('min' => '1', 'max' => '2147483647', 'current' => '1');
$Motion['v4l']['switchfilter'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');

$Motion['NetCam']['netcam_url'] = 
$Motion['NetCam']['netcam_highres'] = ''; #String
$Motion['NetCam']['netcam_userpass'] = ''; #String
$Motion['NetCam']['netcam_keepalive'] = ''; #String
$Motion['NetCam']['netcam_proxy'] = ''; #String
$Motion['NetCam']['netcam_tolerant_check'] = ''; #String
$Motion['NetCam']['rtsp_uses_tcp'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');

$Motion['RasPiCam']['mmalcam_name'] = ''; #String
$Motion['RasPiCam']['mmalcam_control_params'] = ''; #String

$Motion['ImageProcessing']['rotate'] = array('values' => array('0', '90', '180', '270'), 'current' => '0');
$Motion['ImageProcessing']['flip_axis'] = array('alues' => array('none', 'h', 'v'), 'current' => 'none');
$Motion['ImageProcessing']['width'] = array('min' => '0', 'max' => '3840', 'current' => '352');
$Motion['ImageProcessing']['height'] = array('min' => '0', 'max' => '2160', 'current' => '288');
$Motion['ImageProcessing']['framerate'] = array('min' => '2', 'max' => '100', 'current' => '100');
$Motion['ImageProcessing']['minimum_frame_time'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['ImageProcessing']['despeckle_filter'] = 'EedDl'; #String
$Motion['ImageProcessing']['locate_motion_mode'] = array('values' => array('on', 'off', 'preview'), 'current' => 'off');
$Motion['ImageProcessing']['locate_motion_style'] = array('values' => array('box', 'redbox', 'cross', 'redcross'), 'current' => 'redbox');
$Motion['ImageProcessing']['text_left'] = ''; #String
$Motion['ImageProcessing']['text_right'] = ''; #String
$Motion['ImageProcessing']['text_changes'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['ImageProcessing']['text_event'] = '%Y%m%d%H%M%S'; #String
$Motion['ImageProcessing']['text_double'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');

$Motion['MoDetect']['emulate_motion'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['MoDetect']['threshold'] = array('min' => '1', 'max' => '2147483647', 'current' => '1500');
$Motion['MoDetect']['threshold_tune'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['MoDetect']['noise_level'] = array('min' => '1', 'max' => '255', 'current' => '32');
$Motion['MoDetect']['noise_tune'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['MoDetect']['area_detect'] = ''; #String
$Motion['MoDetect']['mask_file'] = ''; #String
$Motion['MoDetect']['mask_privacy'] = ''; #String
$Motion['MoDetect']['smart_mask_speed'] = array('min' => '0', 'max' => '10', 'current' => '0');
$Motion['MoDetect']['lightswitch'] = array('min' => '0', 'max' => '100', 'current' => '0');
$Motion['MoDetect']['minimum_motion_frames'] = array('min' => '1', 'max' => '1000', 'current' => '1');
$Motion['MoDetect']['event_gap'] = array('min' => '0', 'max' => '2147483647', 'current' => '60');

$Motion['ScriptExec']['on_event_start'] = ''; #String
$Motion['ScriptExec']['on_event_end'] = ''; #String
$Motion['ScriptExec']['on_picture_save'] = ''; #String
$Motion['ScriptExec']['on_motion_detected'] = ''; #String
$Motion['ScriptExec']['on_area_detected'] = ''; #String
$Motion['ScriptExec']['on_movie_start'] = ''; #String
$Motion['ScriptExec']['on_movie_end'] = ''; #String
$Motion['ScriptExec']['on_camera_lost'] = ''; #String
$Motion['ScriptExec']['on_camera_found'] = ''; #String

$Motion['OutGeneral']['quiet'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['OutGeneral']['pre_capture'] = array('min' => '0', 'max' => '100', 'current' => '0');
$Motion['OutGeneral']['post_capture'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['OutGeneral']['target_dir'] = ''; #String

$Motion['OutPicture']['output_pictures'] = array('values' => array('on', 'off', 'first', 'best'), 'current' => 'on');
$Motion['OutPicture']['output_debug_pictures'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['OutPicture']['quality'] = array('min' => '1', 'max' => '100', 'current' => '75');
$Motion['OutPicture']['picture_type'] = ''; #String
$Motion['OutPicture']['snapshot_interval'] = array('min' => 'off', '0' => '2147483647', 'current' => '0');
$Motion['OutPicture']['snapshot_filename'] = '%v-%Y%m%d%H%M%S-snapshot'; #String
$Motion['OutPicture']['picture_filename'] = '%v-%Y%m%d%H%M%S-%q'; #String
$Motion['OutPicture']['exif_text'] = ''; #String

$Motion['OutMovie']['max_movie_time'] = array('min' => '0', 'max' => '2147483647', 'current' => '3600');
$Motion['OutMovie']['ffmpeg_output_movies'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['OutMovie']['ffmpeg_output_debug_movies'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['OutMovie']['ffmpeg_bps'] = array('min' => '0', 'max' => '9999999', 'current' => '400000');
$Motion['OutMovie']['ffmpeg_variable_bitrate'] = array('min' => '0', 'max' => '100', 'current' => '0');
$Motion['OutMovie']['ffmpeg_video_codec'] = array('values' => array('mpeg4', 'msmpeg4', 'swf', 'flv', 'flv1', 'mov', 'ogg', 'mp4', 'mkv', 'hevc'), 'current' => 'mpeg4');
$Motion['OutMovie']['ffmpeg_duplicate_frames'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['OutMovie']['movie_filename'] = '%v-%Y%m%d%H%M%S'; # String
$Motion['OutMovie']['timelapse_filename'] = '%v-%Y%m%d-timelapse'; # String
$Motion['OutMovie']['timelapse_interval'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['OutMovie']['timelapse_mode'] = array('values' => array('hourly', 'daily', 'weekly-sunday', 'weekly-monday', 'monthly', 'manual'), 'current' => 'daily');
$Motion['OutMovie']['timelapse_codec'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['OutMovie']['timelapse_fps'] = array('min' => '0', 'max' => '2147483647', 'current' => '30');

$Motion['OutPipe']['video_pipe'] = ''; #String
$Motion['OutPipe']['motion_video_pipe'] = ''; #String
$Motion['OutPipe']['use_extpipe'] = ''; #String
$Motion['OutPipe']['extpipe'] = ''; #String

$Motion['StreamWeb']['ipv6_enabled'] = ''; #String
$Motion['StreamWeb']['stream_port'] = array('min' => '0', 'max' => '65535', 'current' => '0');
$Motion['StreamWeb']['substream_port'] = array('min' => '0', 'max' => '65535', 'current' => '0');
$Motion['StreamWeb']['stream_quality'] = array('min' => '0', 'max' => '100', 'current' => '50');
$Motion['StreamWeb']['stream_motion'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['StreamWeb']['stream_maxrate'] = array('min' => '0', 'max' => '100', 'current' => '1');
$Motion['StreamWeb']['stream_localhost'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['StreamWeb']['stream_limit'] = ''; # String
$Motion['StreamWeb']['stream_auth_method'] = array('min' => '0', 'max' => '2', 'current' => '0');
$Motion['StreamWeb']['stream_authentication'] = ''; # String
$Motion['StreamWeb']['stream_preview_scale'] = array('min' => '0', 'max' => '', 'current' => '25');
$Motion['StreamWeb']['stream_preview_newline'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['StreamWeb']['webcontrol_port'] = array('min' => '0', 'max' => '65535', 'current' => '0');
$Motion['StreamWeb']['webcontrol_localhost'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['StreamWeb']['webcontrol_html_output'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['StreamWeb']['webcontrol_authentication'] = ''; # String
$Motion['StreamWeb']['webcontrol_parms'] = array('min' => '0', 'max' => '3', 'current' => '0');

$Motion['Database']['sql_log_picture'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['Database']['sql_log_snapshot'] = array('min' => 'off', 'max' => 'on', 'current' => 'on');
$Motion['Database']['sql_log_movie'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['Database']['sql_log_timelapse'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['Database']['sql_query'] = ''; # String
$Motion['Database']['sql_query_start'] = ''; #String
$Motion['Database']['database_type'] = array('values' => array('mysql', 'postgresql', 'sqlite3'), 'value' => '');
$Motion['Database']['database_dbname'] = ''; # String
$Motion['Database']['database_host'] = 'localhost'; # String
$Motion['Database']['database_user'] = ''; # String
$Motion['Database']['database_password'] = ''; # String
$Motion['Database']['database_port'] = ''; # Integer
$Motion['Database']['database_busy_timeout'] = '';  # Integer

$Motion['Tracking']['track_type'] = array('values' => array('none' => '0', 'stepper' => '1', 'iomojo' => '2', 'pwc' => '3', 'generic' => '4', 'uvcvideo' => '5'), 'current' => '0');
$Motion['Tracking']['track_auto'] = array('min' => 'off', 'max' => 'on', 'current' => 'off');
$Motion['Tracking']['track_port'] = ''; # Integer
$Motion['Tracking']['track_motorx'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_motory'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_motorx_reverse'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_maxx'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_minx'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_maxy'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_miny'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_homex'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_homey'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_iomojo_id'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_step_angle_x'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_step_angle_y'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_move_wait'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_speed'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');
$Motion['Tracking']['track_stepsize'] = array('min' => '0', 'max' => '2147483647', 'current' => '0');

?>