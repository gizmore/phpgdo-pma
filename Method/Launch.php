<?php
namespace GDO\PMA\Method;

use GDO\Core\Method;

/**
 * Launch PMA utitlity.
 * Simply redirect.
 *
 * @version 7.0.1
 * @author gizmore
 */
final class Launch extends Method
{

	public function execute()
	{
		$href = $this->getModule()->wwwPath('phpmyadmin');
		return $this->redirect($href);
	}

}
