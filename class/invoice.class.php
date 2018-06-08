<?php
	require_once('connect.class.php');
	class invoice
	{
		public function getMaxId($columnName, $tableName){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT max(".$columnName.") as max FROM ".$tableName);
			$qry->execute();
			return $qry;
		}
		
		public function viewInvoiceItemList()
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM invoiceitem");
			$qry->execute();
			return $qry;			
		}
		
		public function getInvoiceList($customer_id)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM invoice WHERE customer_id=:customer_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function getInvoiceListByDate($customer_id, $start_date, $end_date)
		{
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM invoice WHERE customer_id=:customer_id AND purchase_time BETWEEN :start_date AND :end_date");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":start_date",$start_date,PDO::PARAM_STR);
			$qry->bindParam(":end_date",$end_date,PDO::PARAM_STR);
			$qry->execute();
			return $qry;			
		}
		
		public function getInvoiceItemList($customer_id, $invoice_no){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT a.title, ii.*
										from invoice i, invoiceitem ii, artifact a
										where i.customer_id=:customer_id
										and i.invoice_no = :invoice_no
										and i.invoice_no = ii.invoice_no 
										and a.artifact_id = ii.artifact_id");
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":invoice_no",$invoice_no,PDO::PARAM_INT);
			$qry->execute();
			return $qry;			
		}
		
		public function insertInvoiceList($customer_id, $courier_name, $payment, $purchase_type, $payment_number){
			$maxId = $this->getMaxId("invoice_no", "invoice")->fetch();
			$invoice_no = $maxId['max'] + 1;
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO invoice(invoice_no, customer_id, courier_name, purchase_time, payment, purchase_type, payment_number) VALUES (:invoice_no, :customer_id, :courier_name, now(), :payment, :purchase_type, :payment_number)");
			$qry->bindParam(":invoice_no",$invoice_no,PDO::PARAM_INT);
			$qry->bindParam(":customer_id",$customer_id,PDO::PARAM_INT);
			$qry->bindParam(":courier_name",$courier_name,PDO::PARAM_STR);
			$qry->bindParam(":payment",$payment,PDO::PARAM_STR);
			$qry->bindParam(":purchase_type",$purchase_type,PDO::PARAM_STR);
			$qry->bindParam(":payment_number",$payment_number,PDO::PARAM_INT);
			$qry->execute();
			$arr = array();
			array_push($arr,$qry);
			array_push($arr,$invoice_no);
			return $arr;
		}
		
		// Insert into the invoiceitem table
		public function insertInvoiceItemList($invoice_no, $artifact_id, $qty, $unit_price){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO invoiceitem(invoice_no, artifact_id, quantity, unit_price) VALUES (:invoice_no, :artifact_id, :qty, :unit_price)");
			$qry->bindParam(":invoice_no",$invoice_no,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->bindParam(":qty",$qty,PDO::PARAM_INT);
			$qry->bindParam(":unit_price",$unit_price,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		// Insert into the invoicecustomize table
		public function insertInvoiceRequest($invoice_no, $artifact_id, $request){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("INSERT INTO invoicecustomize VALUES (:invoice_no, :artifact_id, :request)");
			$qry->bindParam(":invoice_no",$invoice_no,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->bindParam(":request",$request,PDO::PARAM_STR);
			$qry->execute();
			return $qry;
		}
		
		// Insert into the invoicecustomize table
		public function getInvoiceRequest($invoice_no, $artifact_id){
			$dbcon= new connect();
			$qry=$dbcon->db1->prepare("SELECT * FROM invoicecustomize WHERE invoice_no = :invoice_no AND artifact_id = :artifact_id");
			$qry->bindParam(":invoice_no",$invoice_no,PDO::PARAM_INT);
			$qry->bindParam(":artifact_id",$artifact_id,PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
		
		
		
		// Get courier name
		public function getCourierForInvoice($invoice_no){
			$dbcon = new connect();
			$qry=$dbcon->db1->prepare("SELECT courier_name FROM invoice WHERE invoice_no = :invoice_no");
			$qry->bindParam(":invoice_no",$invoice_no, PDO::PARAM_INT);
			$qry->execute();
			return $qry;
		}
	}

?>