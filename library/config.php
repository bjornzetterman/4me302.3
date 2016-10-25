<?php

/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return
		array(
			"base_url" => "http://zetterman.ax/4ME302/A3/library/",
			"providers" => array(
				// openid providers
				"OpenID" => array(
					"enabled" => true
				),
				"Yahoo" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => ""),
				),
				"AOL" => array(
					"enabled" => true
				),
				"Google" => array(
					"enabled" => true,
					"keys" => array("id" => "989547022602-i62j06vn960u5hh5g7a2al0e0tvol81k.apps.googleusercontent.com", "secret" => "xTn5uuqAyz2aWjY-64-KlKMY"),
					"scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                               "https://www.googleapis.com/auth/userinfo.email"   , // optional
					"access_type"     => "offline",   // optional
					"approval_prompt" => "force",     // optional
				),
				"Facebook" => array(
					"enabled" => true,
					"keys" => array("id" => "950806441629012", "secret" => "28f50d98763ee302b020874a0a6f169f"),
					"trustForwarded" => false,
					"scope"   => "email", // optional
					"display" => "popup" // optional
				),
				"Twitter" => array(
					"enabled" => true,
					"keys" => array("key" => "4fK9QgyV6gmxfrWiNmb4JqnJA", "secret" => "MCDYV7soXPgRK49ONc6iz4sWwYz2EUHMmkIRIs2EcNaCNcRCBI"),
					"includeEmail" => true
				),
				// windows live
				"Live" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
				"LinkedIn" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => "")
				),
				"Foursquare" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
			),
			// If you want to enable logging, set 'debug_mode' to true.
			// You can also set it to
			// - "error" To log only error messages. Useful in production
			// - "info" To log info and error messages (ignore debug messages)
			"debug_mode" => true,
			// Path to file writable by the web server. Required if 'debug_mode' is not false
			"debug_file" => "/srv/www/zetterman.ax/log.log",
);
