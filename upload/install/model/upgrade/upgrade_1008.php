<?php
namespace Opencart\Application\Model\Upgrade;
class Upgrade1008 extends \Opencart\System\Engine\Model {
	public function upgrade() {
		// Event
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `type` = 'dashboard'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'activity'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'sale'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'recent'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'order'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'online'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'map'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'customer'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extension` SET `type` = 'dashboard', `code` = 'chart'");

			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_activity', `key` = 'dashboard_activity_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_activity', `key` = 'dashboard_activity_sort_order', `value` = '7', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_sale', `key` = 'dashboard_sale_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_sale', `key` = 'dashboard_sale_width', `value` = '3', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_chart', `key` = 'dashboard_chart_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_chart', `key` = 'dashboard_chart_width', `value` = '6', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_customer', `key` = 'dashboard_customer_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_customer', `key` = 'dashboard_customer_width', `value` = '3', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_map', `key` = 'dashboard_map_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_map', `key` = 'dashboard_map_width', `value` = '6', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_online', `key` = 'dashboard_online_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_online', `key` = 'dashboard_online_width', `value` = '3', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_order', `key` = 'dashboard_order_sort_order', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_order', `key` = 'dashboard_order_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_order', `key` = 'dashboard_order_width', `value` = '3', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_sale', `key` = 'dashboard_sale_sort_order', `value` = '2', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_customer', `key` = 'dashboard_customer_sort_order', `value` = '3', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_online', `key` = 'dashboard_online_sort_order', `value` = '4', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_map', `key` = 'dashboard_map_sort_order', `value` = '5', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_chart', `key` = 'dashboard_chart_sort_order', `value` = '6', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_recent', `key` = 'dashboard_recent_status', `value` = '1', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_recent', `key` = 'dashboard_recent_sort_order', `value` = '8', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_activity', `key` = 'dashboard_activity_width', `value` = '4', `serialized` = '0'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = '0', `code` = 'dashboard_recent', `key` = 'dashboard_recent_width', `value` = '8', `serialized` = '0'");
		}
	}
}