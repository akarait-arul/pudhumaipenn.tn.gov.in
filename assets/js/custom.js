$(document).ready(function () {
    $(".table-sortable-customise").tablesorter({
        cssAsc    : '', // tablesorter-headerAsc
        cssDesc   : '', // tablesorter-headerDesc
        cssHeader : '', // tablesorter-header
        cssNone   : '',  // tablesorter-headerUnSorted
        cssInfoBlock: "avoid-sort"
    });
       
    
    $("#dboard-district-table").on('sortEnd', function(e) {        
        $('#dboard-district-table >tbody >tr').each(function(index) {
            $(this).find('td:nth-child(1)').html(index+1);
        });
    });
    
    $("#dboard-institution-table").on('sortEnd', function(e) {        
        $('#dboard-institution-table >tbody >tr').each(function(index) {
            $(this).find('td:nth-child(1)').html(index+1);
        });
    });
   
    $("#districtwise-institution-detail-table").on('sortEnd', function(e) {        
        $('#districtwise-institution-detail-table >tbody >tr').each(function(index) {
            $(this).find('td:nth-child(1)').html(index+1);
        });
    });
    
    $("#institution-typewise-detail-table").on('sortEnd', function(e) {        
        $('#institution-typewise-detail-table >tbody >tr').each(function(index) {
            $(this).find('td:nth-child(1)').html(index+1);
        });
    });
   
});