<?php
/**
 * Created by PhpStorm.
 * User: Mustafa Shaaban
 * Date: 9/1/2019
 * Time: 3:16 PM
 */

class LG_Uploader
{
    public static $instance;

    public function __construct()
    {
        self::$instance = $this;

        add_action('wp_ajax_lg_upload_attachment', array($this, 'lg_upload_attachment'));
        add_action('wp_ajax_nopriv_lg_upload_attachment', array($this, 'lg_upload_attachment'));
    }

    public static function get()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function lg_upload_attachment(){
        $file = $_FILES;
        if (!empty($file)) {

            $upload = wp_upload_bits( $file['file']['name'], null, file_get_contents( $file['file']['tmp_name'] ) );

            if (!empty($upload['error'])) {
                wp_send_json(array('success' => false, 'msg' => __($upload['error'], "LG")));
            }

            $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );

            $wp_upload_dir = wp_upload_dir();

            $attachment = array(
                'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path( $upload['file'] ),
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            $attach_id = wp_insert_attachment( $attachment, $upload['file'] );

            $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );

            wp_update_attachment_metadata( $attach_id, $attach_data );

            wp_upload_bits($file['file']["name"], null, file_get_contents($file['file']["tmp_name"]));

            wp_send_json(array('success' => true, 'msg' => __('Attachment has been uploaded successfully', "LG"), 'attachment_ID' => $attach_id));
        } else {
            wp_send_json(array('success' => false, 'msg' => __("Can't upload empty file", "LG")));
        }
    }

}