<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
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
                        </header>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="results">
                                        <div class="alert alert-success alert-block" v-show="message.success"><h4><i class="icon-ok-sign"></i><?php echo lang('your_website'); ?><span class="message-website"></span> est indexer sur ce mot clé "<span class="message-keyword" v-for="(position, index) in positions">{{ position }}<span v-if="index != (positions.length - 1)">, </span></span>" à la position</h4></div>
                                        <div class="alert alert-danger alert-block" v-show="message.error"><h4><i class="icon-ok-sign"></i><?php echo lang('websites_no_index_keyword'); ?></h4></div>
                                    </div>
                                    <form @submit.prevent="SerpSearchGoogle" class="form-horizontal" id="form-search-scrapper-google">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="keyword-google" id="keyword-google" v-model="searchGoogle.keyword">
                                            <label for="keyword">Keyword</label>
                                        </div>
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
                                            <button type="submit" class="btn btn-danger" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ..."><?php echo lang('search'); ?></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                  <button class="btn btn-success btn-ls float-right" data-title="Ajouter" data-toggle="modal" data-target="#serptools"><?php echo lang('serp_simulator'); ?></button>
                                </div>
                            </div>
                            <template>
                                    <v-data-table
                                        :headers="headers"
                                        :items="list_serp_search_google"
                                        class="elevation-1"
                                        :rows-per-page-items="[-1]"
                                    >
                                        <template slot="items" slot-scope="props">
                                            <tr :class="props.item.className">
                                                <td>{{ props.item.position }}</td>
                                                <td class="text-xs-left" v-html="props.item.website">{{ props.item.website }}</td>
                                                <td class="text-xs-left">{{ props.item.meta_title }}</td>
                                                <td class="text-xs-left"  v-html="props.item.meta_description">{{ props.item.meta_description }}</td>
                                            </tr>
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
        position:'',
        positions:[],
        searchGoogle:{
            keyword:'',
            url_website:'',
        },
        currentRoute: window.location.href,
        headers: [
            { text: '<?php echo lang("position"); ?>', value: 'position'},
            { text: '<?php echo lang("website"); ?>', value: 'website' },
            { text: '<?php echo lang("meta_title"); ?>', value: 'meta_title'},
            { text: '<?php echo lang("meta_description"); ?>', value: 'meta_description'},
        ],
        list_serp_search_google: [],
        list_website:  <?php echo json_encode($all_websites->result_array()); ?>,
    },
    created(){
        this.displayPage();
    },
    methods:{
        displayPage(){

        },
        SerpSearchGoogle(){
            var formData = new FormData(); 
            formData.append("keyword_google",this.searchGoogle.keyword);
            formData.append("website",this.searchGoogle.url_website);
            axios.post(this.currentRoute+"/ajaxSearchScrapperGoogle/", formData).then(function(response){
                if(response.data.result_position_website !== undefined){
                    v.list_serp_search_google = response.data.result_websites;
                    v.message.success = true;
                    v.message.error = false;
                    v.positions = response.data.result_position_website;
                }else{
                    v.message.success = false;
                    v.message.error = true;
                }
            })
        },
    }
})
</script>
<?php $this->load->view('include/footer.php'); ?>