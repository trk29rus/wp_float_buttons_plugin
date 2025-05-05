<?php

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class wp_float_buttons {

public function __construct() {
         // Добавляем страницу настроек
        add_action( 'admin_menu', array( $this, 'register_plugin_page') );	
        // Добавление кнопок        
        add_action( 'admin_init', array( $this,'float_buttons_settings_init') );	    
	// Добавление цветов	  
        add_action( 'admin_init', array( $this,'float_buttons_colors') );		
	// Добавление полей
	add_action( 'admin_init', array( $this,'float_buttons_fields_init') );		
        // Отображения полей       
        add_action( 'admin_init', array( $this, 'fields_display') );		
        // вывод модуля на фронте
        add_action( 'wp_footer', array( $this,'float_buttons'));
        // шорткод
        add_shortcode('float_buttons', array( $this,'float_buttons'));  
}

function plugin_activate(){ 
    register_activation_hook( __FILE__, 'plugin_activate' );
	deactivate_plugins( 'my_plugin/plugin.php' );
}

// страница плагина

function register_plugin_page(){
	add_menu_page( 'Плавающие кнопки связи', 'Плавающие кнопки связи', 'manage_options', 'float_button', array( $this, 'admin_settings_page'), 'dashicons-button', 6 );
}

public function fields_display() {

function artweb_switch_button_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?> 
    <div class="tab_content" id="tab_1">
        <select name='float_buttons_settings[artweb_switch_button]'>
        <option value='1' <?php selected( $options['artweb_switch_button'], 1 ); ?>>Включено</option>
        <option value='2' <?php selected( $options['artweb_switch_button'], 2 ); ?>>Выключено</option>
    </select>
    <?php
}

// добавление полей textarea

function render_textarea($args) {
     $options = get_option( 'float_buttons_settings' );
     $value = $args[ 'fun_name' ] ;
    ?>
    <textarea name='float_buttons_settings[<?php echo $value; ?>]' value='<?php echo $options[$value]; ?>'><?php echo $options[$value]; ?></textarea>
    <?php 
}

// добавление полей input text

function render_input_text($args) {
     $options = get_option( 'float_buttons_settings' );
     $value = $args[ 'fun_name' ] ;
    ?>
    <input type="text" name='float_buttons_settings[<?php echo $value; ?>]' value='<?php echo $options[$value]; ?>'>
    <?php 
} 
    
// добавление полей input color

function render_input_color($args) {
     $options = get_option( 'float_buttons_settings' );
     $value = $args[ 'fun_name' ] ;
    ?>
    <input type="color" name='float_buttons_settings[<?php echo $value; ?>]' value='<?php echo $options[$value]; ?>'>
    <?php 
}  

// поле позиция показа

function show_position_render( ) { 
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='hidden' id='position' name='float_buttons_settings[show_position]' value='<?php echo $options['show_position']; ?>'>
    <label for = "right">Справа</label>
    <input type='radio' id='right' name='float_buttons_settings[show_position]' <?php checked( $options['show_position'], right ); ?> value='right'>
    <label for = "left">Слева</label>
    <input type='radio' id='left' name='float_buttons_settings[show_position]' <?php checked( $options['show_position'], left ); ?> value='left'>
    <?php
}
  
// поле отступ от боковой границы сайта

function range_border_position_render( ) { 
    $options = get_option( 'float_buttons_settings' );
    ?>
    <div id="value_range" class="range"><?php echo $options['range_border_position']; ?> px</div>
    <input type='range' step="1"  min='0' max='150'  id="range_border_position" name='float_buttons_settings[range_border_position]' value='<?php echo $options['range_border_position']; ?>'>
    <?php
} 
  
// поле отступ от нижней границы сайта

function range_bottom_position_render( ) { 
    $options = get_option( 'float_buttons_settings' );
    ?>
    <div id="value_bottom_range" class="range"><?php echo $options['range_bottom_position'] ?> px</div>
    <input type='range' step="1"  min='0' max='150'  id="range_bottom_position" name='float_buttons_settings[range_bottom_position]' value='<?php echo $options['range_bottom_position']; ?>'>
    <?php
   }
}

function shortcode_callback() {
    echo __( "<div style='margin-top:20px'><b>[float_buttons]</b></div>", "wordpress" );
}

public function admin_settings_page( ) {
	 echo '<nav class="nav-tab-wrapper wp-clearfix" aria-label="основное">
		    <a href="#" class="nav-tab nav-tab-active" id="settings">Настройки</a>
		    <a href="#" class="nav-tab" id="colors">Дизайн</a>
		  </nav>';
    ?>
    <form action='options.php' method='post'>       
        <?php
        settings_fields( 'buttons_setting' );
        do_settings_sections( 'buttons_setting' );
        submit_button();
        ?>
    </form>
    <?php
}


public function float_buttons_settings_init() {
    
register_setting( 'buttons_setting', 'float_buttons_settings' );
// секция настроек	
    add_settings_section(
        'buttons_setting_section',
        __( 'Кнопки связи', 'wordpress' ),
        //array($this, 'section_callback'), // функции, можно добавить несколько
         array($this),
          'buttons_setting',
	 array(
	  'before_section' => '<div class="section settings">',
          'after_section' => '</div>'
	)
    );
}

// поля
public function float_buttons_fields_init() {	
    // вывод секции шорткода
    add_settings_section(
        'artweb_section',
        'Шорткод',
        array ($this, 'shortcode_callback'),
         'buttons_setting',
	array (
	 'before_section' => '<div class="shortcode-section">',
         'after_section' => '</div>'
	)
    );
   
$fields = [
        'artweb_switch_button'=>['Включить модуль','artweb_switch_button_render'],
        'artweb_phone_field'=>['Телефон','render_input_text'],
        'artweb_mail_field'=>['Email','render_input_text'],
        'artweb_telegram_field'=>['Телеграм','render_input_text'],
        'artweb_whatsapp_field'=>['Whatsapp','render_input_text'],
        'artweb_vk_field'=>['Вконтакте','render_input_text'],
        'artweb_pages_id'=>['Введите через запятую id страниц, где кнопку нужно скрыть','render_textarea']
        ];
        
     // добавляем поля 
     
    foreach ($fields as $key => $value) {
        add_settings_field(
         $key,
         $value[0],
         $value[1],
        'buttons_setting',
        'buttons_setting_section',
         array ( 
	     'fun_name' => $key, 
	)
     ); 
   }
}
	
// цвета

public function float_buttons_colors() {

// секция цветов
add_settings_section(
        'buttons_colors_section',
        __( 'Дизайн и цвета', 'wordpress' ),
        array ($this),
         'buttons_setting',
	array (
	 'before_section' => '<div class="section colors">',
         'after_section' => '</div>'
	)
    );
    
 // добавляем поля 
 
   $colors_fields = [
        'artweb_phone_field_color'=>['Цвет кнопки телефона','render_input_color'],
        'artweb_mail_field_color'=>['Цвет кнопки Email','render_input_color'],
        'artweb_main_button_color'=>['Цвет главной кнопки','render_input_color'],
        'tooltip'=>['Подсказка у кнопки','render_textarea'],
        'show_position'=>['Позиция кнопки','show_position_render'],
        'range_border_position'=>['Отступ от края страницы','range_border_position_render'],
        'range_bottom_position'=>['Отступ от низа страницы','range_bottom_position_render'],
        ];
        
   foreach ($colors_fields as $key => $value) {
        add_settings_field(
         $key,
         $value[0],
         $value[1],
        'buttons_setting',
        'buttons_colors_section',
         array ( 
	    'fun_name' => $key, 
      )
    ); 
  }
}

public function float_buttons() {
// иконки
include('svg/svg_icons.php');
	
$option = get_option( 'float_buttons_settings' );
// массив исключаемых страниц 	
$pages = explode(',', $option['artweb_pages_id']);
	
if ( !is_page( $pages ) ) {
	
// кнопка телефона	
$option['artweb_phone_field'] ? $phone_btn = '<div class="float_button phone" style="background:'.$option['artweb_phone_field_color'].'" data-tooltip="'.$option['artweb_phone_field'].'"><a href="tel:'.$option['artweb_phone_field'].'" class="phone">'.$phone_icon.'</a></div>' : $phone_btn = '';

// кнопка  whatsapp	
$option['artweb_whatsapp_field'] ? $whatsapp_btn = '<div class="float_button whatsapp" data-tooltip="Whatsapp"><a href="https://wa.me/'.$option['artweb_whatsapp_field'].'" >'.$whatsapp_icon.'</a></div>' : $whatsapp_btn = '';

// кнопка  телеграм	
$option['artweb_telegram_field'] ? $telegram_btn = '<div class="float_button telegram"  data-tooltip="Telegram"><a href="'.$option['artweb_telegram_field'].'" class="telegram">'.$telegram_icon.'</a></div>' :  $telegram_btn = '';
	
// кнопка  вк
$option['artweb_vk_field'] ? $vk_btn = '<div class="float_button vk"  data-tooltip="Вконтакте"><a href="'.$option['artweb_vk_field'].'" class="vk">'.$vk_icon.'</a></div>' : $vk_btn = '';
	
// email
$option['artweb_mail_field'] ? $mail_btn = '<div class="float_button mail" style="background:'.$option['artweb_mail_field_color'].'"  data-tooltip="'.$option['artweb_mail_field'].'"><a href="mailto:'.$option['artweb_mail_field'].'" class="mail" >'.$mail_icon.'</a></div>' : $mail_btn = '';
	

$buttons  = '<div class="float_buttons" style="'.$option['show_position'].':'.$option['range_border_position'].'px!important; bottom:'.$option['range_bottom_position'].'px!important">';
$buttons .= '<div class="hide_buttons" style="display:none">';
$buttons .= $phone_btn;
$buttons .=	$whatsapp_btn;
$buttons .=	$telegram_btn;
$buttons .=	$mail_btn;
$buttons .=	$vk_btn;
$buttons .= '</div>';
$buttons .= '<div class="main_button" data-tooltip="'.$option['tooltip'].'" data-position="'.$option['show_position'].'">
   <button class="pulse-button" style="background:'.$option['artweb_main_button_color'].'"> 
     <span class="pulse_button_icon"><span class="comment_icon">'.$comment_icon.'</span><span class="close_icon" style="display:none">'.$close_icon.'</span></span>    
     <span class="pulse_rings" style="border: 2px solid'.$option['artweb_main_button_color'].'"></span>
     <span class="pulse_rings" style="border: 2px solid'.$option['artweb_main_button_color'].'"></span>
     <span class="pulse_rings" style="border: 2px solid'.$option['artweb_main_button_color'].'"></span> 
  </button>
 </div>
</div>';

// вывод кнопок
 if (!is_admin() && $option['artweb_switch_button'] == 1) {  
  echo $buttons;
      }
    }
  } 
}
?>
