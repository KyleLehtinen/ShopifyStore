<?php

class Product {
	
	public $handle, $title, $body_html, $vendor, $type, $tags, $published,
	$option1_name, $option1_value, $option2_name, $option2_value,
	$option3_name, $option3_value, $variant_sku, $variant_grams, 
	$variant_inv_tracker, $variant_inv_qty, $variant_inv_policy,
	$variant_fulfillment_service, $variant_price, $variant_comp_price,
	$variant_req_shipping, $variant_taxable, $variant_barcode,
	$image_src, $image_alt_text, $gift_card, $variant_img, $variant_weight_unit;

	

	public function __construct($handle, 
								$title,
								$body_html,
								$vendor,
								$type,
								$tags = '',
								$published,
								$option1_name,
								$option1_value, 
								$option2_name = '', 
								$option2_value = '',
								$option3_name = '', 
								$option3_value = '', 
								$variant_sku = '', 
								$variant_grams, 
								$variant_inv_tracker = '', 
								$variant_inv_qty, 
								$variant_inv_policy,
								$variant_fulfillment_service, 
								$variant_price, 
								$variant_comp_price,
								$variant_req_shipping = false, 
								$variant_taxable = false, 
								$variant_barcode = '',
								$image_src, 
								$image_alt_text = '', 
								$gift_card, 
								$variant_img, 
								$variant_weight_unit) {
		
		$this->handle = $handle; 
		$this->title = $title; 
		$this->body_html = $body_html; 
		$this->vendor = $vendor; 
		$this->type = $type; 
		$this->tags = $tags; 
		$this->published = $published;
		$this->option1_name = $option1_name; 
		$this->option1_value = $option1_value; 
		$this->option2_name = $option2_name; 
		$this->option2_value = $option2_value;
		$this->option3_name = $option3_name; 
		$this->option3_value = $option3_value; 
		$this->variant_sku = $variant_sku; 
		$this->variant_grams = $variant_grams; 
		$this->variant_inv_tracker = $variant_inv_tracker; 
		$this->variant_inv_qty = $variant_inv_qty; 
		$this->variant_inv_policy = $variant_inv_policy;
		$this->variant_fulfillment_service = $variant_fulfillent_service; 
		$this->variant_price = $variant_price; 
		$this->variant_comp_price = $variant_comp_price;
		$this->variant_req_shipping = $variant_req_shipping; 
		$this->variant_taxable = $variant_taxable; 
		$this->variant_barcode = $variant_barcode;
		$this->image_src = $image_src; 
		$this->image_alt_text = $image_alt_text; 
		$this->gift_card = $gift_card; 
		$this->variant_img = $variant_img; 
		$this->variant_weight_unit = $variant_weight_unit;
	}

	public function saveToDB() {
		try {
			$db = new PDO('mysql:host=localhost;dbname=WholeSaleFloorsAndMore;charset=utf8','root','');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// $query = $db->prepare("insert into MogMaster (name, img_url, src_url, rating, active) 
			// 	values (:name, :imgUrl, :srcUrl, :rating, :active)");
			// $query->execute(['name'=>$this->name, 'imgUrl'=>$this->imgUrl, 'srcUrl'=>$this->srcUrl, 'rating'=>$this->rating, 'active'=>$this->active]);
		} catch (PDOException $e) {
			die($e->getMessage());	
		}
	}

	public function saveToCSV($filename) {
		
		//structure of away
		// $line = [];
		// $line[] = $this->name;
		// $line[] = $this->srcUrl;
		// $line[] = $this->rating;
		// $line[] = $this->active;
		
		//logic that opens a file, saves the array to a line in the file, and closesa
		$csv = fopen($filename, 'a') or die("Unable to open the file!");
		fputcsv($csv, $line);
		fclose($csv);
	}
}