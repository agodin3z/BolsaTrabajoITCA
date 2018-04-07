(function($) {
  "use strict";
  $(document).ready(function() {
    var slider_review = $('#testimonio');
    var slider_related = $('#related-job');
    var counter = $('.count .num');
    var tagpicker = $("#tagPicker");
    var asSelect2 = $(".asSelect2");
    var asSelect2Tag = $(".asSelect2Tag");
    var choices = $('.select2-choices');
    var choice = $('.select2-choice');
    var inputfiles = $('.inputfile');
    var header = $("#header");
    var rem_img = $('#removeimg')
    var imgupld = $('.image_upload ');
    var fname = $('.filename');

    slider_review.owlCarousel({
      navigation: false, // Show next and prev buttons
      slideSpeed: 300,
      paginationSpeed: 400,
      singleItem: true,
      loop: true,
      responsive: {
        0: {
          items: 1
        }
      }
    });
    slider_related.owlCarousel({
      loop:false,
      margin:10,
      mav:false,
      responsiveClass:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
      }
    });


    counter.counterUp({delay: 20, time: 2000});

    tagpicker.select2({closeOnSelect: false});
    asSelect2.select2();
    asSelect2Tag.select2({tags: true});
    choices.append('<i class="fa fa-angle-down" aria-hidden="true"></i>');
    choice.append('<i class="fa fa-angle-down" aria-hidden="true"></i>');

    tinymce.init({
      selector: '.tinymce',
      templates: "modern",
      menubar: false,

      toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | fontselect | bullist numlist outdent indent | link image',
     });

    $(window).on('scroll', function() {
      var scroll = $(window).scrollTop();
      //console.log(scroll);
      if (scroll >= 50) {
        //console.log('a');
        header.addClass("fixed-header");

      } else {
        //console.log('a');
        header.removeClass("fixed-header");
      }
    });

    inputfiles.on('change', function() {
      var path = $(this).val();
      //$('.upload span').html(filename);
      console.log(path);
    });
    rem_img.on('click', function() {
      event.preventDefault();
      imgupld.css('display', 'none');
      fname.html('<i class="fa fa-file-image-o" aria-hidden="true"></i>Browse image ');

    });

  });;
  (function(document, window, index) {
    var inputs = document.querySelectorAll('.inputfile');

    Array.prototype.forEach.call(inputs, function(input) {
      var label = input.nextElementSibling,
        labelVal = label.innerHTML;

      input.addEventListener('change', function(e) {
        var fileName = '';
        var reader = new FileReader();

        if (this.files && this.files.length > 1) {
          fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );

        } else {
          fileName = e.target.value.split('\\').pop();

        }
        if (fileName) {
          label.querySelector('.filename').innerHTML = fileName;
          $('.image_upload ').css('display', 'block');

        } else {
          label.innerHTML = labelVal;
        }
      });

      // Firefox bug fix
      input.addEventListener('focus', function() {
        input.classList.add('has-focus');
      });
      input.addEventListener('blur', function() {
        input.classList.remove('has-focus');
      });
    });
  }(document, window, 0));

  /* ////////////////// */
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

})(jQuery);
