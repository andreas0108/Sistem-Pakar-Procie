<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_model extends CI_Model
{
	public function getUser()
	{
		$query = "SELECT `user`.`id`, `user`.`name`, `user`.`email`, `user`.`img`, `user`.`address`, `user_role`.`role`, `user`.`date_created`, `user`.`status`
					FROM `user` JOIN `user_role` 
					  ON `user`.`role_id` = `user_role`.`id`
        ";
		return $this->db->query($query)->result_array();
	}

	public function getUserOnline()
	{
		$query = "SELECT COUNT(`user`.`status`) AS UserOnline 
					FROM `user` WHERE `user`.`status` = 1
		";
		return $this->db->query($query)->result_array();
	}
}
