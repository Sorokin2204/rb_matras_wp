<?php 
// Creating the widget 
class general_widget extends WP_Widget {
 
// The construct part  
function __construct() {
parent::__construct(
  
// Base ID of your widget
'general_widget', 
  
// Widget name will appear in UI
__('Общая информация', 'general_widget_domain'), 
  
// Widget description
array( 'description' => __( '', 'general_widget_domain' ), ) 
);
}
  
  
// Creating widget front-end
public function widget( $args, $instance ) {
 
}
          
// Creating widget Backend 
public function form( $instance ) {
 
}
      
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
 
}
 
// Class wpb_widget ends here
} 