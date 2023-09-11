<?php
  if (!class_exists( 'CAF_Fa_Icons' ) ) {
    class CAF_Fa_Icons {
     var $icons;
      public function __construct()
      {
      
      }
      public function caf_generate_icon_array() {
        $icons = get_option( 'caf_fa_icons' );
        if ( ! $icons ) {
              $all_icons=json_decode(file_get_contents(TC_CAF_PRO_URL.'admin/fa-icons/fontawesome-5.json'),true);
              foreach ( $all_icons as $icon ) {
                $icons[] = array( 'class' =>$icon );
                } 
                update_option( 'caf_fa_icons', $icons ); 
            }
            $this->icons = $icons;
      }
    
  }
}