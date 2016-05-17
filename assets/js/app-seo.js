$( document ).ready(function() {
/*	var init = 0;
	do {
		if (!isNaN(window.location.href.split("/").pop())) {
			var urlorigin = window.location.href.split("/");
			urlorigin.pop();
			var url = urlorigin.join("/")+'/metawebsite/'+window.location.href.split("/").pop()+'/'+init;
		} else{
			var url = window.location.href+'/metawebsite/'+init;
		};
		$.ajax({
			type: "POST",
			url: url,
			success: function(msg){
				var jsdata = JSON.parse(msg);
				var newRow = $('#table-seo').dataTable().fnAddData(jsdata);

				var oSettings = $('#table-seo').dataTable().fnSettings();
				var nTr = oSettings.aoData[ newRow[0] ].nTr;
				console.log(titleFunction($('td', nTr)[2].innerHTML));

				if (titleFunction($('td', nTr)[2].innerHTML)) {
					$('td', nTr)[2].setAttribute( 'class', 'success' );
				}else{
					$('td', nTr)[2].setAttribute( 'class', 'danger' );
				}
				if (descriptionFunction($('td', nTr)[3].innerHTML)) {
					$('td', nTr)[3].setAttribute( 'class', 'success' );
				}else{
					$('td', nTr)[3].setAttribute( 'class', 'danger' );
				}
			},
			error: function(msg){
				console.log(msg);
			}
		});
		init++;
	} while (init < end);*/

var seoTable = $('#table-seo').DataTable({
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.

    "ajax": {
        "url":  window.location.href+'/metawebsite/',
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [ -1 ], //last column
        "orderable": false, //set not orderable
    },
    ],
});
/************************/
/*		META SEO		*/
/************************/
	var ellipsis = " ...";
	var displayedchartitle = 0;
	var displayedchardescription = 0;
	var titlePixelLenght = 500;
	var descriptionPixelLenght = 930;
		
	function get(e){return document.getElementById(e);}
	function val(e){return document.getElementById(e).value;}
	/*function html(e){return document.getElementById(e).innerHTML;}*/
	function css(e){return document.getElementById(e).style;}

	$("#meta_title").keyup(function() {
		MetaTitleFunction();
	});
	$("#meta_description").keyup(function() {
		MetaDescriptionFunction();
	});
	$("#meta_url").keyup(function() {
		MetaUrlFunction();
	});

	function adjustTitleLength(text){ 
		var size = calculateSize(text, {font: 'Arial', fontSize: '18px'});
		var width1 = size.width;

		while (width1 > 500) {
			
			var snipLimit1 = width1-5;
			snippetSpace = text.lastIndexOf(" ",snipLimit1);
			text = text.substring(0,snippetSpace);

			  	size = calculateSize(text, {font: 'Arial',fontSize: '18px'});
			  	width1 = size.width;  	  		

		}
		var snipLimit = width1-15;
		snippetSpace = text.lastIndexOf("",snipLimit);
		var newTitle = text.substring(0,snippetSpace).concat(ellipsis);
		return newTitle;
	}

	function adjustSnippetLength(text){ 
		var size = calculateSize(text, {
				font: 'Arial',
				fontSize: '13px'
		});
		var width1 = size.width;
		while (width1 > 930) {
			var snipLimit1 = width1-5;
			snippetSpace = text.lastIndexOf(" ",snipLimit1);
			text = text.substring(0,snippetSpace);
		  	size = calculateSize(text, {font: 'Arial',fontSize: '13px'});
		  	width1 = size.width;
		}
		var snipLimit = width1-15;
		snippetSpace = text.lastIndexOf("",snipLimit);
		var newDescription = text.substring(0,snippetSpace).concat(ellipsis);

		return newDescription;
	}

	function MetaTitleFunction(){
		theTitle = val('meta_title').replace(/^\s+|\s+$/g,"");
		get('titlechar').innerHTML = theTitle.length;
		var size = calculateSize(theTitle, {
				font: 'Arial',
				fontSize: '18px'
			});
		var width = size.width;

		get('titlepixels').innerHTML = width;
		var titlePixelLenghtRemaining = titlePixelLenght - width;
		if (titlePixelLenghtRemaining >= 0) { 
			if (width < 250 ) {
				document.getElementById('statuschars').className = 'statuschars_SHORT';
				get('titlepixels').innerHTML = "<span style='color:red'>"+width+"</span>";
			} else {
				document.getElementById('statuschars').className = 'statuschars_OK';
				get('titlepixels').innerHTML = "<span style='color:green'>"+width+"</span>";
			}			
			displayedchartitle = theTitle.length;
		} else { 
			get('titlepixels').innerHTML = "<span style='color:red'>"+width+"</span>";
			document.getElementById('statuschars').className = 'statuschars_LONG';
		}		
		if(width <= titlePixelLenght){
			get('out_title').innerHTML = theTitle;
		} else {
			get('out_title').innerHTML = adjustTitleLength(theTitle);
		}
	}
	function MetaDescriptionFunction(){
		theSnippet = val('meta_description').replace(/^\s+|\s+$/g,"");
		var snippetLength = theSnippet.length;
		get('snippetchar').innerHTML = snippetLength;
		var size = calculateSize(theSnippet, {
			font: 'Arial',
			fontSize: '13px'
		});
		var width = size.width;
		get('snippetpixels').innerHTML = width;	
		var snippetPixelLenghtRemaining = descriptionPixelLenght - width;
		if (snippetPixelLenghtRemaining >= 0) { 
			if (width < 500 ) {
				document.getElementById('statuspixels').className = 'statuspixels_SHORT';
				get('snippetpixels').innerHTML = "<span style='color:red'>"+width+"</span>";
			} else {
				document.getElementById('statuspixels').className = 'statuspixels_OK';
				get('snippetpixels').innerHTML = "<span style='color:green'>"+width+"</span>";
			}		
			displayedchardescription = snippetLength;
		} else { 
			var truncadedchar = snippetLength - displayedchardescription;
			get('snippetpixels').innerHTML = "<span style='color:red'>"+width+"</span>";
			document.getElementById('statuspixels').className = 'statuspixels_LONG';
		}
		if(width <= descriptionPixelLenght){
			get('out_snippet').innerHTML = theSnippet;
			return true;
		} else {
			get('out_snippet').innerHTML = adjustSnippetLength(theSnippet);
			return false;
		}
	}
	function MetaUrlFunction(){
		var theURL = val('meta_url');
		theURL = theURL.replace('http://','');
		theURL = theURL.replace(/^\s+|\s+$/g,"");
		get('out_url').innerHTML = theURL;
	}


	(function(name, definition) {
		if (typeof define === 'function') { // AMD
			define(definition);
		} else if (typeof module !== 'undefined' && module.exports) { // Node.js
			module.exports = definition();
		} else { // Browser
			var theModule = definition(),
			global = this,
			old = global[name];
			theModule.noConflict = function() {
				global[name] = old;
				return theModule;
			};
			global[name] = theModule;
		}
	})('calculateSize', function() {
		function createDummyElement(text, options) {
			var element = document.createElement('div'),
			textNode = document.createTextNode(text);
			element.appendChild(textNode);
			element.style.fontFamily = options.font;
			element.style.fontSize = options.fontSize;
			element.style.fontWeight = options.fontWeight;
			element.style.position = 'absolute';
			element.style.visibility = 'hidden';
			element.style.left = '-999px';
			element.style.top = '-999px';
			element.style.width = 'auto';
			element.style.height = 'auto';
			document.body.appendChild(element);
			return element;
		}
		function destoryElement(element) {
			element.parentNode.removeChild(element);
		}
		return function(text, options) {
			// prepare options
			options = options || {};
			options.font = options.font || 'Arial';
			options.fontSize = options.fontSize || '16px';
			options.fontWeight = options.fontWeight || 'normal';
			var size = {}, element;
			element = createDummyElement(text, options);
			size.width = element.offsetWidth;
			size.height = element.offsetHeight;
			destoryElement(element);
			return size;
		};
	});


	function titleFunction(val){
		var titlePixelLenght = 500;

		theTitle = val;
		var size = calculateSize(theTitle, {
			font: 'Arial',
			fontSize: '18px'
		});
		var width = size.width;			
		var titlePixelLenghtRemaining = titlePixelLenght - width;

		if (titlePixelLenghtRemaining >= 0) { 
			if (width < 250 ) {
				return false;
			} else {
				return true;
			}
		} else { 		
			return false;
		}
	}
	function descriptionFunction(val){
		var descriptionPixelLenght = 930;

	    theSnippet = val;
		/*console.log(theSnippet.val(theSnippet.val.replace("'", "&#34;")));*/
	    var snippetLength = theSnippet.length;
	 	var size = calculateSize(theSnippet, {
			font: 'Arial',
			fontSize: '13px'
		});
		var width = size.width;
		var snippetPixelLenghtRemaining = descriptionPixelLenght - width;
		if (snippetPixelLenghtRemaining >= 0) { 
				if (width < 500 ) {
					return false;
				} else {
					return true;
				}
				displayedchardescription = snippetLength;
		} else { 
			return false;
		}
	}



});