<?php
class ControllerExtensionModuleClients extends Controller {
	public function index() {
		$this->load->language('extension/module/clients');
		$this->load->model('extension/module/clients');

		$data['clients'] = array();

		$results = $this->model_extension_module_clients->getClients();

		// Рандомизация
		shuffle($results);

		foreach ($results as $result) {
			$data['clients'][] = array(
				'name' => $result['name'],
				'logo' => $result['logo'],
				'website' => $result['website'],
				'description' => $result['description']
			);
		}

		$this->response->setOutput($this->load->view('extension/module/clients', $data));
	}
}