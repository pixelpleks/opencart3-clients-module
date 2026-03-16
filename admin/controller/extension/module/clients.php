<?php
class ControllerExtensionModuleClients extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/clients');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/clients');
		$this->load->model('user/user_group');

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_website'] = $this->language->get('column_website');
		$data['column_action'] = $this->language->get('column_action');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['clients'] = array();

		$results = $this->model_extension_module_clients->getClients();

		foreach ($results as $result) {
			$data['clients'][] = array(
				'client_id' => $result['client_id'],
				'name' => $result['name'],
				'website' => $result['website'],
				'edit' => $this->url->link('extension/module/clients/edit', 'user_token=' . $this->session->data['user_token'] . '&client_id=' . $result['client_id'], true),
				'delete' => $this->url->link('extension/module/clients/delete', 'user_token=' . $this->session->data['user_token'] . '&client_id=' . $result['client_id'], true)
			);
		}

		$data['add'] = $this->url->link('extension/module/clients/add', 'user_token=' . $this->session->data['user_token'], true);
		$data['back'] = $this->url->link('extension/module', 'user_token=' . $this->session->data['user_token'], true);

		$data['user_token'] = $this->session->data['user_token'];

		$this->response->setOutput($this->load->view('extension/module/clients', $data));
	}

	public function add() {
		$this->load->language('extension/module/clients');
		$this->document->setTitle($this->language->get('heading_add'));

		$this->load->model('extension/module/clients');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_module_clients->addClient($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/clients', 'user_token=' . $this->session->data['user_token'], true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('extension/module/clients');
		$this->document->setTitle($this->language->get('heading_edit'));

		$this->load->model('extension/module/clients');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_module_clients->editClient($this->request->get['client_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/clients', 'user_token=' . $this->session->data['user_token'], true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('extension/module/clients');

		$this->load->model('extension/module/clients');

		if (isset($this->request->get['client_id'])) {
			$this->model_extension_module_clients->deleteClient($this->request->get['client_id']);

			$this->session->data['success'] = $this->language->get('text_success_delete');

			$this->response->redirect($this->url->link('extension/module/clients', 'user_token=' . $this->session->data['user_token'], true));
		}
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_add');
		$data['text_form'] = $this->language->get('text_form');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_logo'] = $this->language->get('entry_logo');
		$data['entry_website'] = $this->language->get('entry_website');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->request->get['client_id'])) {
			$data['heading_title'] = $this->language->get('heading_edit');

			$this->load->model('extension/module/clients');
			$client_info = $this->model_extension_module_clients->getClient($this->request->get['client_id']);

			if ($client_info) {
				$data['client_id'] = $client_info['client_id'];
				$data['name'] = $client_info['name'];
				$data['logo'] = $client_info['logo'];
				$data['website'] = $client_info['website'];
				$data['description'] = $client_info['description'];
			}
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (isset($data['name'])) {
			// value already set
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['logo'])) {
			$data['logo'] = $this->request->post['logo'];
		} elseif (isset($data['logo'])) {
			// value already set
		} else {
			$data['logo'] = '';
		}

		if (isset($this->request->post['website'])) {
			$data['website'] = $this->request->post['website'];
		} elseif (isset($data['website'])) {
			// value already set
		} else {
			$data['website'] = '';
		}

		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (isset($data['description'])) {
			// value already set
		} else {
			$data['description'] = '';
		}

		$data['back'] = $this->url->link('extension/module/clients', 'user_token=' . $this->session->data['user_token'], true);
		$data['user_token'] = $this->session->data['user_token'];

		$this->response->setOutput($this->load->view('extension/module/clients_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'extension/module/clients')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['website']) < 1) || (utf8_strlen($this->request->post['website']) > 255)) {
			$this->error['website'] = $this->language->get('error_website');
		}

		return !$this->error;
	}
}