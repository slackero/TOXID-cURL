<?php
/**
 * vt Smarty Extension Demo
 * Copyright (C) 2013  Marat Bedoev
 *
 *    This file is part of TOXID Module for OXID eShop CE/PE/EE.
 *
 *    TOXID is free software: you can redistribute it and/or modify
 *    it under the terms of the MIT License.
 *
 *
 * @link      https://github.com/vanilla-thunder/vt-smartyext
 * @link      http://toxid.org
 * @package   core
 */

class toxid_curl_events extends oxI18n {

	public static function onActivate() {

		$cfg = \OxidEsales\Eshop\Core\Registry::getConfig();

		//clearing cache
		$dir = $cfg->getConfigParam("sCompileDir")."*";
		foreach (glob($dir) as $item) {
			if (!is_dir($item)) {
				@unlink($item);
			}
		}

		// reloading smarty object after activation
        \OxidEsales\Eshop\Core\Registry::get("oxUtilsView")->getSmarty(true);
	}

	public static function onDeactivate() {
		// reloading smarty object after deactivationg
		// but blocks are still in tempaltes -> exception
		// needs some optimization / workaround here, cause custom plugins dir is still in smarty object

		//oxRegistry::get("oxUtilsView")->getSmarty(true);


		//clearing cache to force re-init smarty object (i hope)
		$cfg = \OxidEsales\Eshop\Core\Registry::getConfig();
		$dir = $cfg->getConfigParam("sCompileDir")."*";
		foreach (glob($dir) as $item) {
			if (!is_dir($item)) {
				@unlink($item);
			}
		}
	}

}

