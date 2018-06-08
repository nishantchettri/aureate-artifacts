<?php
	session_start();
	include_once("../class/invoice.class.php");
	include_once("../class/checkout.class.php");
	include_once("../class/promotions.class.php");
	include_once('validateUser.php');
	
	$customer_id = $_SESSION['customer_id'];
	
	// In YES was selected in confirm.php page
	if(isset($_POST['yes'])){
		// Incoming values
		$payment_type = $_POST['payment_type'];
		$payment_number = $_POST['payment_number'];
		$courier = $_POST['courier'];
		$employee_id = 00000000000;

		// Create Invoice Object
		// Insert into Invoice Table
		$invoice = new invoice();
		$insertVal = $invoice->insertInvoiceList($customer_id, $courier, $payment_type, $purchase_type, $payment_number);
		$returnVal = $insertVal[0];
		$invoice_no = $insertVal[1];
		
		// Check if Insert was successful or not
		if($returnVal->rowCount() > 0){
			$checkout = new checkout();
			$getCart = $checkout->getCartListByID($customer_id);
			
			// Insert each item from cart to invoice item table
			foreach($getCart as $cartItem){
				$artifact_id = $cartItem['artifact_id'];
				$qty = $cartItem['quantity'];
				$unit_price = $cartItem['retail_price'];
				$request = $cartItem['request'];
				
				$promotionDAO = new promotions();
				$promotionRow = $promotionDAO->hasPromotion($artifact_id);
				
				// Check if promotion on item exists
				if($promotionRow->rowCount() > 0){
					$newPrice = $promotionRow->fetch();
					$unit_price = $newPrice['new_price'];
				}
				
				// Insert Checkout list items to invoice item table									
				$invoiceitem = new invoice();
				$insertInvoiceItem = $invoiceitem->insertInvoiceItemList($invoice_no, $artifact_id, $qty, $unit_price);
				
				// Check if items were moved from cart to invoice
				if($insertInvoiceItem->rowCount() == 0){
					header('location:checkout.php?err=item');
					exit();
				}
				
				if(!empty(trim($request))){
					$invoiceCustomize = new invoice();
					$insertRequest = $invoiceCustomize->insertInvoiceRequest($invoice_no, $artifact_id, $request);
					// Check if requests were placed in invoicecustomize table
					if($insertRequest->rowCount() == 0){
						header('location:checkout.php?err=request');
						exit();
					}		
				}
			}		
			$deleteCheckout = new checkout();
			$emptyCart = $deleteCheckout->deleteCartByID($customer_id);
			if($emptyCart->rowCount()>0){
				header('location:purchase_history.php?add=conf');
				exit();
			} else{
				header('location:checkout.php?err=cart');
				exit();
			}
		} else {
			header('location:checkout.php?err=1');
			exit();
		}
	} else if (isset($_POST['no'])){
		header('location:checkout.php');
		exit();
	}
?>