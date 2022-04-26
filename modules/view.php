<?php
namespace Modules;

class View {
	public function __construct()
	{
		if(DEBUG)
		{
			echo 'Base view construct</br>';
		}
	}
	
	public function debug($val, $exit = false)
	{
		print_r("<pre>");
		print_r($val);
		if($exit)
		{
			exit();
		}
	}
	
	public function render($active_page, string $html = '', string $template = 'default.php')
	{
		$nav = self::get_nav($active_page);
		include_once(TEMPLATES_PATH . $template);
	}
	
	public function pretty_text($text)
	{
		return(ucwords(str_replace('_', ' ', $text)));
	}
	
	public function get_nav($active_page = null, $user = null)
	{
		$nav   = [];
		$links = [];
		
		$links[] = ['index'];
		$links[] = ['entry', 'add', 'view_all'];
		
		$nav[] = '<div id="nav">';
		
		// GasLog Logo
		$nav[] = $this->get_logo();
		
		foreach($links as $link)
		{
			$nav[] = '<div class="nav-element">';
			$class = '';
			if(in_array($active_page, $link, true))
			{
				$class = 'class="active"';
			}
			
			$nav_element = [];
			$nav_element[] = '<ul>';
			
			$c = 0;
			foreach($link as $sub_link)
			{
				if($c == 0)
				{
					$nav_element[] = '<li><a '. $class .' href="/GasLog/'. ucfirst($sub_link) .'">' . self::pretty_text($sub_link) . '</a></li>';
				} else {
					$nav_element[] = '<li><a href="/GasLog/'. ucfirst($link[0]) .'/' . $sub_link . '">' . self::pretty_text($sub_link) . '</a></li>';
				}
				
				$c++;
			}
			
			$nav_element[] = '</ul>';
			$nav[] = implode($nav_element);
			
			$nav[] = '</div>';
		}
		
		$nav[] = '</div>';
		
		return implode($nav);
	}
	
	public function get_logo(int $size = 45)
	{
		$logo = [];
		$logo[] = '<div id="logo-container">';
		$logo[] = '<svg id="logo-img" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"><path d="M14.5 6.497h.5v-.139l-.071-.119-.429.258zm-14 0l-.429-.258L0 6.36v.138h.5zm2.126-3.541l-.429-.258.429.258zm9.748 0l.429-.258-.429.258zM3.5 11.5V11H3v.5h.5zm8 0h.5V11h-.5v.5zM14 6.497V12.5h1V6.497h-1zM.929 6.754l2.126-3.54-.858-.516L.071 6.24l.858.515zM5.198 2h4.604V1H5.198v1zm6.747 1.213l2.126 3.541.858-.515-2.126-3.54-.858.514zM2.5 13h-1v1h1v-1zm.5-1.5v1h1v-1H3zM13.5 13h-1v1h1v-1zm-1.5-.5v-1h-1v1h1zm-.5-1.5h-8v1h8v-1zM1 12.5V6.497H0V12.5h1zm11.5.5a.5.5 0 01-.5-.5h-1a1.5 1.5 0 001.5 1.5v-1zm-10 1A1.5 1.5 0 004 12.5H3a.5.5 0 01-.5.5v1zm-1-1a.5.5 0 01-.5-.5H0A1.5 1.5 0 001.5 14v-1zM9.802 2a2.5 2.5 0 012.143 1.213l.858-.515A3.5 3.5 0 009.802 1v1zM3.055 3.213A2.5 2.5 0 015.198 2V1a3.5 3.5 0 00-3 1.698l.857.515zM14 12.5a.5.5 0 01-.5.5v1a1.5 1.5 0 001.5-1.5h-1zM2 10h3V9H2v1zm11-1h-3v1h3V9zM3 7h9V6H3v1z" fill="currentColor"></path></svg>';
		$logo[] = '<span id="logo-text">GasLog</span>';
		$logo[] = '</div>';
		
		return implode($logo);
	}
	
	public function msg($text, string $class = null)
	{
		$msg = [];
		
		if(!is_null($class))
		{
			$class = $class . " msg";
		} else {
			$class = "msg";
		}
		
		$msg[] = "<div class='$class'><p>";
		
		if(is_array($text))
		{
			$text = implode($text);
		}
		
		$msg[] = $text;
		
		$msg[] = "</p></div>";
		
		return implode($msg);
	}
	
	public function display_money($money)
	{
		return "$$money";
	}
	
	public function display_date($date)
	{
		return date("d/m/Y", strtotime($date));
	}
	
	public function display_km($kilos)
	{
		return "$kilos kms";
	}
}

?>