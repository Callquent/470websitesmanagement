<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-content">

        <section id="main-content">
            <section class="wrapper">

                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <header class="card-header">
                                Editable Table
                                <span class="tools pull-right">
                                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    <a href="javascript:;" class="fa fa-cog"></a>
                                    <a href="javascript:;" class="fa fa-times"></a>
                                 </span>
                            </header>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" id="member-finder" class="form-control" placeholder="Search a member...">
                                    </div>
                                </div>
                                <div class="row">

                                <?php foreach($list_users->result() as $row){ ?>
                                    <div class="col-md-4 member-entry member-entry-<?php echo $row->id; ?>">
                                        <section class="card mb-3">

                                            <div class="list-item" data-id="item-3">
                                                <span class="w-40 avatar circle green"><?php echo substr($row->name_user, 0, 2); ?></span>
                                                <div class="list-body">
                                                    <a href="app.user.detail.html#item-3" class="item-title _500"><?php echo $row->name_user; ?></a>
                                                    <div class="item-except text-sm text-muted h-1x"><?php echo $row->email; ?></div>
                                                    <div class="item-tag tag hide"><?php echo $row->name_group; ?></div>
                                                </div>
                                                <div>
                                                    <div class="item-action dropdown">
                                                        <a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-fw fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right text-color" role="menu">
                                                            <a href="#members-edit" data-toggle="modal" data-id="<?php echo $row->id; ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Modifier </a>
                                                            <a class="dropdown-item"><i class="fa fa-reply"></i> Supprimer</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if($row->name_group=="Admin"){ ?>
                                                <div class="twt-feed red-bg">
                                            <?php } elseif($row->name_group=="Developper"){ ?>
                                                <div class="twt-feed blue-bg">
                                            <?php } elseif($row->name_group=="Marketing") { ?>
                                                <div class="twt-feed gray-bg">
                                            <?php } elseif($row->name_group=="Public") { ?>
                                                <div class="twt-feed green-bg">
                                           <?php } elseif($row->name_group=="Unknown") { ?>
                                                <div class="twt-feed white-bg">
                                            <?php } ?>
                                                <div class="fa fa-user wtt-mark"></div>
                                                <a>
                                                    <img alt="" src="<?php echo img_url('users/Sauron_eye_barad_dur.jpg'); ?>">
                                                </a>
                                                <h1><?php echo $row->name_user; ?></h1>
                                                <h2><?php echo $row->name_group; ?></h2>
                                                <a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a>
                                            </div>
                                            <div class="weather-category twt-category">
                                                <!-- <ul>
                                                    <li class="active">
                                                        <h5>750</h5>
                                                        Tweets
                                                    </li>
                                                    <li>
                                                        <h5>865</h5>
                                                        Following
                                                    </li>
                                                    <li>
                                                        <h5>3645</h5>
                                                        Followers
                                                    </li>
                                                </ul> -->
                                            </div>
                                            <div class="twt-write col-sm-12">
                                                <a href="#members-edit" data-toggle="modal" data-id="<?php echo $row->id; ?>" class="btn btn-primary" id="edit-user">Modifier</a>
                                                <a href="<?php echo site_url('members/delete/'.$row->id); ?>" class="btn btn-danger" id="delete-user">Supprimer</a>
                                            </div>
                                            <footer class="twt-footer">
                                                <i class="fa fa-calendar"></i>
                                                <?php echo $row->last_login; ?>
                                            </footer>
                                        </section>
                                    </div>
                                <?php } ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
  </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="members-edit" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Form Members</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="form-edit-user" role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Group</label>
                        <select name="members" class="form-control">
                        <?php foreach ($list_groups->result() as $row){  ?>
                            <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
        $('a#delete-user').click(function(e) {
            if (confirm('Voulez vous supprimer cette enregistrement')) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    success: function(msg){
                        $('.member-entry-'+$(this).attr('url').split("/").pop()).remove();
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            }
            e.preventDefault();
        });
        $('#members-edit').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('id');
            var idgroup;
            $.getJSON( window.location.href+'/userGroup/'+id, function( data ) {
                idgroup = data;
                var modal = $(this);
                $('#form-edit-user').attr('action', window.location.href+'/edit/'+id+'/'+idgroup)
                $('#members-edit select[name="members"] option').each(function() {
                    if ($(this).val() == idgroup) {
                        $(this).prop('selected', true);
                    }
                });         
            });
        }); 
        $('#form-edit-user').submit(function(e) {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(msg){
                    /*event.relatedTarget.dataset.idgroup = msg;*/
                    /*$(event.relatedTarget).data('idgroup', msg);*/
                    /*$(event.relatedTarget).attr('data-idgroup',msg);*/
                    $('#members-edit').modal('hide');
                    switch (msg) {
                        case "1":
                            $('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])).removeClass($('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])+' .twt-feed').attr('class').split(' ')[1]).addClass("red-bg");
                            break;
                        case "2":
                            $('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])).removeClass($('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])+' .twt-feed').attr('class').split(' ')[1]).addClass("green-bg");
                            break;
                        case "3":
                            $('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])).removeClass($('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])+' .twt-feed').attr('class').split(' ')[1]).addClass("white-bg");
                            break;
                        case "4":
                            $('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])).removeClass($('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])+' .twt-feed').attr('class').split(' ')[1]).addClass("blue-bg");
                            break;
                        case "5":
                            $('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])).removeClass($('.member-entry-'+($(this)[0].url.split('/')[window.location.href.split('/').length+1])+' .twt-feed').attr('class').split(' ')[1]).addClass("gray-bg");
                            break;
                    }
                },
                error: function(msg){
                    console.log(msg);
                }
            });
            e.preventDefault();
        });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>