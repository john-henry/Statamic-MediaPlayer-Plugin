<?php

class Plugin_mediaplayer extends Plugin {

	var $meta = array(
		'name'  => 'MediaPlayer',
		'version' => '0.8',
		'author' => 'John Henry Donovan',
		'author_url'=> 'http://johnhenry.ie'
	);

	function __construct() {
		parent::__construct();
		$this->site_root  = Statamic::get_site_root();
		$this->theme_root = Statamic::get_templates_path();
		$this->plugin_path = $this->getPluginPath();
	}


	public function head()
	{

		$js = '<script src="'.$this->plugin_path.'mediaplayer/jwplayer.js" type="text/javascript"> </script>';

		return $js;
	}



	function index() {

		$settings = array();

		$available_settings = array(
			//Playlist Properties
			'playlistfile',
			'duration',
			'file',
			'image',
			'height',
			'width',
			'mediaid',
			'provider',
			'start',
			'streamer',

			//Layout
			'controlbar.position',
			'controlbar.idlehide',
			'display.showmute',
			'dock',
			'icons',
			'playlist.position',
			'playlist.size',
			'skin',
			'autostart',
			'bufferlength',
			'id',
			'item',
			'mute',
			'netstreambasepath',
			'playerready',
			'plugins',
			'repeat',
			'shuffle',
			'smoothing',
			'stretching',
			'volume',

			//Behaviour
			'logo.file',
			'logo.link',
			'logo.linktarget',
			'logo.hide',
			'logo.margin',
			'logo.position',
			'logo.timeout',
			'logo.over',
			'logo.out',

			//Logo - the logo options can only be used for licensed players!
			'backcolor',
			'frontcolor',
			'lightcolor',
			'screencolor',

			//Config XML
			'config'

		);

		foreach ($available_settings as $key => $setting) {

			#check if set, defaults to false with second param
			if ($value = $this->fetch_param($setting, false)) {
				$settings[$setting] = $value;
			}
		}

		// Special rules
		if ($skin = ($this->fetch_param('skin', false))) {
			$settings['skin'] = $this->plugin_path."skins/".$skin.'.zip';
		}

		$settings['flashplayer'] = $this->plugin_path.'mediaplayer/player.swf';

		$settings = json_encode($settings);
		
		
		$output = '<div id="mediaplayer">Loading the player ...</div>';
		$script = '
	<script type="text/javascript">
		jwplayer("mediaplayer").setup('.$settings.');
	</script>
	';
		return $output . $script;
	}

	/**
	 * Returns the path of this plugin folder.
	 * @return string
	 */
	private function getPluginPath() {
		$plugindir = basename(dirname(__FILE__));
		$parentdir = basename(dirname(dirname(__FILE__)));
		$pluginpath = Statamic_helper::reduce_double_slashes($this->site_root.'/'.$parentdir .'/' . $plugindir."/");

		return $pluginpath;
	}
}
