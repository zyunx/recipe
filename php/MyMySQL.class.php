<?php
/* 
MyMySQL.class.php - Access mysql database using singleton pattern. 

Copyright (C) 2014 Zhang Yun<cloud2han9@163.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class MyMySQL extends mysqli
{
	private static $instance;

	// config
	private $db_host;
	private $db_user;
	private $db_password;
	private $db_name;
	private $db_charset = "utf8";

	public static function singleton()
	{
		if (!isset($instance))
		{
			$instance = new MyMySQL;
			$instance->set_charset($this->db_charset);
		}

		return $instance;
	}

	private function __construct()
	{
		parent::__construct($this->db_host, $this->db_user,
		                    $this->db_password, $this->db_name);
	}

	public function __destruct()
	{
		parent::close();
		//echo "D\n";
	}


}

