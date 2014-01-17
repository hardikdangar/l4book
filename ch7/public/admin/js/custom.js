/***
 *  Default datepicker format
 */
$(document).ready(function(){
    
    $(".datepicker").datepicker(
    {
        dateFormat: 'dd/mm/yy'
    });

    /*$(".datepicker_with_year").datepicker(
    {
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1960:2012",
        onChangeMonthYear: function(year, month, inst) {
            var date=$(this).val();
            if(date!=""){
                var n=date.split("/");  
                var str_m=month;
                str_m=str_m.toString();
                cnt_m=str_m.length;
                if(cnt_m=='1'){
                    str_m="0"+str_m;
                }
                $(this).val(n[0]+'/'+str_m+'/'+year);
            }

        }
    });*/
    
    $(document).on('focus', '.auto-datepicker', function () {
        $(this).datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1960:2012",
            onChangeMonthYear: function(year, month, inst) {
                var date=$(this).val();
                if(date!=""){
                    var n=date.split("/");  
                    var str_m=month;
                    str_m=str_m.toString();
                    cnt_m=str_m.length;
                    if(cnt_m=='1'){
                        str_m="0"+str_m;
                    }
                    $(this).val(n[0]+'/'+str_m+'/'+year);
                }

            }
        }).datepicker( "show" );

    });

    // Default print button
    $('.btn-print').click(function() {

        /*  var w = window.open();
            var html = $("html").html();
        */
        /* $.getScript(SITE_URL+"theme/admin/js/print.js", function(data) {
            $("head").append("<script>"+data+"</script>");
        });
        */
        
        // w.print();
         window.print();
        return false;
    });


    // listing search
    $("#listing-search-form").submit(function(){
        
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data:$(this).serialize(),
            success: function(html){
                $(".content-container").html(html);
            }
        });
        return false;
    });

    /** 
     * Pagination Ajax handler
     */
    $(".pagination a").live("click",function(){
        var pageHref = $(this).attr("href");            
        $.ajax({
            type: "POST",
            url: pageHref,
            data:$("#listing-search-form").serialize(),
            success: function(html){
                $(".content-container").html(html);
            }
        });
        return false;
    });
    
    $("#pagination-dropdown-cn select").val($(".pagination li.active a").html());
    
    $("body").on("change","#pagination-dropdown-cn select",function(){
        
        page = $(this).val();
        var pageHref = $("#pagination-url").val() + page;
        $.ajax({
            type: "POST",
            url: pageHref,
            data:$("#listing-search-form").serialize(),
            success: function(html){
                $(".content-container").html(html);
            }
        });
    });

    var sigle_delete_href='';

    $(".confirm_delete_action").live("click",function(){
        sigle_delete_href  = $(this).attr("href");
        $("#confirm_delete_modal").modal('show');
        return false;
    });

    $("#delete_actionbtn_yes").live("click",function(){
        window.location = sigle_delete_href;
        $("#confirm_delete_modal").modal('hide');
    });

    /* for confirming that YOu want send Record to OUt Ward*/
    $(".confirm_outward_action").live("click",function(){
        sigle_delete_href = $(this).attr("href");
        $("#confirm_outward_modal").modal('show');
        return false;
    });

    $("#outward_actionbtn_yes").live("click",function(){
        window.location = sigle_delete_href;
        $("#confirm_outward_modal").modal('hide');
    });


    function show_loading()
    {
        $("#loading").fadeIn("slow");
    }

    function hide_loading()
    {
        $("#loading").fadeOut("slow");
    }
    
    $("#loading").ajaxStart(function(){
        show_loading();
    });
    $("#loading").ajaxStop(function(){
        hide_loading(); 
    });

  
    function confirm(heading, question, cancelButtonTxt, okButtonTxt, callback) {

        var confirmModal = 
        $('<div class="modal hide fade">' +    
            '<div class="modal-header">' +
            '<a class="close" data-dismiss="modal" >&times;</a>' +
            '<h3>' + heading +'</h3>' +
            '</div>' +

            '<div class="modal-body">' +
            '<p>' + question + '</p>' +
            '</div>' +

            '<div class="modal-footer">' +
            '<a href="#" class="btn btn-large" data-dismiss="modal">' + 
            cancelButtonTxt + 
            '</a>' +
            '<a href="#" id="okButton" class="btn btn-large btn-primary">' + 
            okButtonTxt + 
            '</a>' +
            '</div>' +
            '</div>');

        confirmModal.find('#okButton').click(function(event) {
            callback();
            confirmModal.modal('hide');
        });

        confirmModal.modal('show');     
    };
  
    $(".generalModel").live("click", function(event) {
        // get txn id from current table row
        //var id = $(this).data('id');
        var url = $(this).attr('href');
        var heading = 'Transaction '+$(this).html();
        var question = 'Please confirm that you wish to '+$(this).html()+' this record';
        var cancelButtonTxt = 'Close';
        var okButtonTxt = 'Yes';

        var callback = function() {
            //alert('delete confirmed ' + id);
            window.location = url;	
        };

        confirm(heading, question, cancelButtonTxt, okButtonTxt, callback);
        return false;
    });
   
});

$(window).load(function(){
    jQuery('.submenu').hover(function () {
        jQuery(this).children('ul').removeClass('submenu-hide').addClass('submenu-show');
    }, function () {
        jQuery(this).children('ul').removeClass('.submenu-show').addClass('submenu-hide');
    }).find("a:first");
});  