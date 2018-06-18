<?php

class toxid_setup_main extends \OxidEsales\Eshop\Application\Controller\Admin\AdminController
{
    const CONFIG_MODULE_NAME = 'module:toxid_curl';
    const CONFIG_BACKUP_MODULE_NAME = 'module:toxid_curl_backup';
    protected $_sThisTemplate = 'toxid_setup_main.tpl';

    public function render()
    {
        $oConf = \OxidEsales\Eshop\Core\Registry::getConfig();

        $this->_aViewData['aToxidCurlSource']              = $oConf->getShopConfVar('aToxidCurlSource');
        $this->_aViewData['aToxidCurlSourceSsl']           = $oConf->getShopConfVar('aToxidCurlSourceSsl');
        $this->_aViewData['aToxidSearchUrl']               = $oConf->getShopConfVar('aToxidSearchUrl');
        $this->_aViewData['aToxidCurlUrlParams']           = $oConf->getShopConfVar('aToxidCurlUrlParams');
        $this->_aViewData['aToxidCurlSeoSnippets']         = $oConf->getShopConfVar('aToxidCurlSeoSnippets');
        $this->_aViewData['toxidDontRewriteRelUrls']       = $oConf->getShopConfVar('toxidDontRewriteRelUrls');
        $this->_aViewData['toxidDontRewriteFileExtension'] = $oConf->getShopConfVar('toxidDontRewriteFileExtension');
        $this->_aViewData['toxidRewriteUrlEncoded']        = $oConf->getShopConfVar('toxidRewriteUrlEncoded');
        $this->_aViewData['toxidDontRewriteUrls']          = $oConf->getShopConfVar('toxidDontRewriteUrls');
        $this->_aViewData['bToxidDontPassPostVarsToCms']   = $oConf->getShopConfVar('bToxidDontPassPostVarsToCms');
        $this->_aViewData['bToxidRedirect301ToStartpage']  = $oConf->getShopConfVar('bToxidRedirect301ToStartpage');
        $this->_aViewData['toxidCacheTtl']                 = $oConf->getShopConfVar('toxidCacheTtl');
        $this->_aViewData['toxidError404Link']             = $oConf->getShopConfVar('toxidError404Link');
        $this->_aViewData['aToxidNotFoundUrl']             = $oConf->getShopConfVar('aToxidNotFoundUrl');
        $this->_aViewData['aToxidCurlUrlAdminParams']      = $oConf->getShopConfVar('aToxidCurlUrlAdminParams');
        $this->_aViewData['toxidAllowedCmsRequestParams']  = $oConf->getShopConfVar('toxidAllowedCmsRequestParams');
        $this->_aViewData['toxidDontVerifySSLCert']        = $oConf->getShopConfVar('toxidDontVerifySSLCert');
        $this->_aViewData['aToxidCurlLogin']               = $oConf->getShopConfVar('aToxidCurlLogin');
        $this->_aViewData['aToxidCurlPwd']                 = $oConf->getShopConfVar('aToxidCurlPwd');

        return parent::render();
    }

    /**
     * Saves the settings
     *
     * @return void
     */
    public function save()
    {
        $oConf   = \OxidEsales\Eshop\Core\Registry::getConfig();
        $oRequest = \OxidEsales\Eshop\Core\Registry::getRequest();
        $aParams = $oRequest->getRequestParameter("editval");
        $sShopId = $oConf->getShopId();

        $oConf->saveShopConfVar('arr', 'aToxidCurlSource', $aParams['aToxidCurlSource'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlSourceSsl', $aParams['aToxidCurlSourceSsl'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidSearchUrl', $aParams['aToxidSearchUrl'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlUrlParams', $aParams['aToxidCurlUrlParams'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlSeoSnippets', $aParams['aToxidCurlSeoSnippets'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidDontRewriteRelUrls', $aParams['toxidDontRewriteRelUrls'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidDontRewriteFileExtension', $aParams['toxidDontRewriteFileExtension'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidCacheTtl', $aParams['toxidCacheTtl'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidError404Link', $aParams['toxidError404Link'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidNotFoundUrl', $aParams['aToxidNotFoundUrl'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'toxidRewriteUrlEncoded', $aParams['toxidRewriteUrlEncoded'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'toxidDontRewriteUrls', $aParams['toxidDontRewriteUrls'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'bToxidDontPassPostVarsToCms', $aParams['bToxidDontPassPostVarsToCms'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'bToxidRedirect301ToStartpage', $aParams['bToxidRedirect301ToStartpage'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlUrlAdminParams', $aParams['aToxidCurlUrlAdminParams'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidAllowedCmsRequestParams', $aParams['toxidAllowedCmsRequestParams'], $sShopId, self::CONFIG_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'toxidDontVerifySSLCert', $aParams['toxidDontVerifySSLCert'], $sShopId, self::CONFIG_MODULE_NAME);

        // Save backups
        $oConf->saveShopConfVar('arr', 'aToxidCurlSourceBackup', $aParams['aToxidCurlSource'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlSourceSslBackup', $aParams['aToxidCurlSourceSsl'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidSearchUrlBackup', $aParams['aToxidSearchUrl'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlUrlParamsBackup', $aParams['aToxidCurlUrlParams'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlSeoSnippetsBackup', $aParams['aToxidCurlSeoSnippets'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidDontRewriteRelUrlsBackup', $aParams['toxidDontRewriteRelUrls'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidDontRewriteFileExtensionBackup', $aParams['toxidDontRewriteFileExtension'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidCacheTtlBackup', $aParams['toxidCacheTtl'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidError404LinkBackup', $aParams['toxidError404Link'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidNotFoundUrlBackup', $aParams['aToxidNotFoundUrl'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'toxidRewriteUrlEncodedBackup', $aParams['toxidRewriteUrlEncoded'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'toxidDontRewriteUrlsBackup', $aParams['toxidDontRewriteUrls'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'bToxidDontPassPostVarsToCmsBackup', $aParams['bToxidDontPassPostVarsToCms'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'bToxidRedirect301ToStartpageBackup', $aParams['bToxidRedirect301ToStartpage'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('arr', 'aToxidCurlUrlAdminParamsBackup', $aParams['aToxidCurlUrlAdminParams'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('str', 'toxidAllowedCmsRequestParamsBackup', $aParams['toxidAllowedCmsRequestParams'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);
        $oConf->saveShopConfVar('bl', 'toxidDontVerifySSLCertBackup', $aParams['toxidDontVerifySSLCert'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME);


        // htaccess Login
        $oConf->saveShopConfVar( 'arr', 'aToxidCurlLogin', $aParams['aToxidCurlLogin'], $sShopId, self::CONFIG_MODULE_NAME );
        // htaccess Password
        if(isset($aParams['aToxidCurlPwd']) && count($aParams['aToxidCurlPwd'])) {

            $oEncryptor = oxNew(\OxidEsales\Eshop\Core\Encryptor::class);

            // get old password settings
            $aToxidCurlPwd = $oConf->getShopConfVar('aToxidCurlPwd');
            $encryptKey = $oConf->getConfigParam('dbPwd');
            foreach($aParams['aToxidCurlPwd'] as $lang => $value) {
                $value = trim($value);
                if($value !== '') {
                    if(isset($aToxidCurlPwd[$lang]) && $value === $aToxidCurlPwd[$lang]) {
                        $aParams['aToxidCurlPwd'][$lang] = $aToxidCurlPwd[$lang];
                    } else {
                        $aParams['aToxidCurlPwd'][$lang] = $oEncryptor->encrypt($value, $encryptKey);
                    }
                } else {
                    $aParams['aToxidCurlPwd'][$lang] = '';
                }
            }
            $oConf->saveShopConfVar( 'arr', 'aToxidCurlPwd', $aParams['aToxidCurlPwd'], $sShopId, self::CONFIG_MODULE_NAME );
            // Save backup
            $oConf->saveShopConfVar( 'arr', 'aToxidCurlPwdBackup', $aParams['aToxidCurlPwd'], $sShopId, self::CONFIG_BACKUP_MODULE_NAME );
        }
    }
}
