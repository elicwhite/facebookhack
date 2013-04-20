<?php
namespace Application\Modules\Main;

/**
 * Copyright Eli White & SaroSoftware 2010
 * Last Modified: 4/21/2010
 *
 * This file is part of Saros Framework.
 *
 * Saros Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Saros Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Saros Framework.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Initialization class for the Main Module
 */
class Setup
{

	public static $defaultController = "Index";
	public static $defaultAction = "index";

	/**
	 * Sets some settings for the application
	 */
	public function doSetup($registry)
	{
        session_start();

        $storage = new \Application\Classes\OAuth\Storage\SarosSession();

        $registry->fb = new \Application\Classes\FB($_SERVER["CLIENT"], $_SERVER["SECRET"], $registry->utils->makeLink("Login", "callback"), $storage);
	}
}