/**
 * @module Eventi
 * @summary module
 */

/*globals window, document */

(function ($) {
  "use strict";

 
  initEventi();
  
  function initEventi() {
    
    clickToLoad();
    initCalendar();
    // scrollToLoad();
  }
  function initCalendar() {
    
    var calendarOuter = $('#calendar-outer').outerHeight();
    var calendarHeader = $('#calendar-header').outerHeight();
    var height = (calendarOuter - calendarHeader) + 30;

    $('head').append('<style>.week-name-title:not(.foot) li:after{height: ' + height + 'px!important;}</style>');
    
    setTimeout(() => {
      $('#calendar-outer').addClass('loading-out');
    }, 100);

    setTimeout(() => {
      $('#calendar-outer').removeClass('loading-out');
      $('#calendar-outer').removeClass('loading');  
    }, 500); 
    
  }
  function clickToLoad() {
    
    $("#loadMore").on("click", function (e) {
      //Init
      e.preventDefault();

      var that = $(this);
      $(this).button("loading");

      var page = $(this).data("page");
      var action = $(this).data("action");
      var newPage = page + 1;
      var ajaxurl = that.data("url");

      //Chiamata AJAX
      $.ajax({
        url: ajaxurl,
        type: "post",
        data: {
          page: page,
          action: action,
        },
        error: function (response) {
          console.log(response);
        },
        success: function (response) {
          //Controllo
          if (response == 0) {
            $("#ajax-content").append(
              '<div id="no-more" class="text-center col-12"><h3>Hai raggiunto il limite!</h3><p>Non ci sono più eventi da visualizzare.</p></div>'
            );
            $("#loadMore").hide();
          } else {
            that.data("page", newPage);
            $("#ajax-content").append(response);
            $(".separatore").removeDuplicates();
            that.button("reset");

          }
        },
      });
    });
  }

  $(document).on("click", ".prev", function (event) {
    event.preventDefault();
    var month = $(this).data("prev-month");
    var year  = $(this).data("prev-year");
    console.log([year,month]);
    getCalendar(month, year);
  });

  $(document).on("click", ".next", function (event) {
    event.preventDefault();
    var month = $(this).data("next-month");
    var year  = $(this).data("next-year");
    console.log([month, year]);
    getCalendar(month, year);
  });

  $(document).on("change", "#start", function (event) {
    event.preventDefault();
    var start = document.getElementById('start');
    var value = event.target.value;
    console.log(value);
    var res = value.split(" ");
    getCalendar(res[0], res[1]);

  });

  $(document).on("change", "#year", function (event) {
    event.preventDefault();
    var year = event.target.value;
    var month = document.getElementById('month');
    console.log([year,month]);
    getCalendar(month.value, year);
  });

  $(document).on("change", "#month", function (event) {
    event.preventDefault();
    var year = document.getElementById('year');
    var month = event.target.value;
    
    console.log([month,year.value]);

    getCalendar(month, year.value);
    
  });

  $(document).on("click", "#today", function (event) {
    event.preventDefault();
    var date = new Date();
    
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    
    if (month < 10) { 
      month = "0" + month;
    }
    console.log([year,month]);
    getCalendar(month, year);
    
  });

  


  $(document).on("blur", "#currentYear", function (event) {
    var month = $("#currentMonth").text();
    var year = $("#currentYear").text();
    console.log([year,month]);
    getCalendar(month, year);
  });

  

  function getCalendar(month, year) {
    
    $.ajax({
      url: ajaxurl,
      type: "post",
      data: {
        action: 'get_ajax_calendar',
        month: month,
        year: year
      },

      beforeSend: function(){
        
        // Handle the beforeSend event
        $('#calendar-outer').addClass('loading');
      },

      success: function (response) {
        
        
        $("#calendar-outer").replaceWith(response);
        
        initCalendar();

        setTimeout(() => {
          $('#calendar-outer').addClass('loading-out');
        }, 100);
        
        
      },
      error: function () {

      },

      complete: function () {
        
        setTimeout(() => {
          $('#calendar-outer').removeClass('loading-out');
          $('#calendar-outer').removeClass('loading');  
        }, 500);  

      }
    });

  }

  
})(jQuery); // Fully reference jQuery after this point.
