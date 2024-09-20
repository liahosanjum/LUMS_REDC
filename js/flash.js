/***
 * FlashSwapper
 * JavaScript Object that puts a Flash movie into your HTML if it is supported.
 * By Isaac Z. Schlueter
 *
 * Send it the ID of an HTML element (div or something) that contains the back-up contents by default.
 * Then, call the Swap() method, and it'll replace it.
 *
 * This flash detection/swapping object is liberally based on the Moock FPI
 * http://www.moock.org/webdesign/flash/detection/moockfpi/
 * and an article on the Frobnosticatorium
 * http://www.apeiros.com/frob/tech/detect/
 *
 * Thanks, Guys.
 * Isaac Z. Schlueter, KM, Data Strategies, Inc.
 *
 * USAGE:
 *
 * You can set all the variables in the constructor, and then call the Swap() method.
 *
					window.onload = function() {
						var Flasher = new FlashSwapper(
									6, //version - version of flash required, required
									'myMovie.swf', // fileName - the flash movie filename, required
									'myContainerID', //containerId - the ID of the element that we'll be swapping out, required.
									'myMovieName', //id - the id of the movie itself, optional.
									123, //width - movie width, optional
									123, //height - movie height, optional
									'high', //quality - movie quality, optional (low|medium|high)
									'opaque', //wmode - window mode, optional (window|opaque|transparent), requires at least version 6.
									'over'|'after'|'before' //swapMethod - whether or not it'll remove the container's innerHTML on swapping or be placed before or after it. optional, default=over
								);
						Flasher.Swap();
					}
 *
 * You may of course also set any of those properties after calling the constructor, as long as all the
 * required ones are set before you call Swap(), using LoadContainer to grab the container element, like so:
 *
					window.onload = function() {
						var Flasher = new FlashSwapper();
						Flasher.requiredVersion = 6;
						Flasher.fileName = 'myMovie.swf';
						Flasher.id = 'myMovieName';
						Flasher.width = 123;
						Flasher.LoadContainer('myContainerID');
						Flasher.height = 123;
						Flasher.wmode = 'opaque';
						Flasher.quality = 'high';
						Flasher.Swap();
					}
 *
 * If the swap fails, it'll return false, and the errors var will be set to the reason why.
 * In debugging, you might want to do this:
 *
					window.onload = function() {
						var Flasher = new FlashSwapper();
						Flasher.requiredVersion = 6;
						Flasher.fileName = 'myMovie.swf';
						Flasher.id = 'myMovieName';
						Flasher.width = 123;
						Flasher.height = 123;
						if(!Flasher.Swap())alert(Flasher.errors); // in this case, it would be because you didn't give it a container
					}
 *
 * To simply detect for a certain version, and not automatically swap, you may use the HasVersion() method.
 * Either send it a version number, or set the .requiredVersion property first.
 * 
					window.onload = function() {
						var Flasher = new FlashSwapper();
						if(Flasher.HasVersion(6)) {
							// the user has flash version 6 or higher
						} else if(Flasher.HasVersion(5)) {
							// the user has version 5 or higher
						} else if(Flasher.HasFlash) {
							// the user has flash, but less than version 5
						} else {
							// no flash at all.
						}
					}
 *
 ***/

// set this to the max version of flash that you'll ever deal with.
var MAX_FLASH_VERSION = 9;

// this needs to be global to use in VBScript with IE/Win
var FlashVersionInstalled = 0;

// the Object Definition
function FlashSwapper(flashVersionRequired, flashMovieFileName, flashContainerId, flashMovieId, flashMovieWidth, flashMovieHeight, flashMovieQuality, flashMovieWindowMode, flashswapMethod )
{
	// user-defined initializations
	if(flashVersionRequired)this.requiredVersion = flashVersionRequired;
	if(flashMovieFileName)this.fileName = flashMovieFileName;
	if(flashContainerId)this.LoadContainer(flashContainerId);
	if(flashMovieId)this.id = flashMovieId;
	if(flashMovieHeight)this.height = flashMovieHeight;
	if(flashMovieWidth)this.width = flashMovieWidth;
	if(flashMovieQuality)this.quality = flashMovieQuality;
	if(flashMovieWindowMode)this.wmode = flashMovieWindowMode;
	if(flashswapMethod)this.swapMethod = flashswapMethod;
	else this.swapMethod = 'over';

	//other variables
	this.errors = '';
	this.version = 0;

	this.LoadContainer = function(theId) {
		if(!document.getElementById){
			this.containerId = '';
			this.container = null;
		}else{
			if(theId) this.containerId = theId;
			this.container = document.getElementById(this.containerId);
		}
	}

	this.HasVersion = function(sVersion)
	{
		if(!this.DetectFlash())return false;
		if(!sVersion)sVersion = this.requiredVersion;
		if(!sVersion){
			this.errors += 'No version specified.  Set the requiredVersion property or send a version as an argument to HasVersion.\n';
			return false;
		}
		if(!this.version) {
			this.errors +='No version could be found.\n';
			return false;
		}
		return (this.version >= sVersion);
	}

	this.DetectFlash = function()
	{
		if(this.Detected) return this.HasFlash;

		this.Detected = false;

		this.HasFlash=false;
		var flashDescription = '';
		if(!navigator)return false; //??

		if(navigator.appVersion) {
			if(navigator.appVersion.indexOf("MSIE") != -1 && navigator.appVersion.toLowerCase().indexOf("win") != -1)this.version = FlashVersionInstalled;
		}

		if(navigator.mimeTypes||navigator.plugins){
			if(navigator.mimeTypes) {
				if(navigator.mimeTypes['application/x-shockwave-flash']){
					this.HasFlash=true;
					if(navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin){
						if(navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin.description){
							// A flash plugin-description (usually) looks like this: Shockwave Flash 7.0 r19
							// pull the first number out of it, and hope for the best!
							flashDescription=navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin.description;
						}else this.errors+='no description on the flash plugin.\n'; //can't know version without description.
					}else this.errors+='the mimeType is defined, but no plugin is enabled.\n'; //? this is weird.  
				}
			}else{
				//no mimeTypes.  Try the plugins array
				if(navigator.plugins['Shockwave Flash']||navigator.plugins['Shockwave Flash 2.0']){
					var isVersion2 = navigator.plugins['Shockwave Flash 2.0'] ? ' 2.0' : '';
					flashDescription = navigator.plugins['Shockwave Flash' + isVersion2].description;
				}
			}
		}
		if(flashDescription != '') {
			//found something somewhere...
			var v=parseInt(flashDescription.replace(/^[^0-9]*/,''));
			if(!isNaN(v))this.version=v;
		}
		//doing this in a weird way because we might have flash, and yet not know the version.
		if(this.version){
			this.HasFlash=true;
			//whatever the error was, we worked past it!
			this.errors='';
		}
		this.Detected = true;
		return this.HasFlash;
	}

	this.Swap = function() {
		if(!document.getElementById)this.errors += 'Not using a DOM-compatible browser.  Could not swap.\n';
		if(!this.DetectFlash())this.errors += 'No flash detected.\n';
		if(!this.container)this.errors+='Container not found id:['+this.containerId+']\n';
		else if(!this.container.innerHTML)this.errors += 'No innerHTML property on container.\n';
		if(this.version<this.requiredVersion)this.errors +='Flash Version not sufficient.  Have:'+this.version+' Need:'+this.requiredVersion+'\n';
		if(!this.fileName)this.errors += 'Flash movie filename not specified!\n';
		if(this.errors!='')return false;

		var sHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" '+
			'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version='+this.requiredVersion+',0,0,0" ';
		if(this.width) sHTML += 'width="'+this.width+'" ';
		if(this.height) sHTML += 'height="'+this.height+'" ';
		if(this.id)sHTML += 'id="'+this.id+'"';
		sHTML += '><param name="movie" value="'+this.fileName+'" />';
		if(this.wmode && this.requiredVersion >= 6)sHTML += '<param name="wmode" value="'+this.wmode+'" />';
		if(this.quality)sHTML+='<param name="quality" value="'+this.quality+'" />';
		sHTML+='<embed wmode="opaque" src="'+this.fileName+'"';
		if(this.quality)sHTML+=' quality="'+this.quality+'"';
		if(this.width)sHTML+=' width="'+this.width+'"';
		if(this.height)sHTML+=' height="'+this.height+'"';
		if(this.id)sHTML+=' name="'+this.id+'"';
		sHTML+=' type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>';

		if(this.swapMethod=='over')this.container.innerHTML = sHTML;
		else if(this.swapMethod=='before') this.container.innerHTML = sHTML + this.container.innerHTML;
		else this.container.innerHTML+=sHTML;

		return true;
	}
}

// Write vbscript detection on ie win. IE on Windows doesn't support regular
// JavaScript plugins array detection.
// I changed the VBScript from the original MoockFPI in order to reduce the
// number of steps that the browser must go through. --IZS
if(navigator){
	if(navigator.appVersion) {
		if(navigator.appVersion.indexOf("MSIE") != -1 && navigator.appVersion.toLowerCase().indexOf("win") != -1) {
			document.write('<scr' + 'ipt language="VBScript" type="text/VBScript"> \n');
			document.write('on error resume next\n');
			document.write('dim i,f\n');
			document.write('i = MAX_FLASH_VERSION\n');
			document.write('Do While i >= 2 \n');
			document.write('	Set f = CreateObject("ShockwaveFlash.ShockwaveFlash." & i)\n');
			document.write('	If Err.Number = 0 Then\n');
			document.write('		FlashVersionInstalled = i\n');
			document.write('		Set f = Nothing\n');
			document.write('		Exit Do\n');
			document.write('  Else\n');
			document.write('    Err.Clear\n');
			document.write('	End If\n');
			document.write('	Set f = Nothing\n');
			document.write('	i = i - 1\n');
			document.write('Loop\n');
			document.write('<\/scr' + 'ipt> \n'); // break up end tag so it doesn't end our script
		}
	}
}