jQuery(document).ready(function($) {
let button = $('.main_button');
let buttons = $('.float_button');
let attr = button.attr('data-tooltip');
let position = button.attr('data-position');

if(attr.length > 0) {
  switch(position) {
    case 'right':
        button.addClass('show_tooltip');
        break;
    case 'left':
        button.addClass('show_tooltip_left');
        buttons.addClass('float_button_left');
        break;
   } 
}
else {
  button.removeClass('show_tooltip');	 
}

// показ кнопок

button.click(function(){
  $('.hide_buttons, .comment_icon, .close_icon').toggle(200);
  })
})
