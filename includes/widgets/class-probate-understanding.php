<?php

if ( ! defined( 'ABSPATH' ) ) exit;

require_once GBC_EW_PATH . 'includes/widgets/class-probate-page-base.php';

class GBC_EW_Probate_Understanding_Widget extends GBC_EW_Probate_Page_Base {

    public function get_name() {
        return 'gbc-probate-understanding';
    }

    public function get_title() {
        return __( 'GBC Probate: Understanding Probate', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-document-file';
    }

    protected function get_page_type() {
        return 'understanding';
    }
}
