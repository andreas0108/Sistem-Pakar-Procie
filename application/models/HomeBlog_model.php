<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeBlog_model extends CI_Model
{
	public function listAllBlog()
	{
		$query = "SELECT content_article.judul, content_article.isi , user.name, content_article.tgl_buat, content_article.slug 
					FROM `content_article` JOIN user 
					  ON content_article.penulis_id = user.id
				   WHERE content_article.status = 1  
				ORDER BY `content_article`.`tgl_buat`  DESC";

		return $this->db->query($query)->result_array();
	}

	public function listAllBlogLimited($limit, $start)
	{
		if ($start != '') {
			$query = "SELECT content_article.judul, content_article.isi , user.name, content_article.tgl_buat, content_article.slug
					FROM content_article JOIN user
					  ON content_article.penulis_id = user.id
				   WHERE content_article.status = 1 
				   ORDER BY `content_article`.`tgl_buat`  DESC
				   LIMIT $start, $limit
		";
		} else {
			$query = "SELECT content_article.judul, content_article.isi , user.name, content_article.tgl_buat, content_article.slug
					FROM content_article JOIN user
					  ON content_article.penulis_id = user.id
				   WHERE content_article.status = 1 
				   ORDER BY `content_article`.`tgl_buat`  DESC
				   LIMIT $limit
		";
		}
		return $this->db->query($query)->result_array();
	}

	public function getArticleBySlug($slug)
	{
		$query = "SELECT `content_article`.*, `user`.`name`
					FROM `content_article` JOIN `user`
					  ON `content_article`.`penulis_id` = `user`.`id`
				   WHERE `content_article`.`slug` = '$slug'
				   LIMIT 1
		";
		return $this->db->query($query)->result_array();
	}

	public function getNewKomponen()
	{
		$x = "SELECT * FROM komponen WHERE status = 1 ORDER BY id DESC LIMIT 1";
		return $this->db->query($x)->row_array();
	}
}
