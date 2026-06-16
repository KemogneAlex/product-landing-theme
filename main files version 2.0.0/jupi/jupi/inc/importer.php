<?php

function jupi_backups_demos($demos)
{

	$demo_content_installer	 = 'http://wp.quomodosoft.com/jupi/content';
	$demos_array			 = array(

		'home_1'			 => array(
			'title'			 => esc_html__('Home 1', 'jupi'),
			'screenshot'	 => esc_url($demo_content_installer) . '/home_1.jpg',
			'preview_link'	 => esc_url('http://wp.quomodosoft.com/jupi'),
		),

		'home_2'			 => array(
			'title'			 => esc_html__('Home 2', 'jupi'),
			'screenshot'	 => esc_url($demo_content_installer) . '/home_2.jpg',
			'preview_link'	 => esc_url('http://wp.quomodosoft.com/jupi/home-2'),
		),

		'home_3'			 => array(
			'title'			 => esc_html__('Home 3', 'jupi'),
			'screenshot'	 => esc_url($demo_content_installer) . '/home_3.jpg',
			'preview_link'	 => esc_url('http://wp.quomodosoft.com/jupi/home-3'),
		),

		'home_4'			 => array(
			'title'			 => esc_html__('Home 4', 'jupi'),
			'screenshot'	 => esc_url($demo_content_installer) . '/home_4.jpg',
			'preview_link'	 => esc_url('http://wp.quomodosoft.com/jupi/home-4'),
		),

		'home_5'			 => array(
			'title'			 => esc_html__('Home 5', 'jupi'),
			'screenshot'	 => esc_url($demo_content_installer) . '/home_5.jpg',
			'preview_link'	 => esc_url('http://wp.quomodosoft.com/jupi/home-5'),
		),

		'home_6'			 => array(
			'title'			 => esc_html__('Home 6', 'jupi'),
			'screenshot'	 => esc_url($demo_content_installer) . '/home_6.jpg',
			'preview_link'	 => esc_url('http://wp.quomodosoft.com/jupi/home-6'),
		),

		'home_7'			 => array(
			'title'			 => esc_html__('Home 7', 'jupi'),
			'screenshot'	 => esc_url($demo_content_installer) . '/home_7.jpg',
			'preview_link'	 => esc_url('http://wp.quomodosoft.com/jupi/home-7'),
		),
	);

	$download_url			 = esc_url($demo_content_installer) . '/download.php';

	foreach ($demos_array as $id => $data) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url'		 => $download_url,
			'file_id'	 => $id,
		));
		$demo->set_title($data['title']);
		$demo->set_screenshot($data['screenshot']);
		$demo->set_preview_link($data['preview_link']);
		$demos[$demo->get_id()] = $demo;
		unset($demo);
	}

	return $demos;
}

add_filter('fw:ext:backups-demo:demos', 'jupi_backups_demos');
