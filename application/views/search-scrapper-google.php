<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('search_scrapper_google'); ?></h2>
    </div>
    <div class="page-content">
        <section id="main-content">
            <section class="wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <section class="card mb-3">
                        <header class="card-header">
                            <?php echo lang('search_scrapper_google'); ?>
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                        </header>
                        <div class="card-body">
                            <div class="adv-table editable-table ">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="results">
                                            <div class="alert alert-success alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('your_website'); ?><span class="message-website"></span> est indexer sur ce mot clé "<span class="message-keyword"></span>" à la position</h4></div>
                                            <div class="alert alert-danger alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('websites_no_index_keyword'); ?></h4></div>
                                        </div>
                                        <form class="form-horizontal" id="form-search-scrapper-google" role="form"  action="<?php echo site_url('/search-scrapper-google/ajaxSearchScrapperGoogle/'); ?>">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="keyword-google" id="keyword-google">
                                                <label for="keyword">Keyword</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="website" id="autocomplete">
                                                <label for="urlWebsite">Url Website</label>
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
                                      <button class="btn btn-success btn-ls float-right" data-title="Ajouter" data-toggle="modal" data-target="#serptools"><?php echo lang('serp_simulator'); ?></button>
                                    </div>
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" id="table-search-scrapper-google">
                                  <thead>
                                    <th class="all"><?php echo lang('position'); ?></th>
                                    <th class="desktop"><?php echo lang('website'); ?></th>
                                    <th class="desktop"><?php echo lang('meta_title'); ?></th>
                                    <th class="desktop"><?php echo lang('meta_description'); ?></th>
                                  </thead>
                                </table>
                            </div>
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
        <form id="form-serptools" method="post" action="<?php echo site_url('/dashboard/add'); ?>">
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
<?php $this->load->view('include/footer.php'); ?>
<script>
var autocomplete_website = JSON.parse('<?php echo json_encode($website); ?>');

$('#autocomplete').autocomplete({
    lookup: autocomplete_website,
    onSelect: function (suggestion) {
    }
});
</script>