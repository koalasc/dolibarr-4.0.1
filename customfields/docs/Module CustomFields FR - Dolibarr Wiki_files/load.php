var isCompatible=function(){if(navigator.appVersion.indexOf('MSIE')!==-1&&parseFloat(navigator.appVersion.split('MSIE')[1])<6){return false;}return true;};var startUp=function(){mediaWiki.loader.register([["site","1408189534",[],"site"],["startup","20140905102159",[],"startup"],["user","1408189534",[],"user"],["user.options","1408189534",[],"private"],["skins.vector","1408189534",[]],["skins.monobook","1408189534",[]],["skins.simple","1408189534",[]],["skins.chick","1408189534",[]],["skins.modern","1408189534",[]],["skins.cologneblue","1408189534",[]],["skins.nostalgia","1408189534",[]],["skins.standard","1408189534",[]],["jquery","1408189534",[]],["jquery.async","1408189534",[]],["jquery.autoEllipsis","1408189534",["jquery.highlightText"]],["jquery.checkboxShiftClick","1408189534",[]],["jquery.client","1408189534",[]],["jquery.collapsibleTabs","1408189534",[]],["jquery.color","1408189534",[]],["jquery.cookie","1408189534",[]],["jquery.delayedBind","1408189534",[]],[
"jquery.expandableField","1408189534",[]],["jquery.highlightText","1408189534",[]],["jquery.placeholder","1408189534",[]],["jquery.localize","1408189534",[]],["jquery.suggestions","1408189534",["jquery.autoEllipsis"]],["jquery.tabIndex","1408189534",[]],["jquery.textSelection","1408189534",[]],["jquery.tipsy","1408189534",[]],["jquery.ui.core","1408189534",["jquery"]],["jquery.ui.widget","1408189534",[]],["jquery.ui.mouse","1408189534",["jquery.ui.widget"]],["jquery.ui.position","1408189534",[]],["jquery.ui.draggable","1408189534",["jquery.ui.core","jquery.ui.mouse","jquery.ui.widget"]],["jquery.ui.droppable","1408189534",["jquery.ui.core","jquery.ui.mouse","jquery.ui.widget","jquery.ui.draggable"]],["jquery.ui.resizable","1408189534",["jquery.ui.core","jquery.ui.widget","jquery.ui.mouse"]],["jquery.ui.selectable","1408189534",["jquery.ui.core","jquery.ui.widget","jquery.ui.mouse"]],["jquery.ui.sortable","1408189534",["jquery.ui.core","jquery.ui.widget","jquery.ui.mouse"]],[
"jquery.ui.accordion","1408189534",["jquery.ui.core","jquery.ui.widget"]],["jquery.ui.autocomplete","1408189534",["jquery.ui.core","jquery.ui.widget","jquery.ui.position"]],["jquery.ui.button","1408189534",["jquery.ui.core","jquery.ui.widget"]],["jquery.ui.datepicker","1408189534",["jquery.ui.core"]],["jquery.ui.dialog","1408189534",["jquery.ui.core","jquery.ui.widget","jquery.ui.button","jquery.ui.draggable","jquery.ui.mouse","jquery.ui.position","jquery.ui.resizable"]],["jquery.ui.progressbar","1408189534",["jquery.ui.core","jquery.ui.widget"]],["jquery.ui.slider","1408189534",["jquery.ui.core","jquery.ui.widget","jquery.ui.mouse"]],["jquery.ui.tabs","1408189534",["jquery.ui.core","jquery.ui.widget"]],["jquery.effects.core","1408189534",["jquery"]],["jquery.effects.blind","1408189534",["jquery.effects.core"]],["jquery.effects.bounce","1408189534",["jquery.effects.core"]],["jquery.effects.clip","1408189534",["jquery.effects.core"]],["jquery.effects.drop","1408189534",[
"jquery.effects.core"]],["jquery.effects.explode","1408189534",["jquery.effects.core"]],["jquery.effects.fold","1408189534",["jquery.effects.core"]],["jquery.effects.highlight","1408189534",["jquery.effects.core"]],["jquery.effects.pulsate","1408189534",["jquery.effects.core"]],["jquery.effects.scale","1408189534",["jquery.effects.core"]],["jquery.effects.shake","1408189534",["jquery.effects.core"]],["jquery.effects.slide","1408189534",["jquery.effects.core"]],["jquery.effects.transfer","1408189534",["jquery.effects.core"]],["mediawiki","1408189534",[]],["mediawiki.util","1408189534",["jquery.checkboxShiftClick","jquery.client","jquery.placeholder"]],["mediawiki.action.history","1408189534",["mediawiki.legacy.history"]],["mediawiki.action.edit","1408189534",[]],["mediawiki.action.view.rightClickEdit","1408189534",[]],["mediawiki.special.preferences","20140905102159",[]],["mediawiki.special.search","1408189534",[]],["mediawiki.language","1408189534",[]],["mediawiki.legacy.ajax",
"20140816114859",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.ajaxwatch","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.block","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.commonPrint","1408189534",[]],["mediawiki.legacy.config","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.diff","1408189534",["mediawiki.legacy.wikibits"],"mediawiki.action.history"],["mediawiki.legacy.edit","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.enhancedchanges","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.history","1408189534",["mediawiki.legacy.wikibits"],"mediawiki.action.history"],["mediawiki.legacy.htmlform","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.IEFixes","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.metadata","20140818201325",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.mwsuggest","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.prefs","1408189534",[
"mediawiki.legacy.wikibits","mediawiki.legacy.htmlform"]],["mediawiki.legacy.preview","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.protect","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.search","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.shared","1408189534",[]],["mediawiki.legacy.oldshared","1408189534",[]],["mediawiki.legacy.upload","1408189534",["mediawiki.legacy.wikibits"]],["mediawiki.legacy.wikibits","20140816114859",["mediawiki.language"]],["mediawiki.legacy.wikiprintable","1408189534",[]]]);mediaWiki.config.set({"wgLoadScript":"/load.php","debug":false,"skin":"dolibarr","stylepath":"/skins","wgUrlProtocols":"http\\:\\/\\/|https\\:\\/\\/|ftp\\:\\/\\/|irc\\:\\/\\/|gopher\\:\\/\\/|telnet\\:\\/\\/|nntp\\:\\/\\/|worldwind\\:\\/\\/|mailto\\:|news\\:|svn\\:\\/\\/|git\\:\\/\\/|mms\\:\\/\\/","wgArticlePath":"/index.php/$1","wgScriptPath":"","wgScriptExtension":".php","wgScript":"/index.php","wgVariantArticlePath":false,
"wgActionPaths":[],"wgServer":"http://wiki.dolibarr.org","wgUserLanguage":"en","wgContentLanguage":"en","wgVersion":"1.17.0","wgEnableAPI":true,"wgEnableWriteAPI":false,"wgSeparatorTransformTable":["",""],"wgDigitTransformTable":["",""],"wgMainPageTitle":"Main Page","wgFormattedNamespaces":{"-2":"Media","-1":"Special","0":"","1":"Talk","2":"User","3":"User talk","4":"Dolibarr Wiki","5":"Dolibarr Wiki talk","6":"File","7":"File talk","8":"MediaWiki","9":"MediaWiki talk","10":"Template","11":"Template talk","12":"Help","13":"Help talk","14":"Category","15":"Category talk","100":"Draft","101":"Draft talk","110":"Archive","111":"Archive talk","120":"Book En","121":"Book En talk"},"wgNamespaceIds":{"media":-2,"special":-1,"":0,"talk":1,"user":2,"user_talk":3,"dolibarr_wiki":4,"dolibarr_wiki_talk":5,"file":6,"file_talk":7,"mediawiki":8,"mediawiki_talk":9,"template":10,"template_talk":11,"help":12,"help_talk":13,"category":14,"category_talk":15,"draft":100,"draft_talk":101,"archive":110,
"archive_talk":111,"book_en":120,"book_en_talk":121,"image":6,"image_talk":7},"wgSiteName":"Dolibarr Wiki","wgFileExtensions":["avi","xvid","mp3","png","jpg","jpeg","svg","odf","ods","odt","odg","odp","sxc","pdf","nse","xpi","zip","tgz","gz","deb","rpm","aps"],"wgDBname":"dolibarrwiki","wgExtensionAssetsPath":"/extensions","wgResourceLoaderMaxQueryLength":-1});};if(isCompatible()){document.write("\x3cscript src=\"/load.php?debug=false\x26amp;lang=en\x26amp;modules=jquery%7Cmediawiki\x26amp;only=scripts\x26amp;skin=dolibarr\x26amp;version=20110608T121000Z\"\x3e\x3c/script\x3e");}delete isCompatible;;