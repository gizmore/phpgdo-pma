<?php
namespace GDO\PMA;

use GDO\Core\GDO_Module;
use GDO\Core\GDT_Checkbox;
use GDO\Core\WithComposer;
use GDO\UI\GDT_Link;
use GDO\UI\GDT_Page;

/**
 * PHPMyAdmin module. Not recommended.
 *
 * @version 7.0.1
 * @since 6.5.0
 * @author gizmore
 */
final class Module_PMA extends GDO_Module
{

	use WithComposer;

	public int $priority = 80;
	public string $license = 'GPLv2';

	public function href_administrate_module(): ?string
	{
		return $this->href('Launch');
	}

	public function getLicenseFilenames(): array
	{
		return [
			'phpmyadmin/LICENSE',
		];
	}

	public function thirdPartyFolders(): array
	{
		return [
			'/phpmyadmin/',
		];
	}

	##############
	### Config ###
	##############
	public function getConfig(): array
	{
		return [
			GDT_Checkbox::make('hook_sidebar')->initial('0'),
		];
	}

	public function onLoadLanguage(): void
	{
		$this->loadLanguage('lang/pma');
	}

	#############
	### Hooks ###
	#############

	public function onInstall(): void
	{
		Install::onInstall($this);
	}

	public function onInitSidebar(): void
	{
		if ($this->cfgHookSidebar())
		{
			GDT_Page::instance()->rightBar()->
			addField(GDT_Link::make('link_pma')->
			label('pma')->
			href($this->href('Launch')));
		}
	}

	public function cfgHookSidebar(): bool { return $this->getConfigValue('hook_sidebar'); }

}
