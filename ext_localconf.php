<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

if (!defined ('SR_EMAIL_SUBSCRIBE_EXTkey')) {
	define('SR_EMAIL_SUBSCRIBE_EXTkey',$_EXTKEY);
}

if (!defined ('PATH_BE_sremailsubscribe')) {
	define('PATH_BE_sremailsubscribe', t3lib_extMgm::extPath(SR_EMAIL_SUBSCRIBE_EXTkey));
}

if (!defined ('PATH_BE_sremailsubscribe_rel')) {
	define('PATH_BE_sremailsubscribe_rel', t3lib_extMgm::extRelPath(SR_EMAIL_SUBSCRIBE_EXTkey));
}

if (!defined ('PATH_FE_sremailsubscribe_rel')) {
	define('PATH_FE_sremailsubscribe_rel', t3lib_extMgm::siteRelPath(SR_EMAIL_SUBSCRIBE_EXTkey));
}

if (!defined ('SR_FEUSER_REGISTER_EXTkey')) {
	define('SR_FEUSER_REGISTER_EXTkey','sr_feuser_register');
}

if (!defined ('FH_LIBRARY_EXTkey')) {
	define('FH_LIBRARY_EXTkey','fh_library');
}

$bPhp5 = version_compare(phpversion(), '5.0.0', '>=');

t3lib_extMgm::addPItoST43(SR_EMAIL_SUBSCRIBE_EXTkey, 'pi1/class.tx_sremailsubscribe_pi1.php', '_pi1', 'list_type', 0);

$_EXTCONF = unserialize($_EXTCONF);    // unserializing the configuration so we can use it here:

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['imageFolder'] = $_EXTCONF['imageFolder'];
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['useFlexforms'] = $_EXTCONF['useFlexforms'];

if (t3lib_extMgm::isLoaded(DIV2007_EXTkey))	{
	if (!defined ('PATH_BE_div2007')) {
		define('PATH_BE_div2007', t3lib_extMgm::extPath(DIV2007_EXTkey));
	}
}

if (t3lib_extMgm::isLoaded(DIV2007_EXTkey) && $bPhp5) {
	// nothing
} else if (t3lib_extMgm::isLoaded(FH_LIBRARY_EXTkey)) {
	if (!defined ('PATH_BE_fh_library')) {
		define('PATH_BE_fh_library', t3lib_extMgm::extPath(FH_LIBRARY_EXTkey));
	}
} else {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['useFlexforms'] = 0;
}

if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][SR_EMAIL_SUBSCRIBE_EXTkey]['useFlexforms'] && $bPhp5)	{
	// replace the output of the former CODE field with the flexform
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][SR_EMAIL_SUBSCRIBE_EXTkey.'_pi1'][] = 'EXT:'.SR_EMAIL_SUBSCRIBE_EXTkey.'/hooks/class.tx_sremailsubscribe_hooks_cms.php:&tx_sremailsubscribe_hooks_cms->pmDrawItem';
}

?>
