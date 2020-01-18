<?php
defined('BASEPATH') or exit('No direct script access allowed');

class article_model extends CI_Model
{
	public function getArticle()
	{
		$query = "SELECT `content_article`.*,`user`.`name`
					FROM `content_article` JOIN `user` 
					  ON `content_article`.`penulis_id` = `user`.`id`
				ORDER BY `content_article`.`tgl_buat` DESC
        ";
		return $this->db->query($query)->result_array();
	}

	public function getArticleBySlug($slug)
	{
		$query = "SELECT `content_article`.*, `user`.`name`
					FROM `content_article` JOIN `user`
					  ON `content_article`.`penulis_id` = `user`.`id`
				   WHERE `content_article`.`slug` = $slug
		";
		return $this->db->query($query)->result_array();
	}

	public function getSingleArticleByID($id)
	{
		$query = "SELECT content_article.id, content_article.judul, content_article.isi, content_article.penulis_id, user.name, content_article.status, content_article.gambar
					FROM content_article JOIN user 
					  ON content_article.penulis_id = user.id
				   WHERE content_article.id = $id
		";
		return $this->db->query($query)->row_array();
	}

	public function getListArticleByID($id)
	{
		$query = "SELECT content_article.id, content_article.slug, content_article.judul, content_article.isi, content_article.penulis_id, user.name, content_article.status, content_article.tgl_buat, content_article.gambar
					FROM content_article JOIN user
					  ON content_article.penulis_id = user.id
				   WHERE content_article.penulis_id = $id
				ORDER BY content_article.tgl_buat DESC
		";
		return $this->db->query($query)->result_array();
	}

	public function getListArticleByIDLimited($id, $limit, $start)
	{
		$query = "SELECT content_article.id, content_article.slug, content_article.judul, content_article.isi, content_article.penulis_id, user.name, content_article.status, content_article.tgl_buat, content_article.gambar
					FROM content_article JOIN user
					  ON content_article.penulis_id = user.id
				   WHERE content_article.penulis_id = $id
				   ORDER BY content_article.tgl_buat DESC
				   LIMIT $start, $limit
		";
		return $this->db->query($query)->result_array();
	}
}
