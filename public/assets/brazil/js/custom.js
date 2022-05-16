

  /*-------------------------------------------------------------------------------
    PRE LOADER
  -------------------------------------------------------------------------------*/

  $(window).load(function(){
    $('.preloader').fadeOut(1000); // set duration in brackets    
  });



  /* HTML document is loaded. DOM is ready. 
  -------------------------------------------*/

  $(document).ready(function() {


  /*-------------------------------------------------------------------------------
    Hide mobile menu after clicking on a link
  -------------------------------------------------------------------------------*/

    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });



  /*-------------------------------------------------------------------------------
    Back top Top
  -------------------------------------------------------------------------------*/

  $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
          $('.go-top').fadeIn(200);
            } else {
                $('.go-top').fadeOut(200);
           }
        });   
          // Animate the scroll to top
        $('.go-top').click(function(event) {
          event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 300);
    });



  /*-------------------------------------------------------------------------------
    wow js - Animation js
  -------------------------------------------------------------------------------*/

  new WOW({ mobile: false }).init();


  });

  // Result

  jQuery(document).ready(function($){
  //wrap each one of your filter in a .gallery-container div container
  bouncy_filter($('.gallery-container'));

  function bouncy_filter($container) {
    $container.each(function(){
      var $this = $(this);
      var filter_list_container = $this.children('.filter'),
        filter_values = filter_list_container.find('li:not(.placeholder) a'),
        filter_list_placeholder = filter_list_container.find('.placeholder a'),
        filter_list_placeholder_text = filter_list_placeholder.text(), 
        filter_list_placeholder_default_value = 'Select',
        gallery_item_wrapper = $this.children('.gallery').find('.item-wrapper');

      //store gallery items
      var gallery_elements = {};
      filter_values.each(function(){
        var filter_type = $(this).data('type');
        gallery_elements[filter_type] = gallery_item_wrapper.find('li[data-type="'+filter_type+'"]');
      });

      //detect click event
      filter_list_container.on('click', function(event){
        event.preventDefault();
        //detect which filter item was selected
        var selected_filter = $(event.target).data('type');
          
        //check if user has clicked the placeholder item (for mobile version)
        if( $(event.target).is(filter_list_placeholder) || $(event.target).is(filter_list_container) ) {

          (filter_list_placeholder_default_value == filter_list_placeholder.text()) ? filter_list_placeholder.text(filter_list_placeholder_text) : filter_list_placeholder.text(filter_list_placeholder_default_value) ;
          filter_list_container.toggleClass('is-open');

        //check if user has clicked a filter already selected 
        } else if( filter_list_placeholder.data('type') == selected_filter ) {
          
          filter_list_placeholder.text($(event.target).text()) ;
          filter_list_container.removeClass('is-open'); 

        } else {
          //close the dropdown (mobile version) and change placeholder text/data-type value
          filter_list_container.removeClass('is-open');
          filter_list_placeholder.text($(event.target).text()).data('type', selected_filter);
          filter_list_placeholder_text = $(event.target).text();
          
          //add class selected to the selected filter item
          filter_values.removeClass('selected');
          $(event.target).addClass('selected');

          //give higher z-index to the gallery items selected by the filter
          show_selected_items(gallery_elements[selected_filter]);

          //rotate each item-wrapper of the gallery
          //at the end of the animation hide the not-selected items in the gallery amd rotate back the item-wrappers
          
          // fallback added for IE9
          var is_explorer_9 = navigator.userAgent.indexOf('MSIE 9') > -1;
          
          if( is_explorer_9 ) {
            hide_not_selected_items(gallery_elements, selected_filter);
            gallery_item_wrapper.removeClass('is-switched');
          } else {
            gallery_item_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {   
              hide_not_selected_items(gallery_elements, selected_filter);
              gallery_item_wrapper.removeClass('is-switched');
            });
          }
        }
      });
    });
  }
});

function show_selected_items(selected_elements) {
  selected_elements.addClass('is-selected');
}

function hide_not_selected_items(gallery_containers, filter) {
  $.each(gallery_containers, function(key, value){
      if ( key != filter ) {  
      $(this).removeClass('is-visible is-selected').addClass('is-hidden');

    } else {
      $(this).addClass('is-visible').removeClass('is-hidden is-selected');
    }
  });
}