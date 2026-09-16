<?php

if ( ! defined( 'ABSPATH' ) ) exit;

require_once GBC_EW_PATH . 'includes/widgets/class-probate-page-base.php';

class GBC_EW_Probate_Selling_Widget extends GBC_EW_Probate_Page_Base {

    public function get_name() {
        return 'gbc-probate-selling';
    }

    public function get_title() {
        return __( 'GBC Probate: Selling Inherited Home', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-document-file';
    }

    protected function get_page_type() {
        return 'selling';
    }
}
