<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Common');
			if (!admin()) {
				redirect('app');
			}
	}
	public function add()
	{
		$this->load->view('admin/notification/add');
	}
	
	public function addData()
	{
		date_default_timezone_set('Asia/Kolkata');
        $timestamp = date('Y-m-d H:i:s');
        
		$title      = $this->security->xss_clean($this->input->post('title'));
        $message    = $this->security->xss_clean($this->input->post('message'));
        $position   = $this->security->xss_clean($this->input->post('position'));

		$image      = $this->input->post('image');
		if($image!='')
		{
			$img        = substr($image, strpos($image, ",") + 1);
			$url      = FCPATH.'uploads/admin/notification/';
			$rand     = $title.date('Ymd').mt_rand(1001,9999);
			$userpath = $url.$rand.'.png';
			$path     = "uploads/admin/notification/".$rand.'.png';
			file_put_contents($userpath,base64_decode($img));

			$array = [
						'title'       => $title,
						'message'     => $message,
						'image'       => $path,
						'timestamp'   => $timestamp
			        ];
		}
		else
		{

			$array = [
						'title'       => $title,
						'message'     => $message,
						'timestamp'   => $timestamp
			        ];

		}
		if ($this->Common->insert('notification',$array)) {

			    $SERVER_API_KEY = "AAAAGCRTVI0:APA91bEoHDY3sM_4v4nw26b91G4lLnhL7RpbEKrXaf7yvm-tbhEQVHmkFtHbZ3s-XWVWb9G3SUynEkejbKb5K5aWrmuW_nQ3nG3gXS3xrtNsAzK2zMibrKJjDAQRXK-0WjjCmoW-QSH0";
				$to        = "/topics" . "/FCM-TOPIC-FARMROOT";
                $image_url ='https://localhost/farmroot/'.$path;
                // $  ='https://localhost/farmroot/'.$path;

				$header = [
					'Authorization: key='. $SERVER_API_KEY,
					'Content-Type: Application/json'
				];

				$notification = [
					'title'  => $title,
					'body'   => $message,
					// 'image'  => $icon_url,
					'picture'=> $image_url,
					'content_available' => true
				];

				$data = [
					'title'  => $title,
					'body'   => $message,
					// 'image'  => $icon_url,
					'picture'=> $image_url,
					'data'   => $array
				];

				$payload = [
					'data'         => $data,
					'notification' => $notification,
					'to'           => $to,
					'priority'     => 10
				];

				$url = 'https://fcm.googleapis.com/fcm/send';

				$curl = curl_init();

				curl_setopt_array($curl, array(
					 CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
					 CURLOPT_RETURNTRANSFER => true,
					 CURLOPT_CUSTOMREQUEST => "POST",
					 CURLOPT_POSTFIELDS => json_encode($payload),
					 CURLOPT_HTTPHEADER => $header,
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

					// return true;
			$this->session->set_flashdata('alert_type', 'success');
			$this->session->set_flashdata('alert_title', 'Success');
			$this->session->set_flashdata('alert_message', 'Notification sent successfully..!');

			redirect('admin/notification/add');
		}
		else {
			$this->session->set_flashdata('alert_type', 'error');
			$this->session->set_flashdata('alert_title', 'Failed');
			$this->session->set_flashdata('alert_message', 'Failed to send notification..!');

			redirect('admin/notification/add');
		}
	}
	
	
}
?>
