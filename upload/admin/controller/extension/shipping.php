<?php
namespace Opencart\Admin\Controller\Extension;
class Shipping extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$this->response->setOutput($this->getList());
	}

	public function getList(): string {
		$this->load->language('extension/shipping');

		$available = [];

		$this->load->model('setting/extension');

		$results = $this->model_setting_extension->getPaths('%/admin/controller/shipping/%.php');

		foreach ($results as $result) {
			$available[] = basename($result['path'], '.php');
		}

		$installed = [];

		$extensions = $this->model_setting_extension->getExtensionsByType('shipping');

		foreach ($extensions as $extension) {
			if (in_array($extension['code'], $available)) {
				$installed[] = $extension['code'];
			} else {
				$this->model_setting_extension->uninstall('shipping', $extension['code']);
			}
		}

		$data['extensions'] = [];

		if ($results) {
			foreach ($results as $result) {
				$extension = substr($result['path'], 0, strpos($result['path'], '/'));

				$code = basename($result['path'], '.php');

				$this->load->language('extension/' . $extension . '/shipping/' . $code, $code);

				$data['extensions'][] = [
					'name'       => $this->language->get($code . '_heading_title'),
					'status'     => $this->config->get('shipping_' . $code . '_status') ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
					'sort_order' => $this->config->get('shipping_' . $code . '_sort_order'),
					'install'    => $this->url->link('extension/shipping|install', 'user_token=' . $this->session->data['user_token'] . '&extension=' . $extension . '&code=' . $code),
					'uninstall'  => $this->url->link('extension/shipping|uninstall', 'user_token=' . $this->session->data['user_token'] . '&extension=' . $extension . '&code=' . $code),
					'installed'  => in_array($code, $installed),
					'edit'       => $this->url->link('extension/' . $extension . '/shipping/' . $code, 'user_token=' . $this->session->data['user_token'])
				];
			}
		}

		$data['promotion'] = $this->load->controller('marketplace/promotion');

		return $this->load->view('extension/shipping', $data);
	}

	public function install(): void {
		$this->load->language('extension/shipping');

		$json = [];

		if (isset($this->request->get['extension'])) {
			$extension = basename($this->request->get['extension']);
		} else {
			$extension = '';
		}

		if (isset($this->request->get['code'])) {
			$code = basename($this->request->get['code']);
		} else {
			$code = '';
		}

		if (!$this->user->hasPermission('modify', 'extension/shipping')) {
			$json['error'] = $this->language->get('error_permission');
		}

		if (!is_dir(DIR_EXTENSION . 'extension/' . $extension . '/analytics/' . $code)) {
			$json['error'] = $this->language->get('error_directory');
		}

		if (!$json) {
			$this->load->model('setting/extension');

			$this->model_setting_extension->install('shipping', $extension, $code);

			$this->load->model('user/user_group');

			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/' . $extension . '/shipping/' . $code);
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/' . $extension . '/shipping/' . $code);

			// Register controllers, models and system extension folders
			$this->autoloader->register('Opencart\Admin\Controller\Extension\\' . $extension, DIR_EXTENSION . $extension . '/admin/controller/');
			$this->autoloader->register('Opencart\Admin\Model\Extension\\' . $extension, DIR_EXTENSION . $extension . '/admin/model/');
			$this->autoloader->register('Opencart\System\Extension\\' . $extension, DIR_EXTENSION . $extension . '/system/');

			// Template directory
			$this->template->addPath('extension/' . $extension, DIR_EXTENSION . $extension . '/admin/view/template/');

			// Language directory
			$this->language->addPath('extension/' . $extension, DIR_EXTENSION . $extension . '/admin/language/');

			// Config directory
			$this->config->addPath('extension/' . $extension, DIR_EXTENSION . $extension . '/system/config/');

			// Call install method if it exists
			$this->load->controller('extension/' . $extension . '/shipping/' . $code . '|install');

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function uninstall(): void {
		$this->load->language('extension/shipping');

		$json = [];

		if (!$this->user->hasPermission('modify', 'extension/shipping')) {
			$json['error'] = $this->language->get('error_permission');
		}

		if (!$json) {
			$this->load->model('setting/extension');

			$this->model_setting_extension->uninstall('shipping', $this->request->get['code']);

			// Call uninstall method if it exists
			$this->load->controller('extension/' . $this->request->get['extension'] . '/shipping/' . $this->request->get['code'] . '|uninstall');

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}