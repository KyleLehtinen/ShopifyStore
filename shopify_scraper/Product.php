<?php

/*
This is my Product class which will be used as a vehicle to save
scraped data to both a csv file and as a new record in my sql table.
The design is based on Shopify's csv reqs minus SEO meta data (as this project
doesn't call for it, but it can be added in later if needed). 

The idea is to have the scraper logic accrue relavent information for a product,
instantiate that data into a new Product object, then call the methods that handle
saving and inserting the data.

This code is subject to change as development needs are assessed. 

Thoughts to improve this include:
- importing an ORM like Eloquent or something else that uses the database table
schema to create an object. As it is now the constructor is large and unwieldy,
and default valued arguments must be placed at the end which further complicates
the order of parameters must be fed in.
- This approach has a high chance to be unwieldy in later development but I won't really
know till I try to use it.
*/

class Product {
	
	public $handle, $title, $body_html, $vendor, $type, $tags, $published,
	$option1_name, $option1_value, $option2_name, $option2_value,
	$option3_name, $option3_value, $variant_sku, $variant_grams, 
	$variant_inv_tracker, $variant_inv_qty, $variant_inv_policy,
	$variant_fulfillment_service, $variant_price, $variant_comp_price,
	$variant_req_shipping, $variant_taxable, $variant_barcode,
	$image_src, $image_alt_text, $gift_card, $google_shop_mpn, $google_shop_age_group
	$google_shop_gender, $google_shop_product_category, $seo_title, $seo_description, $google_shop_adword_grouping,
	$google_shop_adword_labels, $google_shop_condition, $google_shop_custom_product,
	$google_shop_custom_label_0, $google_shop_custom_label_1, $google_shop_custom_label_2,
	$google_shop_custom_label_3, $google_shop_custom_label_4, $variant_img, $variant_weight_unit, $collection;

	
	/*
	Default variable values are set at the end of the argument list where an argument is set equal to '' or false.
	The idea is that when the constructor is called if an optional argument is left blank
	*/
	public function __construct($handle,
								$image_src, 
								$title = '',
								$body_html = '',
								$vendor = '',
								$type = '',
								$published = 0,
								$option1_name = '',
								$option1_value = '', 
								$variant_grams = null, 
								$variant_inv_qty = null, 
								$variant_inv_policy = '',
								$variant_fulfillment_service = '', 
								$variant_price = null, 
								$variant_comp_price = null,
								$gift_card = '', 
								$variant_img = '', 
								$variant_weight_unit = '',
								$tags = '',
								$option2_name = '', 
								$option2_value = '',
								$option3_name = '', 
								$option3_value = '', 
								$variant_sku = '', 
								$variant_inv_tracker = '',
								$variant_req_shipping = false, 
								$variant_taxable = false, 
								$variant_barcode = '',
								$image_alt_text = '',
								$google_shop_mpn = '', 
								$google_shop_age_group = '',
								$google_shop_gender = '', 
								$google_shop_product_category = '', 
								$seo_title = '', 
								$seo_description = '', 
								$google_shop_adword_grouping = '',
								$google_shop_adword_labels = '', 
								$google_shop_condition = '', 
								$google_shop_custom_product = '',
								$google_shop_custom_label_0 = '', 
								$google_shop_custom_label_1 = '', 
								$google_shop_custom_label_2 = '',
								$google_shop_custom_label_3 = '', 
								$google_shop_custom_label_4 = '',
								$collection = '') 
	{
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
		$this->google_shop_mpn = $google_shop_mpn; 
		$this->google_shop_age_group = $google_shop_age_group;
		$this->google_shop_gender = $google_shop_gender; 
		$this->google_shop_product_category = $google_shop_product_category; 
		$this->seo_title = $seo_title; 
		$this->seo_description = $seo_description; 
		$this->google_shop_adword_grouping = $google_shop_adword_grouping;
		$this->google_shop_adword_labels = $google_shop_adword_labels; 
		$this->google_shop_condition = $google_shop_condition; 
		$this->google_shop_custom_product = $google_shop_custom_product;
		$this->google_shop_custom_label_0 = $google_shop_custom_label_0; 
		$this->google_shop_custom_label_1 = $google_shop_custom_label_1; 
		$this->google_shop_custom_label_2 = $google_shop_custom_label_2;
		$this->google_shop_custom_label_3 = $google_shop_custom_label_3; 
		$this->google_shop_custom_label_4 = $google_shop_custom_label_4; 
		$this->variant_img = $variant_img; 
		$this->variant_weight_unit = $variant_weight_unit;
		$this->collection = $collection;
	}

	//Method used to insert this record in to the db
	public function saveToDB() {
		//Use PDO connection to get to my database
		try {
			$db = new PDO('mysql:host=localhost;dbname=WholeSaleFloorsAndMore;charset=utf8';'root','');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $db->prepare("INSERT 
								   INTO ShopifyImportMaster 
								    (	handle, title, 'Body (HTML)', vendor, type, tags, published,
										'Option1 Name', 'Option1 Value', 'Option2 Name', 'Option2 Value',
										'Option3 Name', 'Option3 Value', 'Variant SKU', 'Variant Grams', 
										'Variant Inventory Tracker', 'Variant Inventory Qty', 'Variant Inventory Policy',
										'Variant Fulfillment Service', 'Variant Price', 'Variant Compare At Price',
										'Variant Requires Shipping', 'Variant Taxable', 'Variant Barcode',
										'Image Src', 'Image Alt Text', 'Gift Card', 'Google Shopping / MPN', 	
										'Google Shopping / Age Group', 'Google Shopping / Gender',	'Google Shopping / Google Product Category',
										'SEO Title', 'SEO Description', 'Google Shopping / AdWords Grouping', 'Google Shopping / AdWords Labels',
										'Google Shopping / Condition', 'Google Shopping / Custom Product', 'Google Shopping / Custom Label 0',
										'Google Shopping / Custom Label 1', 'Google Shopping / Custom Label 2', 'Google Shopping / Custom Label 3',	
										'Google Shopping / Custom Label 4', Variant Image', 'Variant Weight Unit', 'collection') 
									values 
									(	:handle, :title, :body_html, :vendor, :type, :tags, :published,
										:option1_name, :option1_value, :option2_name, :option2_value,
										:option3_name, :option3_value, :variant_sku, :variant_grams, 
										:variant_inv_tracker, :variant_inv_qty, :variant_inv_policy,
										:variant_fulfillment_service, :variant_price, :variant_comp_price,
										:variant_req_shipping, :variant_taxable, :variant_barcode,
										:image_src, :image_alt_text, :gift_card, :google_shop_mpn, :google_shop_age_group
										:google_shop_gender, :google_shop_product_category, :seo_title, :seo_description, 
										:google_shop_adword_grouping, :google_shop_adword_labels, :google_shop_condition, 
										:google_shop_custom_product,:google_shop_custom_label_0, :google_shop_custom_label_1, 
										:google_shop_custom_label_2,:google_shop_custom_label_3, :google_shop_custom_label_4,
										:variant_img, :variant_weight_unit, :collection)");
			
			$query->execute(['handle'=>$this->handle, 
							 'title'=>$this->title, 
							 'body_html'=>$this->body_html, 
							 'vendor'=>$this->vendor, 
							 'type'=>$this->type, 
							 'tags'=>$this->tags, 
							 'published'=>$this->published,
							 'option1_name'=>$this->option1_name, 
							 'option1_value'=>$this->option1_value, 
							 'option2_name'=>$this->option2_name, 
							 'option2_value'=>$this->option2_value ,
							 'option3_name'=>$this->option3_name, 
							 'option3_value'=>$this->option3_value, 
							 'variant_sku'=>$this->variant_sku, 
							 'variant_grams'=>$this->variant_grams, 
							 'variant_inv_tracker'=>$this->variant_inv_tracker, 
							 'variant_inv_qty'=>$this->variant_inv_qty, 
							 'variant_inv_policy'=>$this->variant_inv_policy,
							 'variant_fulfillment_service'=>$this->variant_fulfillment_service, 
							 'variant_price'=>$this->variant_price, 
							 'variant_comp_price'=>$this->variant_comp_price,
							 'variant_req_shipping'=>$this->variant_req_shipping, 
							 'variant_taxable'=>$this->variant_taxable, 
							 'variant_barcode'=>$this->variant_barcode,
							 'image_src'=>$this->image_src, 
							 'image_alt_text'=>$this->image_alt_text, 
							 'gift_card'=>$this->gift_card,
							 'google_shop_mpn'=>$this->google_shop_mpn, 
							 'google_shop_age_group'=>$this->google_shop_age_group,
							 'google_shop_gender'=>$this->google_shop_gender, 
							 'google_shop_product_category'=>$this->google_shop_product_category, 
							 'seo_title'=>$this->seo_title, 
							 'seo_description'=>$this->seo_description, 
							 'google_shop_adword_grouping'=>$this->google_shop_adword_grouping,
							 'google_shop_adword_labels'=>$this->google_shop_adword_labels, 
							 'google_shop_condition'=>$this->google_shop_condition, 
							 'google_shop_custom_product'=>$this->google_shop_custom_product,
							 'google_shop_custom_label_0'=>$this->google_shop_custom_label_0, 
							 'google_shop_custom_label_1'=>$this->google_shop_custom_label_1, 
							 'google_shop_custom_label_2'=>$this->google_shop_custom_label_2,
							 'google_shop_custom_label_3'=>$this->google_shop_custom_label_3,
							 'google_shop_custom_label_4'=>$this->google_shop_custom_label_4,
							 'variant_img'=>$this->variant_img, 
							 'variant_weight_unit'=>$this->variant_weight_unit,
							 'collection'=>$this->collection]);
		
		} catch (PDOException $e) {
			die($e->getMessage());	
		}
	}

	//method to save current instantiation as a line in a csv, creates csv if not found
	public function saveToCSV($filename) {
		
		//check if csv specified exists and create if not
		if (!@fopen($filename, 'a')) {
			createCSV($filename);
		}

		//structure of array, formatted per schema outlined in createCSV
		$line = [];
		$line[] = $this->handle; 
		$line[] = $this->title; 
		$line[] = $this->body_html; 
		$line[] = $this->vendor; 
		$line[] = $this->type; 
		$line[] = $this->tags; 
		$line[] = $this->published;
		$line[] = $this->option1_name; 
		$line[] = $this->option1_value; 
		$line[] = $this->option2_name; 
		$line[] = $this->option2_value;
		$line[] = $this->option3_name; 
		$line[] = $this->option3_value; 
		$line[] = $this->variant_sku; 
		$line[] = $this->variant_grams; 
		$line[] = $this->variant_inv_tracker; 
		$line[] = $this->variant_inv_qty; 
		$line[] = $this->variant_inv_policy;
		$line[] = $this->variant_fulfillment_service; 
		$line[] = $this->variant_price; 
		$line[] = $this->variant_comp_price;
		$line[] = $this->variant_req_shipping; 
		$line[] = $this->variant_taxable; 
		$line[] = $this->variant_barcode;
		$line[] = $this->image_src; 
		$line[] = $this->image_alt_text; 
		$line[] = $this->gift_card;
		$line[] = $this->google_shop_mpn;
		$line[] = $this->google_shop_age_group;
		$line[] = $this->google_shop_gender;
		$line[] = $this->google_shop_product_category;
		$line[] = $this->seo_title;
		$line[] = $this->seo_description;
		$line[] = $this->google_shop_adword_grouping;
		$line[] = $this->google_shop_adword_labels;
		$line[] = $this->google_shop_condition;
		$line[] = $this->google_shop_custom_product;
		$line[] = $this->google_shop_custom_label_0;
		$line[] = $this->google_shop_custom_label_1;
		$line[] = $this->google_shop_custom_label_2;
		$line[] = $this->google_shop_custom_label_3;
		$line[] = $this->google_shop_custom_label_4;
		$line[] = $this->variant_img; 
		$line[] = $this->variant_weight_unit;
		$line[] = $this->collection;
		
		//logic that opens a file, saves the array to a line in the file, and closesa
		$csv = fopen($filename, 'a') or die("Unable to open the file!");
		fputcsv($csv, $line);
		fclose($csv);
	}

	//creates csv file for storing scraped information
	public function createCSV($filename) {
		$csv = fopen($filename, "w") or die("Unable to open file!");
		fwrite($csv, "Handle,	
					  Title,	
					  'Body (HTML)',
					  Vendor,	
					  Type,
					  Tags,
					  Published,
					  'Option1 Name',
					  'Option1 Value',
					  'Option2 Name',
					  'Option2 Value',
					  'Option3 Name',
					  'Option3 Value',
					  'Variant SKU',
					  'Variant Grams',
					  'Variant Inventory Tracker',
					  'Variant Inventory Qty',
					  'Variant Inventory Policy',
					  'Variant Fulfillment Service',
					  'Variant Price',
					  'Variant Compare At Price',
					  'Variant Requires Shipping',
					  'Variant Taxable',
					  'Variant Barcode',
					  'Image Src',
					  'Image Alt Text',
					  'Gift Card',
					  'Google Shopping / MPN',
					  'Google Shopping / Age Group',
					  'Google Shopping / Gender',
					  'Google Shopping / Google Product Category',
					  'SEO Title',
					  'SEO Description',
					  'Google Shopping / AdWords Grouping',
					  'Google Shopping / AdWords Labels',
					  'Google Shopping / Condition',
					  'Google Shopping / Custom Product',
					  'Google Shopping / Custom Label 0',
					  'Google Shopping / Custom Label 1',
					  'Google Shopping / Custom Label 2',
					  'Google Shopping / Custom Label 3',
					  'Google Shopping / Custom Label 4',
					  'Variant Image',
					  'Variant Weight Unit',
					  'collection'" . PHP_EOL);
		fclose($csv);
	}
}