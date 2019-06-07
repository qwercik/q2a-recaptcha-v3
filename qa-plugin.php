<?php
/*
	Question2Answer by Gideon Greenspan and contributors
	http://www.question2answer.org/

	File: qa-plugin/recaptcha-captcha/qa-plugin.php
	Description: Initiates reCAPTCHA plugin


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

/*
	Plugin Name: reCAPTCHA v3
	Plugin URI: https://github.com/qwercik/q2a-recaptcha-v3
	Plugin Description: Provides reCAPTCHA v3 services
	Plugin Version: 1.0
	Plugin Date: 2019-06-07
	Plugin Author: Eryk Andrzejewski
	Plugin Author URI: github.com/qwercik
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.7
	Plugin Update Check URI: https://github.com/qwercik/q2a-recaptcha-v3
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_module('captcha', 'src/qa-recaptcha-captcha.php', 'qa_recaptcha_captcha', 'reCAPTCHA');
qa_register_plugin_phrases('src/lang/qa-recaptcha-captcha-lang-*.php', 'recaptcha');
