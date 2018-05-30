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

class toxid_curl_events extends \OxidEsales\Eshop\Core\Model\MultiLanguageModel {


    /**
     * @return array
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public static function getBackupModuleConfigs()
    {
        $db = \OxidEsales\Eshop\Core\DatabaseProvider::getDb(\OxidEsales\Eshop\Core\DatabaseProvider::FETCH_MODE_ASSOC);
        $config = \OxidEsales\Eshop\Core\Registry::getConfig();
        $shopId = $config->getShopId();
        $module = 'module:toxid_curl_backup';

        $decodeValueQuery = $config->getDecodeValueQuery();
        $moduleConfigsQuery = "SELECT oxvarname, oxvartype, {$decodeValueQuery} as oxvardecodedvalue FROM oxconfig WHERE oxmodule = ? AND oxshopid = ?";
        $dbConfigs = $db->getAll($moduleConfigsQuery, [$module, $shopId]);

        $result = [];
        foreach ($dbConfigs as $oneModuleConfig) {
            $oneModuleConfig['oxvarname'] = str_replace('Backup','',$oneModuleConfig['oxvarname']);
            $result[$oneModuleConfig['oxvarname']] = array();
            foreach ($oneModuleConfig as $key=>$value) {
                $result[$oneModuleConfig['oxvarname']][$key] = $value;
            }
            $result[$oneModuleConfig['oxvarname']]['oxvarvalue'] = $config->decodeValue($oneModuleConfig['oxvartype'], $oneModuleConfig['oxvardecodedvalue']);
        }

        return $result;
    }


    /**
     */
    public static function onActivate() {

        $cfg = \OxidEsales\Eshop\Core\Registry::getConfig();

        //load config parameter backups, if existing
        //due to module parameters being set outside of default settings,
        // should the module be reactivated, any settings will be lost,
        // as all module settings will be removed that aren't set under 'settings'
        $aBackupModuleConfigs = static::getBackupModuleConfigs();
        if ($aBackupModuleConfigs && count($aBackupModuleConfigs)>0) {
            foreach ($aBackupModuleConfigs as $varName => $aBackupModuleConfig) {
                if (!$cfg->getShopConfVar($varName,$cfg->getShopId(),'module:toxid_curl')) {
                    $cfg->saveShopConfVar($aBackupModuleConfig['oxvartype'], $varName, $aBackupModuleConfig['oxvarvalue'], $cfg->getShopId(), 'module:toxid_curl');
                }
            }
        }


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

    /**
     *
     */
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

