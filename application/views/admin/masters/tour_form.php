<!-- iCheck 1.0.1 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin-template/plugins/select2/select2.min.css">


<script src="<?php echo base_url(); ?>assets/admin-template/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
                <h1>Tour</h1>
                <?php  include(APPPATH.'views/admin/common/menu.php'); ?>
        </section>
        <!-- Main content -->
        <section class="content" >
            <div class="row">
                <div class="col-xs-12">
                    
                    <div class="box ">
                       <!--  <div class="box-header with-border">
                            <h3 class="box-title"> <i class="fa fa-fw fa-plus"></i> Tour</h3>
                        </div> -->

                        <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"> Info</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"> Images</a></li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true"> Days</a></li>
                            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="true"> Tags</a></li>
                        </ul>
                        <form class="form-horizontal" action="<?php echo base_url('admin/tour/form/'.$id);?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="cont_enquiry">
                            <div class="tab-content">
                                
                                <div class="tab-pane active" id="tab_1">
                                    <div class="box-body">

                                        <div class="col-xs-11">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" id="inputEmail3" placeholder="Tour Name" name="name" value="<?php if(!empty($name)) echo $name; ?>">
                                            <?php echo form_error('name','<span class="error">','</span>'); ?>
                                        </div>
                                        <br>

                                        <div class="col-xs-11">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea id="editor1" class="form-control" rows="3" placeholder="Description" name="description"><?php if($description) echo $description; ?></textarea>
                                            <?php echo form_error('description','<span class="error">','</span>'); ?>
                                        </div>
                                        <br>

                                        <div class="col-xs-11">
                                            <label for="exampleInputEmail1">Destination</label>
                                            <select class="form-control" name="destination">
                                                <option value="0"> --Select Destination-- </option> 
                                                <?php foreach ($all_destination as $key => $value) { ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if(!empty($destination) && $destination == $value->id ) { echo "selected"; } ?> ><?php echo $value->name; ?></option> 
                                                <?php } ?>
                                            </select>
                                            <?php //echo form_error('description','<span class="error">','</span>'); ?>
                                        </div>
                                        <br>

                                        <div class="col-xs-11">
                                            <label>
                                                <input type="checkbox" class="flat-red" name="activate" value="1" <?php if($activate==1 ) echo 'checked'; ?>>&nbsp;&nbsp; Active </label>
                                        </div>

                                    </div>
                                    

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="box-body">

                                        <div class="col-xs-11">
                                            <label for="name"> <?php echo "Tour Images";?>  </label>
                                            <div>
                                                <a href="#" onclick="chage_image($(this));" title="" id="uploadFile">
                                                    <?php if(!empty($image)) { ?>
                                                        <img src="<?php echo base_url('uploads/images/full/'.$image); ?>" alt="Add image" width="156" height="128" id="img">
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url('assets/img'); ?>/add-img.jpg" alt="Add image" width="156" height="128" id="img">
                                                    <?php } ?>
                                                </a>
                                                <p class="help-block">&nbsp;&nbsp;&nbsp;Image Size 156 * 128 px</p>
                                                <input type="file" name="image" id="asd" style="display:none;">
                                            </div>
                                        </div>

                                        <!-- <div class="col-xs-11"> -->
                                            <!-- <div class="tab-pane" id="tab_2"> -->
                                                <div class="col-xs-11">
                                                    <label for="name">
                                                        <?php echo "Tour Banner Images";?>
                                                    </label>
                                                    <div class="">
                                                        <iframe id="iframe_uploader" src="<?php echo site_url($this->config->item('admin_folder').'/tour/tour_image_form');?>" class="span8" style="height:75px; border:0px;width:99%;"></iframe>
                                                    </div>
                                                    <div class="">
                                                        <div class="span8">
                                                            <div id="gc_photos">
                                                                <?php
                                                                    foreach($tour_image as $photo_id=>$photo_obj)
                                                                    {
                                                                        if(!empty($photo_obj))
                                                                        {
                                                                            $photo = (array)$photo_obj;
                                                                            add_image($photo_id, $photo['filename'], $photo['alt']);
                                                                        }
                                                                    }
                                                                    ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <br>
                                    <div class="col-xs-11">
                                        <label for="name"> <?php echo "Tour Days : ";?>  </label>
                                        <select name="days" class="form-control" style="width: 14%;" id="day_select">
                                            <option value="0">--SELECT DAYS--</option>
                                            <?php for ($i=1; $i <= 30; $i++) {  ?>
                                                <option <?php if(!empty($days) && $days == $i) { echo "selected"; } ?> ><?php echo $i; ?></option>    
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <br>
                                    <?php $i = 1;
                                    foreach ($day_values as $key => $value) { ?>
                                        <div class="col-xs-11 daysvalues">
                                        <label>Day <?php echo $i;?> </label>
                                        <input type="text" class="form-control valid" id="" placeholder="Tour Day Title" name="day_values[<?php echo $i;?>][name]" value="<?php echo $value->name ?>" aria-required="true" aria-invalid="false"><br>
                                        
                                        <input type="text" class="form-control valid" id="" placeholder="Video Link" name="day_values[<?php echo $i;?>][url]" value="<?php echo $value->url ?>" aria-required="true" aria-invalid="false"><br>

                                        <input type="text" class="form-control valid" id="" placeholder="Hotel Name" name="day_values[<?php echo $i;?>][hotel_name]" value="<?php if(isset($value->hotel_name)) echo $value->hotel_name ?>" aria-required="true" aria-invalid="false"><br>

                                        <input type="text" class="form-control valid" id="" placeholder="Hotel Link" name="day_values[<?php echo $i;?>][hotel_link]" value="<?php if(isset($value->hotel_link)) echo $value->hotel_link ?>" aria-required="true" aria-invalid="false"><br>
                                        
                                        <textarea class="form-control valid" rows="2" placeholder="Description" name="day_values[<?php echo $i;?>][description]" aria-invalid="false"><?php echo $value->description ?></textarea><br>
                                    </div>
                                    <?php $i++; } ?>
                                    
                                    <div id="append_divs"> </div>
                                </div>
                                <div class="tab-pane active" id="tab_4">
                                    <div class="box-body">
                                        <div class="col-xs-11">
                                            <label>Select Tags</label>
                                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Select Tags"
                                            style="width: 100%;">
                                            <?php foreach ($all_tags as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>" <?php if(in_array($value->id,$tags)) { echo "selected";} ?> ><?php echo $value->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                            <div class="box-footer">
                                <?php if(!empty($id)) { ?>
                                <button type="submit" class="btn btn-info"><i class="fa fa-fw fa-plus"></i>&nbsp;Update</button>
                                <?php } else { ?>
                                <button type="submit" class="btn btn-info"><i class="fa fa-fw fa-plus"></i>&nbsp;Save</button>
                                <?php } ?>
                                <a href="<?php echo base_url('admin/tour');?>">
                                    <button type="button" class="btn btn-info btn-danger"><i class="fa fa-fw fa-repeat"></i>&nbsp;Back</button>
                                </a>
                            </div>
                        </div>
                    </form>                    
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.container -->
</div>
<!-- /.content-wrapper -->

<?php function add_image($photo_id, $filename, $alt=false ) { ob_start(); ?>
<div class="row gc_photo" id="gc_photo_<?php echo $photo_id;?>">
    <div class="span2">
        <input type="hidden" id="profileImageFile<?php echo $photo_id;?>" name="tour_image[<?php echo $photo_id;?>][filename]" value="<?php echo $filename;?>" />
        <img class="gc_thumbnail" src="<?php echo base_url('uploads/images/thumbnails/'.$filename);?>" id="profileImage<?php echo $photo_id; ?>" style="float: left;margin-right: 2%;margin-left: 3%;width: 290px;height: 182px;" />
        <img src="<?php echo base_url()?>assets/img/loding-icon.gif" id="hide_show_gif1<?php echo $photo_id; ?>" style=" display:none; margin-left: 5%; width: 150px; height: 110px; " />
        <div id="messageBox<?php echo $photo_id; ?>"></div>
    </div>
    <div class="span6" style="margin-bottom: 3%;">
        <div class="row">
            <!-- <div class="span2">
<a onclick="return remove_image($(this));" rel="<?php echo $photo_id;?>" class="btn btn-danger" style="float:right; font-size:9px;"><i class="icon-trash icon-white"></i> <?php echo lang('remove');?></a>
</div> -->
            <!-- </div> -->
            <div class="row">
                <div class="span2">
                    <input name="tour_image[<?php echo $photo_id;?>][alt]" value="<?php echo $alt;?>" class="span2" placeholder="<?php echo lang('alt_tag');?>" style="width: 50%;" />
                </div>
                </br>
                </br>
                <div class="span2">
                    <a onclick="return remove_image($(this));" rel="<?php echo $photo_id;?>" class="btn btn-danger" style="float:left;"><i class="icon-trash icon-white"></i> <?php echo "Remove";?></a>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
<?php
    $stuff = ob_get_contents();
    ob_end_clean();
    echo replace_newline($stuff);
    }

    function replace_newline($string) {
    return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
} ?>

<script src="<?php echo base_url(); ?>assets/admin-template/plugins/ckeditor/ckeditor.js"></script>  
<script src="<?php echo base_url(); ?>assets/admin-template/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">

function chage_image(id) {
    $('input[type=file]').click();
}

$("#asd").change(function () {
    readImage(this);
});

$("#day_select").change(function () {
    
    let id = '<?php echo $id; ?>';
    let select_val = $(this).val();
    let output_html = '';
    let divCount = 0;
    if(id) {
        divCount = $('.daysvalues').length;
        select_val = (select_val - divCount );
    }
    
    if(select_val > 0) {
        for (var i = 1; i <= select_val; i++) {
            output_html += '<div class="col-xs-11 daysvalues"> <label>Day '+(divCount + i)+'</label><input type="text" class="form-control valid" id="" placeholder="Tour Day Title" name="day_values['+i+'][name]" value="" aria-required="true" aria-invalid="false"><br> <input type="text" class="form-control valid" id="" placeholder="Video Url" name="day_values['+i+'][url]" value="" aria-required="true" aria-invalid="false"><br><input type="text" class="form-control valid" id="" placeholder="Hotel Name" name="day_values['+i+'][hotel_name]" value="" aria-required="true" aria-invalid="false"><br><input type="text" class="form-control valid" id="" placeholder="Hotel Link" name="day_values['+i+'][hotel_link]" value="" aria-required="true" aria-invalid="false"><br> <textarea class="form-control valid" rows="2" placeholder="Description" name="day_values['+i+'][description]" aria-invalid="false"></textarea><br></div>';
        }
        $('#append_divs').html('');
        $('#append_divs').append(output_html);
    } else {

    }
    
});

function readImage(input) {
    if (input.files && input.files[0]) {
        var FR = new FileReader();
        FR.onload = function (e) {
            $('#img').attr("src", e.target.result);
            $('#img').show();
        };
        FR.readAsDataURL(input.files[0]);
    }
}

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
});

$(document).ready(function() {

    CKEDITOR.replace('editor1');
    let obj = $('.select2').select2();

// $('.select2').select2().on("change", function(e) {
//     var obj = $(".select2").select2("data");
//     let tag_vals = [];    
//     for (i = 0; i < obj.length; i++) { 
//         tag_vals.push(obj[i].id);    
//     }
//     $('#tag_vals').val(tag_vals);
// });
    // console.log(obj);


    $(".sortable").sortable();
    $(".sortable > span").disableSelection();

    <?php  if ($id): ?>
    var ct = $('#option_list').children().size();
    option_count = '';
    <?php endif; ?>
    photos_sortable();
});


function add_product_image(data) {
    p = data.split('.');

    var photo = '<?php add_image("' + p[0] + '", "' + p[0] + '.' + p[1] + '", '
    ', '
    ', '
    ', base_url('
    uploads / images / thumbnails '));?>';

    $('#gc_photos').append(photo);
    photos_sortable();
}

function remove_image(img) {

    if (confirm('<?php echo "Are you sure you want to delete this image ?";?>')) {
        var id = img.attr('rel')
        $('#gc_photo_' + id).remove();
    }
}

function photos_sortable() {
    $('#gc_photos').sortable({
        handle: '.gc_thumbnail',
        items: '.gc_photo',
        axis: 'y',
        scroll: true
    });
}

function remove_option(id) {
    if (confirm('<?php echo lang('
            confirm_remove_option ');?>')) {
        $('#option-' + id).remove();
    }
}

jQuery(function() {

    jQuery.validator.addMethod("mobilevalue", function(value, element) {
        return this.optional(element) || value.match(/^[6-9][0-9]{9}$/);
    }, "This Field should contain valid number.");

    jQuery.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    }, "The This field must contain only letters.");


    $("#cont_enquiry").validate({
        rules: {
            name: {
                required: true,
                alpha: true,
                minlength: 3,
                maxlength: 25
            },

            description: {
                minlength: 3,
                maxlength: 300
            }
        },

        messages: {
            name: {
                required: "The Name field is required.",
                minlength: "The Name at least 3 characters.",
                alpha: "The Name must contain only letters.",
                maxlength: "The Name field can not exceed 25 characters in length."
            },

            description: {
                minlength: "The Mobile Number at least 3 characters",
                maxlength: "The Mobile Number field can not exceed 300 characters in length."
            }

        },
        errorElement: "em"

    });

});
</script>
<style>
.col-xs-11 {
    float: none;
}
.error {
    font-size: 0.750em;
    color: #ff0000;
    text-transform: none;
    line-height: 1.2em;
}
</style>