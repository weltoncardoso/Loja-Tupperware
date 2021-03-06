<?php
class Colors extends model {

	public function getList() {
		$array = array();

		$sql = "SELECT * FROM colors";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
	
	public function getNameById($id) {

		$sql = "SELECT name FROM colors WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data['name'];
		} else {
			return '';
		}

	}

}