<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
	    if($this->user) {
            $summary = $this->ticket_model->get_counts_by_status();
            $new = $this->ticket_model->get_new(5);
            $updated = $this->ticket_model->get_updated(5);

            set_title('Home');
            $this->load->view('home', compact('summary', 'updated', 'new'));
            return;
        }

        $this->load->view('promo');
	}

    public function features()
    {
        $this->load->view('features');
    }

    public function screenshots()
    {
        $this->load->view('screenshots');
    }

    public function about()
    {
        $this->load->view('about');
    }
}
