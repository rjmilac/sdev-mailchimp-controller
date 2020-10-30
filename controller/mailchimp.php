<?php
    /**
     *  Mailchimp Controller
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 1.0
     */

    namespace SDEV\Controller;

    class Mailchimp extends \SDEV\Controller {

        public function __construct(){
            parent::__construct();
            $this->apiClient = new \MailchimpMarketing\ApiClient();
            $this->apiClient->setConfig([
                'apiKey' => MC_API_KEY,
                'server' => MC_SERVER_PREFIX
            ]);
        }

        public function subscribeAudience($list_id, Array $contact){

            $response = false;
            $message = 'Invalid parameters';

            if(isset($contact['email_address'])){
                try {
                    $response = $this->apiClient->lists->addListMember($list_id, $contact);
                    $message = 'Success';
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                }
            }

            return [
                'response' => $response,
                'message' => $message
            ];

        }

    }

?>