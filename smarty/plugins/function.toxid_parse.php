<?php

/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File: function.toxid_parse.php
 * Type: string, html
 * Name: toxid_parse
 * Purpose: Parse Toxid content and replace sections by toxid_load code
 *
 * Remove everything wrapped by <!--OX-HIDE-->*<!--/OX-HIDE-->
 * Search for <!--TOXID:ArtikelID,Imageformat-->
 * Add [{ toxid_load type="oxarticle" oxid="943ed656e21971fb2f1827facbba9bec" assign="oProduct"}]
 * to load oxarticle object to oProduct by its oxid
 * Add [{toxid_load type="oxarticle" ident="0802-85-823" assign="oProduct"}]
 * to load oxarticle object to oProduct by its artnum
 *
 * -------------------------------------------------------------
 *
 * @param array  $params  params
 * @param Smarty &$smarty clever simulation of a method
 *
 * @return string
 */
function smarty_function_toxid_parse( $params, &$smarty )
{
	if(!isset($params['sSnippet'])) {
		return '';
	}

	if(empty($params['tpl'])) {
		$params['tpl'] = 'widget/product/listitem_cms.tpl';
	}

	if(!isset($params['prepend']) || !isset($params['append'])) {
		$params['prepend'] = '<div class="productData" itemscope itemtype="http://schema.org/Product">';
		$params['append'] = '</div>';
	}

	$smarty->assign('blDisableToCart', empty($params['blDisableToCart']) ? false : true);
	$smarty->assign('blDisableCompare', empty($params['blDisableCompare']) ? false : true);

	// Replace
	$params['sSnippet'] = preg_replace('/<!--OX-HIDE-->.*?<!--\/OX-HIDE-->/s', '', $params['sSnippet']);

	// Get Oxid Article Number

	if(preg_match_all('/<!--TOXID:(.+?)-->/', $params['sSnippet'], $match)) {

		$colSpans = array(
			1	=> 12,
			2	=> 6,
			3	=> 4,
			4	=> 3,
			5	=> 2,
			6	=> 2,
			7	=> 3,
			8	=> 3,
			9	=> 4,
			10	=> 2,
			11	=> 2,
			12	=> 3
		);

		foreach($match[1] as $key => $value) {

			$value = explode('|', $value, 3);

			$sIdent = trim($value[0]);

			if(!$sIdent) {
				$match[1][$key] = '';
				continue;
			}

			$itemCount = empty($value[2]) ? 4 : intval($value[2]);

			$colSpan = $itemCount > 12 ? 3 : $colSpans[$itemCount];
			$prepend = sprintf($params['prepend'], $colSpan);

			// Init Object
			$oObject = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);

			// Get OxidObject by Article Number
			$sOxid = oxDb::getDb()->getOne( 'SELECT OXID FROM oxarticles WHERE OXARTNUM = ?', array($sIdent) );

			if($sOxid) {
				$oObject->load($sOxid);
				$smarty->assign('product', $oObject);
				$match[1][$key] = $prepend . $smarty->fetch($params['tpl']) . $params['append'];
			} else {
				$match[1][$key] = $prepend . $sIdent . $params['append'];
			}

			// ToDo: Image Type
			//$value[1] = isset($value[1]) ? trim($value[1]) : 0;

		}

		$params['sSnippet'] = str_replace($match[0], $match[1], $params['sSnippet']);

	}

	return $params['sSnippet'];
}
