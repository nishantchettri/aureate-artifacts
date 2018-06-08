<?php
	require_once('connect.class.php');
	class reports
	{
		public function getPopularArtifacts() {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT v.artifact_id, a.title, v.num_purchase, v.num_wishlist, v.num_browsed 
											FROM artifact a, viw_popularartifacts v 
											where v.artifact_id = a.artifact_id");
			$qry->execute();
			return $qry;
		}
		
		/*public function getPopularArtifactsByDate($start_date, $end_date) {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT v.artifact_id, a.title, v.num_purchase, v.num_wishlist, v.num_browsed 
											FROM artifact a, viw_popularartifact v 
											WHERE v.artifact_id = a.artifact_id");
			$qry->execute();
			return $qry;
		}*/
		
		public function getSalesByItem() {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT a.artifact_id, 
											a.title, sum(i.quantity) as total_sold, sum(i. unit_profit) as profit
											FROM InvoiceItem i, artifact a 
											WHERE a.artifact_id = i.artifact_id 
											GROUP BY i.artifact_id;");
			$qry->execute();
			return $qry;
		}
		
		public function getSalesByItemByDate($start_date, $end_date) {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("select a.artifact_id, 
											a.title as title, sum(II.unit_profit) as profit, sum(II.quantity) as total_sold 
											from InvoiceItem II, Invoice I, artifact a 
											where I.invoice_no=II.invoice_no 
											and II.artifact_id = a.artifact_id
											and I.purchase_time between :start_date and :end_date GROUP BY artifact_id;");
			$qry->bindParam(":start_date",$start_date);
			$qry->bindParam(":end_date",$end_date);
			$qry->execute();
			return $qry;
		}
		
		public function getSalesByItemType() {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("select A.artifact_type, sum(I.quantity) as qty, sum(I.unit_profit) as profit
											from InvoiceItem I, Artifact A 
											where I.artifact_id=A.artifact_id 
											GROUP BY A.artifact_type;");
			$qry->execute();
			return $qry;
		}
		
		public function getSalesByItemTypeByDate($start_date, $end_date) {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("select A.artifact_type,  sum(II.quantity) as qty, sum(II.unit_profit) as profit 
											from InvoiceItem II, Artifact A, Invoice I 
											where II.artifact_id=A.artifact_id 
											and I.invoice_no=II.invoice_no 
											and I.purchase_time between :start_date and :end_date
											GROUP BY A.artifact_type;");
			$qry->bindParam(":start_date",$start_date);
			$qry->bindParam(":end_date",$end_date);
			$qry->execute();
			return $qry;
		}
		
		public function getSalesByLocation() {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("select a.addr_country, 
											count(c. customer_id) as total_customer, sum(II.unit_profit) as profit 
											from Address a, Customer c, Invoice I, InvoiceItem II 
											where a.addr_id=c.addr_id 
											and c.customer_id=I.customer_id 
											and II.invoice_no=I.invoice_no 
											group by a.addr_country");
			$qry->execute();
			return $qry;
		}
		
		public function getSalesByEmployee() {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("select E.employee_id, E.fname, sum(II.unit_price) as total_sales 
											from Employee E, Invoice I, InvoiceItem II 
											where E.employee_id=I.employee_id 
											and I.invoice_no=II.invoice_no 
											group by E.employee_id");
			$qry->execute();
			return $qry;
		}
		
		public function getProfitBySupplier() {
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("select s.vendor_id, v.vendor_name, sum(i.unit_profit) as profit 
											from Supply s, InvoiceItem i, vendor v
											where s.artifact_id=i.artifact_id 
											and s.vendor_id = v.vendor_id
											group by s.vendor_id;");
			$qry->execute();
			return $qry;
		}
		
		public function getSalesByDay(){
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT DATE(Invoice.purchase_time) AS date,
										SUM(InvoiceItem.unit_price*InvoiceItem.quantity) AS total_sale, SUM(InvoiceItem.unit_profit*InvoiceItem.quantity) AS total_profit, SUM(InvoiceItem.quantity) AS total_quantity
										FROM InvoiceItem, Invoice
										WHERE Invoice.invoice_no=InvoiceItem.invoice_no
										GROUP BY DATE(Invoice.purchase_time);");
			$qry->execute();
			return $qry;
		}
		
		public function filterSalesByDayByDate($start_date, $end_date){
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT DATE(Invoice.purchase_time) AS date,
										SUM(InvoiceItem.unit_price*InvoiceItem.quantity) AS total_sale, SUM(InvoiceItem.unit_profit*InvoiceItem.quantity) AS total_profit, SUM(InvoiceItem.quantity) AS total_quantity
										FROM InvoiceItem, Invoice
										WHERE Invoice.invoice_no=InvoiceItem.invoice_no
										AND Invoice.purchase_time BETWEEN :start_date AND :end_date
										GROUP BY DATE(Invoice.purchase_time);");
			$qry->bindParam(":start_date",$start_date);
			$qry->bindParam(":end_date",$end_date);
			$qry->execute();
			return $qry;
		}
		
		public function getSalesByHour(){
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT HOUR(Invoice.purchase_time) AS hour,
										SUM(InvoiceItem.unit_price*InvoiceItem.quantity) AS total_sale, SUM(InvoiceItem.unit_profit*InvoiceItem.quantity) AS total_profit, SUM(InvoiceItem.quantity) AS total_quantity
										FROM InvoiceItem, Invoice
										WHERE Invoice.invoice_no=InvoiceItem.invoice_no
										GROUP BY HOUR(Invoice.purchase_time);");
			$qry->execute();
			return $qry;
		}
		
		public function filterSalesByHourByDate($start_date, $end_date){
			$dbcon = new connect();
			$qry = $dbcon->db1->prepare("SELECT HOUR(Invoice.purchase_time) AS hour,
										SUM(InvoiceItem.unit_price*InvoiceItem.quantity) AS total_sale, SUM(InvoiceItem.unit_profit*InvoiceItem.quantity) AS total_profit, SUM(InvoiceItem.quantity) AS total_quantity
										FROM InvoiceItem, Invoice
										WHERE Invoice.invoice_no=InvoiceItem.invoice_no
										AND Invoice.purchase_time BETWEEN :start_date AND :end_date
										GROUP BY HOUR(Invoice.purchase_time);");
			$qry->bindParam(":start_date",$start_date);
			$qry->bindParam(":end_date",$end_date);
			$qry->execute();
			return $qry;
		}		
	}

?>