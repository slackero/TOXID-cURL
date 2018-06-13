[{if $oView->getClassName() == 'toxid_curl'}]
    [{assign var="toxidCanonicalUrl" value="http://`$smarty.server.SERVER_NAME``$smarty.server.REQUEST_URI`"}]
[{/if}]

[{if $toxidMetaKeywords}]
    <link rel="canonical" href="[{$toxidCanonicalUrl}]">
[{else}]
    [{$smarty.block.parent}]
[{/if}]