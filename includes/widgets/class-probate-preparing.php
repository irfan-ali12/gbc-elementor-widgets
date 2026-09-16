<?php

if ( ! defined( 'ABSPATH' ) ) exit;

require_once GBC_EW_PATH . 'includes/widgets/class-probate-page-base.php';

class GBC_EW_Probate_Preparing_Widget extends GBC_EW_Probate_Page_Base {

    public function get_name() {
        return 'gbc-probate-preparing';
    }

    public function get_title() {
        return __( 'GBC Probate: Preparing Home for Sale', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-document-file';
    }

    protected function get_page_type() {
        return 'preparing';
    }
}
