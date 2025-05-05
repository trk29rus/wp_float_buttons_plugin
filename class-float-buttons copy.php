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
	add_menu_page( 'Плавающая кнопка', 'Плавающая кнопка', 'manage_options', 'float_button', array( $this, 'admin_settings_page'), 'dashicons-chart-pie', 6 );
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

function artweb_pages_id_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <textarea name='float_buttons_settings[artweb_pages_id]' value='<?php echo $options['artweb_pages_id']; ?>'><?php echo $options['artweb_pages_id']; ?></textarea>
    <?php
}
	
function tooltip_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <textarea name='float_buttons_settings[tooltip]' value='<?php echo $options['tooltip']; ?>'><?php echo $options['tooltip']; ?></textarea>
    <?php
}	

function artweb_phone_field_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='text' name='float_buttons_settings[artweb_phone_field]' value='<?php echo $options['artweb_phone_field']; ?>'>
    <?php
}

function artweb_vk_field_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='text' name='float_buttons_settings[artweb_vk_field]' value='<?php echo $options['artweb_vk_field']; ?>'>
    <?php
}

function artweb_shortcode_field_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='text' name='float_buttons_settings[artweb_shortcode_field]' value='<?php echo $options['artweb_shortcode_field']; ?>'>
    <?php
}

function artweb_shortcode_button_color_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='color' name='float_buttons_settings[artweb_shortcode_button_color]' value='<?php echo $options['artweb_shortcode_button_color']; ?>'>
    <?php
}

function artweb_phone_field_color_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='color' name='float_buttons_settings[artweb_phone_field_color]' value='<?php echo $options['artweb_phone_field_color']; ?>'>
    <?php
}

function artweb_mail_field_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='text' name='float_buttons_settings[artweb_mail_field]' value='<?php echo $options['artweb_mail_field']; ?>'>
    <?php
}

function artweb_mail_field_color_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='color' name='float_buttons_settings[artweb_mail_field_color]' value='<?php echo $options['artweb_mail_field_color']; ?>'>
    <?php
}

function artweb_whatsapp_field_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='text' name='float_buttons_settings[artweb_whatsapp_field]' value='<?php echo $options['artweb_whatsapp_field']; ?>'>
    <?php
}

function artweb_telegram_field_render( ) {
    $options = get_option( 'float_buttons_settings' );
    ?>
    <input type='text' name='float_buttons_settings[artweb_telegram_field]' value='<?php echo $options['artweb_telegram_field']; ?>'>
    <?php
}

function artweb_main_button_color_render( ) { 
    $options = get_option( 'float_buttons_settings' );
    ?> 
    <input type='color' name='float_buttons_settings[artweb_main_button_color]' value='<?php echo $options['artweb_main_button_color']; ?>'>
    <?php
  }
  
 // выбор иконки
 
 function icon_choise_render( ) { 
    include('svg/svg_icons.php');
    $options = get_option( 'float_buttons_settings' );
    ?> 
    <select name='float_buttons_settings[icon_choise]' value='<?php echo $options['icon_choise']; ?>'>
    <option value=1>1</option>
    </select>
    
    <?php
  }
  
// позиция показа

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
  
// отступ от боковой границы сайта

function range_border_position_render( ) { 
    $options = get_option( 'float_buttons_settings' );
    ?>
    <div id="value_range" style="padding: 4px;
    border: 1px solid;
    max-width: 50px;
    margin-bottom: 10px;
    border-radius: 3px;
    background: #fff;
    text-align: center;"><?php echo $options['range_border_position']; ?> px</div>
    <input type='range' step="1"  min='0' max='150'  id="range_border_position" name='float_buttons_settings[range_border_position]' value='<?php echo $options['range_border_position']; ?>'>
    <?php
  }  
  // отступ от нижней границы сайта

function range_bottom_position_render( ) { 
    $options = get_option( 'float_buttons_settings' );
    ?>
    <div id="value_bottom_range" style="padding: 4px;
    border: 1px solid;
    max-width: 50px;
    margin-bottom: 10px;
    border-radius: 3px;
    background: #fff;
    text-align: center;"><?php echo $options['range_bottom_position'] ?> px</div>
    <input type='range' step="1"  min='0' max='150'  id="range_bottom_position" name='float_buttons_settings[range_bottom_position]' value='<?php echo $options['range_bottom_position']; ?>'>
    <?php
  }
  
  
// где показывать

function show_rules_render( ) { 
    $options = get_option( 'float_buttons_settings' );
    ?>
<fieldset>
  <label for="pc">ПК</label>
  <input type="hidden" name="float_buttons_settings[show_rules]" value="<?php echo $options['show_rules'];?>" />
  <input type="checkbox" id="pc" name="float_buttons_settings[show_rules]" <?php checked( $options['show_rules'], 1 ); ?> value="1">
  <label for="tablets">Планшеты</label>
  <input type="checkbox" id="tablets" name="float_buttons_settings[show_rules]" <?php checked( $options['show_rules'], 2 ); ?> value="2">
</fieldset>
    <?php
  }
}

function artweb_callback() {
    echo __( "<div style='margin-top:20px'> ['float_buttons'] </div>", "wordpress" );
}

public function admin_settings_page( ) {
	 echo '<nav class="nav-tab-wrapper wp-clearfix" aria-label="основное">
		    <a href="#" class="nav-tab nav-tab-active" id="settings">Настройки</a>
		    <a href="#" class="nav-tab" id="colors">Дизайн</a>
		  </nav>';
    ?>
    <form action='options.php' method='post'>
        <!--<h2>Плавающие кнопки связи</h2>-->
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
       array($this, 'artweb_callback'),
        'buttons_setting',
	   array(
		'before_section' => '<div class="shortcode-section">',
        'after_section' => '</div>'
		)
    );
    
  
    $fields = [
        'artweb_switch_button'=>['Включить модуль','artweb_switch_button_render'],
        'artweb_phone_field'=>['Телефон','artweb_phone_field_render'],
        'artweb_telegram_field'=>['Телеграм','artweb_telegram_field_render'],
        'artweb_whatsapp_field'=>['Whatsapp','artweb_whatsapp_field_render'],
        'artweb_shortcode_field'=>['Всплывающее окно (укажите класс окна. Например, modal_popup)','artweb_shortcode_field_render'],
        'artweb_mail_field'=>['Email','artweb_mail_field_render'],
        'artweb_vk_field'=>['Вконтакте','artweb_vk_field_render'],
        'artweb_pages_id'=>['Введите через запятую id страниц, где кнопку не нужно показывать','artweb_pages_id_render']
        ];
        
     // добавляем поля    
    foreach ($fields as $key => $value) {
        add_settings_field(
         $key,
         $value[0],
         $value[1],
        'buttons_setting',
        'buttons_setting_section'		
    ); 
  }
}
	
// цвета
public function float_buttons_colors() {
// секция цветов
add_settings_section(
        'buttons_colors_section',
        __( 'Цвета', 'wordpress' ),
        array($this),
        'buttons_setting',
		array(
		'before_section' => '<div class="section colors">',
        'after_section' => '</div>'
		)
    );
    
 // добавляем поля 
   $colors_fields = [
        'artweb_phone_field_color'=>['Цвет кнопки телефона','artweb_phone_field_color_render'],
        'artweb_mail_field_color'=>['Цвет кнопки Email','artweb_mail_field_color_render'],
        'artweb_main_button_color'=>['Цвет главной кнопки','artweb_main_button_color_render'],
        'artweb_shortcode_button_color'=>['Цвет кнопки всплывающего окна','artweb_shortcode_button_color_render'],
        'tooltip'=>['Подсказка у кнопки','tooltip_render'],
        'show_rules'=>['Где показывать','show_rules_render'],
        'show_position'=>['Позиция','show_position_render'],
        'range_border_position'=>['Отступ от края сайта','range_border_position_render'],
        'range_bottom_position'=>['Отступ от низа сайта','range_bottom_position_render'],
        'icon_choise'=>['Иконка','icon_choise_render']
        ];
        
   foreach ($colors_fields as $key => $value) {
        add_settings_field(
         $key,
         $value[0],
         $value[1],
        'buttons_setting',
        'buttons_colors_section'		
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
$option['artweb_whatsapp_field'] ? $whatsapp_btn = '<div class="float_button whatsapp" data-tooltip="'.$option['artweb_whatsapp_field'].'"><a href="https://wa.me/'.$option['artweb_whatsapp_field'].'" >'.$whatsapp_icon.'</a></div>' : $whatsapp_btn = '';

// кнопка  телеграм	
$option['artweb_telegram_field'] ? $telegram_btn = '<div class="float_button telegram"  data-tooltip="'.$option['artweb_telegram_field'].'"><a href="'.$option['artweb_telegram_field'].'" class="telegram">'.$telegram_icon.'</a></div>' :  $telegram_btn = '';
	
// кнопка  вк
$option['artweb_vk_field'] ? $vk_btn = '<div class="float_button vk"  data-tooltip="'.$option['artweb_vk_field'].'"><a href="https://'.$option['artweb_vk_field'].'" class="vk">'.$vk_icon.'</a></div>' : $vk_btn = '';
	
// email
$option['artweb_mail_field'] ? $mail_btn = '<div class="float_button mail" style="background:'.$option['artweb_mail_field_color'].'"  data-tooltip="'.$option['artweb_mail_field'].'"><a href="mailto:'.$option['artweb_mail_field'].'" class="mail" >'.$mail_icon.'</a></div>' : $mail_btn = '';
	
// shortcode	
$option['artweb_shortcode_field'] ? $shortcode_btn = '<div class="float_button shortcode '.$option['artweb_shortcode_field'].'" style="background:'.$option['artweb_shortcode_button_color'].'"><a href="" class="shortcode '.$option['artweb_shortcode_field'].'">'.$popup_icon.'</a></div>' : $shortcode_btn = '';
		
$buttons  = '<div class="float_buttons" style="'.$option['show_position'].':'.$option['range_border_position'].'px!important; bottom:'.$option['range_bottom_position'].'px!important">';
$buttons .= '<div class="hide_buttons" style="display:none">';
$buttons .= $phone_btn;
$buttons .=	$whatsapp_btn;
$buttons .=	$telegram_btn;
$buttons .=	$mail_btn;
$buttons .=	$shortcode_btn;
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