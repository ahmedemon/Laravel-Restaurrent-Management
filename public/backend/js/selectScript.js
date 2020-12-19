$(document).ready(function () {
	getPagination('#tableID');
});

function getPagination(table) {

  $('#selectOption').on('change', function() {
    $('.pagination').html(''); // reset pagination 
    var trnum = 0; // reset tr counter 
    var selectOption = parseInt($(this).val()); // get Max Rows from select option
    var totalRows = $(table + ' tbody tr').length; // numbers of rows 
    $(table + ' tr:gt(0)').each(function() { // each TR in  table and not the header
      trnum++; // Start Counter 
      if (trnum > selectOption) { // if tr number gt selectOption

        $(this).hide(); // fade it out 
      }
      if (trnum <= selectOption) {
        $(this).show();
      } // else fade in Important in case if it ..
    }); //  was fade out to fade it in 
    if (totalRows > selectOption) { // if tr total rows gt max rows option
      var pagenum = Math.ceil(totalRows / selectOption); // ceil total(rows/selectOption) to get ..  
      //	numbers of pages 
      for (var i = 1; i <= pagenum;) { // for each page append pagination li 
        $('.pagination').append('<li class"wp" data-page="' + i + '">\
								      <span>' + i++ + '<span class="sr-only">(current)</span></span>\
								    </li>').show();
      } // end for i 
    } // end if row count > max rows
    $('.pagination li:first-child').addClass('active'); // add active class to the first li 
    $('.pagination li').on('click', function() { // on click each page
      var pageNum = $(this).attr('data-page'); // get it's number
      var trIndex = 0; // reset tr counter
      $('.pagination li').removeClass('active'); // remove active class from all li 
      $(this).addClass('active'); // add active class to the clicked 
      $(table + ' tr:gt(0)').each(function() { // each tr in table not the header
        trIndex++; // tr index counter 
        // if tr index gt selectOption*pageNum or lt selectOption*pageNum-selectOption fade if out
        if (trIndex > (selectOption * pageNum) || trIndex <= ((selectOption * pageNum) - selectOption)) {
          $(this).hide();
        } else {
          $(this).show();
        } //else fade in 
      }); // end of for each tr in table
    }); // end of on click pagination list


  });

  // end of on select change 



  // END OF PAGINATION 
}















// ----------------------------------------------------------------------














  pageSize = 5000;

  var pageCount =  $(".line-content").length / pageSize;
    
     for(var i = 0 ; i<pageCount;i++){
        
       $("#pagin").append('<li><a href="#" class="page-link border border-white text-white bg-primary" style="box-shadow: none;">'+(i+1)+'</a></li> ');
     }
        $("#pagin li").first().find("a").addClass("current")
    showPage = function(page) {
      $(".line-content").hide();
      $(".line-content").each(function(n) {
          if (n >= pageSize * (page - 1) && n < pageSize * page)
              $(this).show();
      });
  }
    
  showPage(1);

  $("#pagin li a").click(function() {
      $("#pagin li a").removeClass("current");
      $(this).addClass("current");
      showPage(parseInt($(this).text())) 
  });










  // ------------------------------------------------------------------------
// tooltip




