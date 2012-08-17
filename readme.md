Statamic Media Player Plugin
================================

The Media Player for Flash and HTML5 Plugin enables you to deliver video content through your Statamic Website. 

## Installing
1. Download the zip file (or clone via git) and unzip it or clone the repo into `/_add-ons/`.
2. Ensure the folder name is `mediaplayer` (Github timestamps the download folder).


## Usage

Add the following to the head of your layout template
    
    {{ mediaplayer:head}}
    
Either in template or post content field add following tag

   {{ mediaplayer file="/assets/video/video.mp4" image="/assets/img/preview.jpg" skin="carbon" height="360" width="640" }}

---

## Changelog 

Version : 0.8
	* Initial Release

