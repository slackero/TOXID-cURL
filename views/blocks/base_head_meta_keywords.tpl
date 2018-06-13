[{if $oView->getClassName() == 'toxid_curl'}]
    [{assign var='toxid' value=$oViewConf->getToxid()}]
    [{assign var="toxidMetaKeywords" value=$toxid->getCmsSnippet('keywords')}]
[{/if}]

[{if $toxidMetaKeywords}]
    <meta name="keywords" content="[{$toxidMetaKeywords}]">
[{else}]
    [{$smarty.block.parent}]
[{/if}]