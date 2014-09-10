<?php
/* 
LesSmarty.class.php - A less smart Smarty-like template engine. 

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
class LesSmarty
{
	private $vars;

	public function __construct()
	{
		$this->vars = array();
	}

	public function assign($key, $value)
	{
		$this->vars[$key] = $value;
	}

	// support only primitive variables
	public function display($tpl)
	{
		//$matches = array();

		$tc = file_get_contents($tpl);
		$dc = "";
		if($tc)
		{
			while (preg_match('/{\$(.*)}/', $tc, 
				$matches, PREG_OFFSET_CAPTURE, 0))
			{
			    //var_dump($matches);
			
				// variable reference pos in template file
			    $var_ref_start = $matches[0][1];
			    $var_ref_end = $var_ref_start + strlen($matches[0][0]);

			    $var_key = $matches[1][0];

			    foreach ($this->vars as $vk => $vv)
			    {
				    if ($vk == $var_key)
				    {
					    $dc .= substr($tc, 0, $var_ref_start);
						$dc .= $vv;

						$tc = substr($tc, $var_ref_end);
				    }
			    }
			}

			$dc .= $tc;
            echo $dc;
		}
	}
}

/*
for test
$lessmarty = new LesSmarty;
$lessmarty->assign("name", "Cloud");
$lessmarty->assign("no", 234);
$lessmarty->display("test.tpl");
*/
