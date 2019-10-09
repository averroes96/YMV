$(function(){
    
    'use strict';
    
    $.fn.myPagination = function(options)
    {
        var pagination = this ;
        var itemsToPaginate;
        var dflt = {
        
        itemsPerPage : 20
        
    };
        var settings = {};
        
        $.extend(settings, dflt, options);

        itemsToPaginate = $(settings.itemsToPaginate);
        var nbrItems = Math.ceil(itemsToPaginate.length/settings.itemsPerPage);
        
        $("<ul></ul>").prependTo(pagination);
        for(var index = 0 ; index < nbrItems ; index++){
            
            pagination.find("ul").append("<li>" + (index+1) + "</li>")
        }
        
        itemsToPaginate.filter(":gt(" + (settings.itemsPerPage-1) + ")").hide();        
        
        pagination.find("ul li").on("click", function(){
            
            var linkNbr = $(this).text();            
            var itemsToHide = itemsToPaginate.filter(":lt(" + ((linkNbr-1) * settings.itemsPerPage) + ")");
            $.merge(itemsToHide, itemsToPaginate.filter(":gt(" + ((linkNbr * settings.itemsPerPage)-1) + ")"));
            itemsToHide.hide();
            var itemsToShow = itemsToPaginate.not(itemsToHide);
            itemsToShow.show();
            
            
        });
        
    var $rows = $('#result .filtered');
    $('#myInput').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });        
        
    }    

        
    $(".pagination").myPagination({
        
        itemsToPaginate : ".main-table tr"
        
    });
    
    $(".confirm").click(function(){
        
       return confirm("Vous etes sure ?") ;
        
        
    });    
    
    
});