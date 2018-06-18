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
        'oxseodecoder'              => 'jkrug/toxid_curl/core/toxid_curl_oxseodecoder',
        'oxviewconfig'              => 'jkrug/toxid_curl/core/toxid_curl_oxviewconfig',
        'oxutilsview'               => 'jkrug/toxid_curl/core/toxid_curl_oxutilsview'
    ),
    'templates' => array(
        'toxid_curl.tpl'            => 'jkrug/toxid_curl/views/azure/toxid_curl.tpl',
        'product.tpl'               => 'jkrug/toxid_curl/views/azure/product.tpl',
        'toxid_setup_main.tpl'      => 'jkrug/toxid_curl/views/admin/tpl/toxid_setup_main.tpl',
        'toxid_content_widget.tpl'  => 'jkrug/toxid_curl/views/widgets/toxid_content_widget.tpl',
    ),
    'blocks' => array(
        array(
            'template' => '_formparams.tpl',
            'block'=>'admin_formparams',
            'file'=>'/views/admin/blocks/_formparams_admin_formparams.tpl'
        ),
    ),
    'files' => array(
        'toxid_curl'                => 'jkrug/toxid_curl/controller/toxid_curl.php',
        'toxidcurl'                 => 'jkrug/toxid_curl/core/toxidcurl.php',
        'toxid_setup'               => 'jkrug/toxid_curl/controller/admin/toxid_setup.php',
        'toxid_setup_main'          => 'jkrug/toxid_curl/controller/admin/toxid_setup_main.php',
        'toxid_setup_list'          => 'jkrug/toxid_curl/controller/admin/toxid_setup_list.php',
        'toxid_curl_events'         => 'jkrug/toxid_curl/core/toxid_curl_events.php',
        'toxid_curl_smarty_parser'  => 'jkrug/toxid_curl/core/facades/toxid_curl_smarty_parser.php',
        'toxid_curl_content_widget' => 'jkrug/toxid_curl/widgets/toxid_curl_content_widget.php',
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
