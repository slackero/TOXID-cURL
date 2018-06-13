[{if $oView->getClassName() == 'toxid_curl'}]
    [{assign var='toxid' value=$oViewConf->getToxid()}]
    [{assign var="toxidMetaDescription" value=$toxid->getCmsSnippet('description')}]
[{/if}]

[{if $toxidMetaDescription}]
    <meta name="description" content="[{$toxidMetaDescription}]">
[{else}]
    [{$smarty.block.parent}]
[{/if}]