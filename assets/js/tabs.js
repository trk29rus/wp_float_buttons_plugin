jQuery(document).ready(function($) {
    
// табы 

$('.colors').hide();
  $('.nav-tab').click(function() { 
    $('.nav-tab').removeClass('nav-tab-active');
	$(this).addClass('nav-tab-active');
	$('.section').hide();
	let attr = $(this).attr('id');	
	$('.' + attr).show();	  
})

// range от границы сайта

function range_border() {
   let value_range = $("#value_range");
   let range = $("#range_border_position");
   let val = range.val();
   val == '' ? val == 0 : val;
   range.on( "change", function() {
   value_range.text($(this).val() + ' px');    
 })
}

range_border();

// range от низа сайта

function range_bottom() {
   let value_range = $("#value_bottom_range");
   let range = $("#range_bottom_position");
   let val = range.val();
   val == '' ? val == 0 : val;
   range.on( "change", function() {
   value_range.text($(this).val() + ' px');
 }) 
}

range_bottom();

})
