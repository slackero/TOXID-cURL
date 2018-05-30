<?php

class Toxid_Curl_Smarty_Parser
{
    public function parse($content)
    {
        return \OxidEsales\Eshop\Core\Registry::get('oxUtilsView')->parseThroughSmarty($content, md5($content), null, true);
    }
}


