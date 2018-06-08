<?php
	require_once('connect.class.php');
	class artifactReview
	{
		public function getAllArtifactReview()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM artifactreview");
			$qry->execute();
			return $qry;			
		}
		public function getArtifactReviewByID($artifact_id)
		{
			$dbcon= new connect();
			$qry= $dbcon->db1->prepare("Select a.*, c.fname,c.lname from artifactreview a,customer c where c.customer_id=a.customer_id and a.artifact_id=:artifact_id");
			$qry->bindParam(":artifact_id",$artifact_id, PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		public function insertArtifactReview($artifact_id, $customer_id, $review){
			$dbcon= new connect();
			$qry= $dbcon->db1->prepare("INSERT INTO artifactreview VALUES (:artifact_id, :customer_id, now(), :review)");
			$qry->bindParam(":artifact_id",$artifact_id, PDO::PARAM_INT);
			$qry->bindParam(":customer_id",$customer_id, PDO::PARAM_INT);
			$qry->bindParam(":review",$review, PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
	}

?>