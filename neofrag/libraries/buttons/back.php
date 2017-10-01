<?php
/**
 * https://neofr.ag
 * @author: Michaël BILCOT <michael.bilcot@neofr.ag>
 */

namespace NF\NeoFrag\Libraries\Buttons;

use NF\NeoFrag\Library;

class Back extends Library
{
	public function __invoke($url = '', $title = '')
	{
		return $this->button()
					->title($title ?: $this->lang('back'))
					->url($this->session->get_back() ?: $url)
					->color('light');
	}
}
