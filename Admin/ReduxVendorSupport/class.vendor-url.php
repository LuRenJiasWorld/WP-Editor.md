<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Redux_VendorURL' ) ) {
    class Redux_VendorURL {
        static public $url;
        static public $dir;

        public static function get_url( $handle ) {
            $min    = Redux_Functions::isMin();
            $ace    = self::$dir . 'vendor/ace_editor/ace.js';
            $s2js   = self::$dir . 'vendor/select2/select2' . $min . '.js';
            $s2css  = self::$dir . 'vendor/select2/select2.css';

            if ( $handle == 'ace-editor-js' && file_exists( $ace ) ) {
                return self::$url . 'vendor/ace_editor/ace.js';
            } elseif ( $handle == 'select2-js' && file_exists( $s2js ) ) {
                return self::$url . 'vendor/select2/select2.js';
            } elseif ( $handle == 'select2-css' && file_exists( $s2css ) ) {
                return self::$url . 'vendor/select2/select2.css';
            }
        }
    }
}