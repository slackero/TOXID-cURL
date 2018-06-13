<?php
/**
 * OXID_Module_TOXID
 *
 * PHP version 5
 *
 * @category TOXID
 * @package  TOXID
 * @author   Joscha Krug <support@marmalade.de>
 * @license  MIT License http://www.opensource.org/licenses/mit-license.html
 * @version  2.0
 * @link     http://toxid.org
 * @link     https://github.com/jkrug/TOXID-cURL
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

$aModule = array(
    'id'          => 'toxid_curl',
    'title'       => 'marmalade :: TOXID cURL',
    'description' => array(
        'de'    => 'Integriert CMS-Inhalte in OXID eShop',
        'en'    => 'Renders pages form CMS and navigation in OXID.',
    ),
    'email'         => 'support@marmalade.de',
    'url'           => 'http://www.marmalade.de',
    'thumbnail'     => 'toxid.jpg',
    'version'       => '2.3.3',
    'author'        => 'marmalade GmbH :: Joscha Krug',
    'extend' => array(
        'oxseodecoder'              => 'marm/toxid_curl/core/toxid_curl_oxseodecoder',
        'oxviewconfig'              => 'marm/toxid_curl/core/toxid_curl_oxviewconfig',
        'oxutilsview'               => 'marm/toxid_curl/core/toxid_curl_oxutilsview'
    ),
    'templates' => array(
        'toxid_curl.tpl'            => 'marm/toxid_curl/views/azure/toxid_curl.tpl',
        'product.tpl'               => 'marm/toxid_curl/views/azure/product.tpl',
        'toxid_setup_main.tpl'      => 'marm/toxid_curl/views/admin/tpl/toxid_setup_main.tpl',
        'toxid_content_widget.tpl'  => 'marm/toxid_curl/views/widgets/toxid_content_widget.tpl',
    ),
    'blocks' => array(
        array(
            'template' => '_formparams.tpl',
            'block'=>'admin_formparams',
            'file'=>'/views/admin/blocks/_formparams_admin_formparams.tpl'
        ),
        array(
            'template' => 'layout/base.tpl',
            'block'=>'head_title',
            'file'=>'/views/blocks/base_head_title.tpl'
        ),
        array(
            'template' => 'layout/base.tpl',
            'block'=>'head_meta_description',
            'file'=>'/views/blocks/base_head_meta_description.tpl'
        ),
        array(
            'template' => 'layout/base.tpl',
            'block'=>'head_meta_keywords',
            'file'=>'/views/blocks/base_head_meta_keywords.tpl'
        ),
        array(
            'template' => 'layout/base.tpl',
            'block'=>'head_link_canonical',
            'file'=>'/views/blocks/base_head_link_canonical.tpl'
        ),
    ),
    'files' => array(
        'toxid_curl'                => 'marm/toxid_curl/controller/toxid_curl.php',
        'toxidcurl'                 => 'marm/toxid_curl/core/toxidcurl.php',
        'toxid_setup'               => 'marm/toxid_curl/controller/admin/toxid_setup.php',
        'toxid_setup_main'          => 'marm/toxid_curl/controller/admin/toxid_setup_main.php',
        'toxid_setup_list'          => 'marm/toxid_curl/controller/admin/toxid_setup_list.php',
        'toxid_curl_events'         => 'marm/toxid_curl/core/toxid_curl_events.php',
        'toxid_curl_smarty_parser'  => 'marm/toxid_curl/core/facades/toxid_curl_smarty_parser.php',
        'toxid_curl_content_widget' => 'marm/toxid_curl/widgets/toxid_curl_content_widget.php',
    ),
    'settings' => array(
        array(
            'group' => 'toxid_config_not_here',
            'name'  => 'noConfigHere',
        ),
    ),
    'events' => array(
        'onActivate'    => 'toxid_curl_events::onActivate',
        'onDeactivate'  => 'toxid_curl_events::onDeactivate'
    )
);
