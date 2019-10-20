$(document).ready(function() {
    alert('Hello');
    // initial page load
    $('#content').load('index_searchbook.php');
    
    // handle menu click
    $('#navbarTogglerDemo03 ul li a').click(function(){
        alert('OK');
        //var page = $(this).attr('href');
        //$('#content').load( page +'.php');
        //return false;
    }); 
});