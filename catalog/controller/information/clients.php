<?php
class ControllerInformationClients extends Controller {
	public function index() {
		$this->load->language('information/clients');
		$this->load->model('extension/module/clients');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addBreadcrumb(array(
			'href' => $this->url->link('common/home'),
			'text' => $this->language->get('text_home')
		));
		$this->document->addBreadcrumb(array(
			'href' => $this->url->current(),
			'text' => $this->language->get('heading_title')
		));

		$data['heading_title'] = $this->language->get('heading_title');
		$data['description_title'] = $this->language->get('description_title');

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

		$data['breadcrumbs'] = $this->document->getBreadcrumbs();

		$this->response->setOutput($this->load->view('information/clients', $data));
	}
}