<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('website_scrapper_google'); ?></h2>
	</div>
	<div class="page-content">
		<section id="main-content">
			<section class="wrapper">

			<div class="row">
				<div class="col-sm-12">
					<section class="card mb-3">
						<header class="card-header">
							<?php echo lang('website_scrapper_google'); ?>
						</header>
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<div id="results">
										<div class="alert alert-success alert-block" v-show="success"><h4><i class="icon-ok-sign"></i><?php echo lang('your_website'); ?><span class="message-website"></span><?php echo lang('is_index'); ?></h4></div>
										<div class="alert alert-danger alert-block" v-show="success"><h4><i class="icon-ok-sign"></i><?php echo lang('websites_no_index_keyword'); ?></h4></div>
									</div>
									<form class="form-horizontal" id="form-website-scrapper-google" @submit.prevent="WebsiteSearchGoogle">
										<div class="form-group">
											<v-autocomplete
                                                v-model="searchGoogle.url_website"
                                                :items="list_website"
                                                label="Select"
                                                item-text="url_website"
                                                item-value="url_website">
                                            </v-autocomplete>
										</div>
										<div class="form-group">
											<div class="col-lg-2">
												<button type="submit" class="btn btn-danger" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ..."><?php echo lang('search'); ?></button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-4"></div>
								<div class="col-md-4">
								  <button class="btn btn-success btn-ls float-right" data-title="Ajouter" data-toggle="modal" data-target="#serptools">Simulateur de SERP</button>
								</div>
							</div>
							<div class="space15"></div>
							<table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" id="table-website-scrapper-google">
							  <thead>
								<th class="all"><?php echo lang('website'); ?></th>
								<th class="desktop"><?php echo lang('meta_title'); ?></th>
								<th class="desktop"><?php echo lang('meta_description'); ?></th>
							  </thead>
							</table>
						<template>
								<v-data-table
                                    :headers="headers"
                                    :items="list_website_search_google"
                                    class="elevation-1"
                                    :rows-per-page-items="[-1]"
                                >
                                    <template slot="items" slot-scope="props">
                                        <td class="text-xs-left" v-html="props.item.website">{{ props.item.website }}</td>
                                        <td class="text-xs-left">{{ props.item.meta_title }}</td>
                                        <td class="text-xs-left"  v-html="props.item.meta_description">{{ props.item.meta_description }}</td>
                                    </template>
                                </v-data-table>
                            </template>
						</div>
					</section>
				</div>
			</div>
			</section>
		</section>
	</div>
  </div>
</div>
<div class="modal fade" id="serptools" tabindex="-1" role="dialog" aria-labelledby="serptools" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header modal-header-success">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
		<h4 class="modal-title custom_align" id="Heading">Simulateur de SERP</h4>
	  </div>
	  <div class="modal-body">
		<form id="form-serptools">
		  <div class="form-group">
		   <span id="titlechar">70</span> Nombre de caractères <span id="titlepixels">0</span> / <span id="statuschars">500</span> Nombre de pixels
			<input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Titre">
		  </div>
		  <div class="form-group">
			<input class="form-control" type="text" name="meta_url" id="meta_url" placeholder="Url">
		  </div>
		  <div class="form-group">
			<span id="snippetchar">156</span> Nombre de caractères <span id="snippetpixels">0</span> / <span id="statuspixels">930</span> Nombre de pixels
			<textarea class="form-control" type="text" name="meta_description" id="meta_description" placeholder="Description"></textarea>
		  </div>
		</form>

		<div class="thumbnail g">
			<h3 class="r"><a href="http://www.seomofo.com/snippet-optimizer.html#" onclick="return false;" class="l"><span id="out_title">This is an Example of a Title Tag that is Seventy Characters in Length</span></a></h3>
			<div class="s">
				<div class="f kv">
					<cite><span id="out_url">www.website.com</span><span id="out_dash1" style="display: inline;"></span></cite>
				</div>
				<div class="f kv">
					<span id="out_datesnip"><span class="mofo_date"><span id="out_date" style="display: none;"></span><span id="out_datedots" style="display: none; color: rgb(102, 102, 102);">&nbsp;-&nbsp;</span></span><span class="mofo_snippet"><span id="out_snippet">Here is an example of what a snippet looks like in Google's SERPs. The content that appears here is usually taken from the Meta Description tag if relevant.</span></span></span>
					<span class="gl"><span id="out_cached" style="display: inline;"></span><span id="out_dash2" style="display: inline;"></span><span id="out_similar" style="display: inline;"></span></span>
				</div>
			</div>
		</div>
	  </div>

	</div>
  </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
    el: '#app',
    data : {
        message:{
            success:'',
            error:'',
        },
        searchGoogle:{
            url_website:'',
        },
        currentRoute: window.location.href,
        headers: [
            { text: '<?php echo lang("website"); ?>', value: 'website' },
            { text: '<?php echo lang("meta_title"); ?>', value: 'meta_title'},
            { text: '<?php echo lang("meta_description"); ?>', value: 'meta_description'},
        ],
        list_website_search_google: [],
        list_website:  <?php echo json_encode($all_websites->result_array()); ?>,
    },
    created(){
        this.displayPage();
    },
    methods:{
        displayPage(){

        },
        WebsiteSearchGoogle(){
            var formData = new FormData(); 
            formData.append("website",this.searchGoogle.url_website);
            axios.post(this.currentRoute+"/ajaxWebsiteScrapperGoogle/", formData).then(function(response){
                if(response.data.result_websites !== undefined){
                    v.list_website_search_google = response.data.result_websites;
                    v.message.success = true;
                }
            })
        },
    }
})


$( document ).ready(function() {


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
</script>
<?php $this->load->view('include/footer.php'); ?>