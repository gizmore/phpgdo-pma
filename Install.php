<?php
namespace GDO\PMA;

use GDO\Util\Random;
use GDO\Core\Website;

final class Install
{
	public static function onInstall(Module_PMA $module) : void
	{
		self::createConfig($module);
	}
	
	private static function createConfig(Module_PMA $module) : void
	{
		# template
		$source = $module->filePath('phpmyadmin/config.sample.inc.php');
		$content = file_get_contents($source);
		
		# secret
		$blowfish = Random::randomKey(32);
		$content = preg_replace('/$cfg\\[\'blowfish_secret\'\\] = \'\'/iD', '$cfg[\'blowfish_secret\'] = \''.$blowfish.'\'' , $content);
		
		# credentials
// 		$content = preg_replace('#// $cfg[\'Servers\'][$i][\'controlhost\'] = \'\';#iD',
// 			'$cfg[\'Servers\'][$i][\'controlhost\'] = \''.GDO_DB_HOST.'\';', $content);
// 		$content = preg_replace('#// $cfg[\'Servers\'][$i][\'controlport\'] = \'\';#iD',
// 			'$cfg[\'Servers\'][$i][\'controlhost\'] = \''.GDO_DB_PORT.'\';', $content);
		
// 				$content = preg_replace('/$cfg[\'blowfish_secret\'] = (\'.*\');/iD', $blowfish, $content);
// 		$content = preg_replace('/$cfg[\'blowfish_secret\'] = (\'.*\');/iD', $blowfish, $content);
// 		$content = preg_replace('/$cfg[\'blowfish_secret\'] = (\'.*\');/iD', $blowfish, $content);
// 		$content = preg_replace('/$cfg[\'blowfish_secret\'] = (\'.*\');/iD', $blowfish, $content);
// 		// $cfg['Servers'][$i]['controlhost'] = '';
// 		// $cfg['Servers'][$i]['controlport'] = '';
// 		// $cfg['Servers'][$i]['controluser'] = 'pma';
// 		// $cfg['Servers'][$i]['controlpass'] = 'pmapass';
		
		$destination = $module->filePath('phpmyadmin/config.inc.php');
		file_put_contents($destination, $content);
		
		Website::message('PhpMyAdmin Install', 'msg_pma_installed');
	}
	
}
