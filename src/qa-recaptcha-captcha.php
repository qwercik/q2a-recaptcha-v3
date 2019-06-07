<?php
/*
	Question2Answer by Gideon Greenspan and contributors
	http://www.question2answer.org/

	File: qa-plugin/recaptcha-captcha/qa-recaptcha-captcha.php
	Description: Captcha module for reCAPTCHA


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

require_once __DIR__ . '/recaptchalib.php';
require_once __DIR__ . '/admin-form.php';
require_once __DIR__ . '/user-verifier.php';

class qa_recaptcha_captcha
{
	public function load_module()
	{
		$this->adminForm = new admin_form();
	}

	public function admin_form()
	{
		return $this->adminForm->generate_view();
	}

	public function allow_captcha()
	{
		return $this->adminForm->is_filled();
	}

	public function form_html(&$qa_content, $error)
	{
		$publicKey = $this->adminForm->get_public_key();
		
		$qa_content['script_src'][] = "https://www.google.com/recaptcha/api.js?render=${publicKey}";
		$qa_content['script_lines'][] = [
			"document.addEventListener('DOMContentLoaded', function() {",
			"	grecaptcha.ready(function() {",
			"		grecaptcha.execute('${publicKey}', {action: 'login'}).then(function(token) {",
			"			document.querySelector('#g-recaptcha-response').value = token;",
			'		});',
			"	});",
			"});"
			
		];

		// Due to id property, it's impossible to have multiple captchas at one page
		$inputWithToken = '<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">';
		return $inputWithToken;
	}

	public function validate_post(&$error)
	{
		$privateKey = $this->adminForm->get_private_key();
		$captchaToken = qa_post_text('g-recaptcha-response');
		
		//0.5 is minimal recaptcha score - it should be configured in admin form
		$userVerifier = new user_verifier($privateKey, $captchaToken, 0.5);
		return $userVerifier->is_human();
	}
	
	private $adminForm;
}
