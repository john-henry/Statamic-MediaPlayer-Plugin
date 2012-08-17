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
	
		//Playlist Properties
		$playlistfile = ($this->fetch_param('playlistfile')) ? "playlistfile: '".$this->fetch_param('playlistfile')."',\n" : '';
		$duration = ($this->fetch_param('duration')) ? "duration: '".$this->fetch_param('duration')."',\n" : '';
		$file = ($this->fetch_param('file')) ? "file: '".$this->fetch_param('file')."',\n" : '';
		$image = ($this->fetch_param('image')) ? "image: '".$this->fetch_param('image')."',\n" : '';
		$height  = ($this->fetch_param('height')) ? "height: '".$this->fetch_param('height')."',\n" : '';
		$width  = ($this->fetch_param('width')) ? "width: '".$this->fetch_param('width')."',\n" : '';
		$mediaid = ($this->fetch_param('mediaid')) ? "mediaid: '".$this->fetch_param('mediaid')."',\n" : '';
		$provider = ($this->fetch_param('provider')) ? "provider: '".$this->fetch_param('provider')."',\n" : '';
		$start = ($this->fetch_param('start')) ? "start: '".$this->fetch_param('start')."',\n" : '';
		$streamer = ($this->fetch_param('streamer')) ? "streamer: '".$this->fetch_param('streamer')."',\n" : '';
		
		//Layout
		$controlbarPosition = ($this->fetch_param('controlbar.position')) ? "controlbar.position: '".$this->fetch_param('controlbar.position')."',\n" : '';
		$controlbarIdlehide = ($this->fetch_param('controlbar.idlehide')) ? "controlbar.idlehide: '".$this->fetch_param('controlbar.idlehide')."',\n" : '';
		$displayShowmute = ($this->fetch_param('display.showmute')) ? "display.showmute: '".$this->fetch_param('display.showmute')."',\n" : '';
		$dock = ($this->fetch_param('dock')) ? "dock: '".$this->fetch_param('dock')."',\n" : '';
		$icons = ($this->fetch_param('icons')) ? "icons: '".$this->fetch_param('icons')."',\n" : '';
		$playlistPosition = ($this->fetch_param('playlist.position')) ? "playlist.position: '".$this->fetch_param('playlist.position')."',\n" : '';
		$playlistSize = ($this->fetch_param('playlist.size')) ? "playlist.size: '".$this->fetch_param('playlist.size')."',\n" : '';
		$skin = ($this->fetch_param('skin')) ? "skin: '".$this->plugin_path."skins/".$this->fetch_param('skin').".zip',\n" : '';
		
		//Behaviour
		$autostart = ($this->fetch_param('autostart')) ? "autostart: '".$this->fetch_param('autostart')."',\n" : '';
		$bufferlength = ($this->fetch_param('bufferlength')) ? "bufferlength: '".$this->fetch_param('bufferlength')."',\n" : '';
		$id = ($this->fetch_param('id')) ? "id: ".$this->fetch_param('id')."',\n" : '';
		$item = ($this->fetch_param('item')) ? "item: '".$this->fetch_param('item')."',\n" : '';
		$mute = ($this->fetch_param('mute')) ? "mute: '".$this->fetch_param('mute')."',\n" : '';
		$netstreambasepath = ($this->fetch_param('netstreambasepath')) ? "netstreambasepath: '".$this->fetch_param('netstreambasepath')."',\n" : '';
		$playerready = ($this->fetch_param('playerready')) ? "playerready: '".$this->fetch_param('playerready')."',\n" : '';
		$plugins = ($this->fetch_param('plugins')) ? "plugins: '".$this->fetch_param('plugins')."',\n" : '';
		$repeat = ($this->fetch_param('repeat')) ? "repeat: '".$this->fetch_param('repeat')."',\n" : '';
		$shuffle = ($this->fetch_param('shuffle')) ? "shuffle: '".$this->fetch_param('shuffle')."',\n" : '';
		$smoothing = ($this->fetch_param('smoothing')) ? "smoothing: '".$this->fetch_param('smoothing')."',\n" : '';
		$stretching = ($this->fetch_param('stretching')) ? "stretching: '".$this->fetch_param('stretching')."',\n" : '';
		$volume = ($this->fetch_param('volume')) ? "volume: '".$this->fetch_param('volume')."',\n" : '';
		
		//Logo - the logo options can only be used for licensed players!
		$logoFile = ($this->fetch_param('logo.file')) ? "logo.file: '".$this->fetch_param('logo.file')."',\n" : '';
		$logoLink = ($this->fetch_param('logo.link')) ? "logo.link: '".$this->fetch_param('logo.link')."',\n" : '';
		$logoLinktarget = ($this->fetch_param('logo.linktarget')) ? "logo.linktarget: '".$this->fetch_param('logo.linktarget')."',\n" : '';
		$logoHide = ($this->fetch_param('logo.hide')) ? "logo.hide: '".$this->fetch_param('logo.hide')."',\n" : '';
		$logoMargin = ($this->fetch_param('logo.margin')) ? "logo.margin: '".$this->fetch_param('logo.margin')."',\n" : '';
		$logoPosition = ($this->fetch_param('logo.position')) ? "logo.position: '".$this->fetch_param('logo.position')."',\n" : '';
		$logoTimeout = ($this->fetch_param('logo.timeout')) ? "logo.timeout: '".$this->fetch_param('logo.timeout')."',\n" : '';
		$logoOver = ($this->fetch_param('logo.over')) ? "logo.over: '".$this->fetch_param('logo.over')."',\n" : '';
		$logoOut = ($this->fetch_param('logo.out')) ? "logo.out: '".$this->fetch_param('logo.out')."',\n" : '';
		
		//Colors
		$backcolor = ($this->fetch_param('backcolor')) ? "backcolor: '".$this->fetch_param('backcolor')."',\n" : '';	
		$frontcolor = ($this->fetch_param('frontcolor')) ? "frontcolor: '".$this->fetch_param('frontcolor')."',\n" : '';
		$lightcolor = ($this->fetch_param('lightcolor')) ? "lightcolor: '".$this->fetch_param('lightcolor')."',\n" : '';
		$screencolor = ($this->fetch_param('screencolor')) ? "screencolor: '".$this->fetch_param('screencolor')."',\n" : '';
		
		//Config XML
		$config = ($this->fetch_param('config')) ? "config: '".$this->fetch_param('config')."',\n" : '';
		
		
		
		
		
		$output = '<div id="mediaplayer">Loading the player ...</div>';
		$script = '
	<script type="text/javascript">
		jwplayer("mediaplayer").setup({
'.$playlistfile.''.$duration.''.$file.''.$image.''.$height.''.$width.''.$mediaid.''.$provider.''.$start.''.$streamer.''.$controlbarPosition.''.$controlbarIdlehide.''.$displayShowmute.''.$dock.''.$icons.''.$playlistPosition.''.$playlistSize.''.$skin.''.$autostart.''.$bufferlength.''.$id.''.$item.''.$mute.''.$netstreambasepath.''.$playerready.''.$plugins.''.$repeat.''.$shuffle.''.$smoothing.''.$stretching.''.$volume.''.$logoFile.''.$logoLink.''.$logoLinktarget.''.$logoHide.''.$logoMargin.''.$logoPosition.''.$logoTimeout.''.$logoOver.''.$logoOut.''.$backcolor.''.$frontcolor.''.$lightcolor.''.$screencolor.''.$config.'flashplayer: "'.$this->plugin_path.'mediaplayer/player.swf"
		});
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
