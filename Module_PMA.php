<?php
namespace GDO\PMA;

use GDO\Core\GDO_Module;
use GDO\Core\GDT_Checkbox;
use GDO\UI\GDT_Page;
use GDO\UI\GDT_Link;

/**
 * PHPMyAdmin module. Not recommended.
 * 
 * @author gizmore
 * @version 7.0.1
 * @since 6.5.0
 */
final class Module_PMA extends GDO_Module
{
	public int $priority = 80;
	public string $license = 'GPLv2';
	
	##############
	### Config ###
	##############
	public function getConfig() : array
	{
		return [
			GDT_Checkbox::make('hook_sidebar')->initial('0'),
		];
	}
	public function cfgHookSidebar() : bool { return $this->getConfigValue('hook_sidebar'); }
	
	#############
	### Hooks ###
	#############
	public function onInitSidebar() : void
	{
		if ($this->cfgHookSidebar())
		{
			GDT_Page::instance()->rightBar()->
				addField(GDT_Link::make('link_pma')->
					href($this->wwwPath('PHPMyAdmin')));
			
		}
	}
	
}
