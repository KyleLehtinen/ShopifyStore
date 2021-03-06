-- drop/recreate database
DROP DATABASE IF EXISTS WholeSaleFloorsAndMore;
CREATE DATABASE WholeSaleFloorsAndMore;
USE WholeSaleFloorsAndMore;

-- Master Table for Shopify Import 
CREATE TABLE ShopifyImportMaster(
	id int AUTO_INCREMENT PRIMARY KEY,
	Handle varchar(255) NOT NULL,	
	Title varchar(255),	
	`Body (HTML)` varchar(255),
	Vendor varchar(255),	
	Type varchar(255),
	Tags varchar(255),
	Published BOOLEAN DEFAULT 0,
	`Option1 Name` varchar(255),
	`Option1 Value` varchar(255),
	`Option2 Name` varchar(255),	
	`Option2 Value` varchar(255),	
	`Option3 Name` varchar(255),
	`Option3 Value` varchar(255),
	`Variant SKU` varchar(255),
	`Variant Grams` int,
	`Variant Inventory Tracker` varchar(255),	
	`Variant Inventory Qty` int,
	`Variant Inventory Policy` varchar(255) default 'continue',
	`Variant Fulfillment Service` varchar(255),
	`Variant Price` int,
	`Variant Compare At Price` int,	
	`Variant Requires Shipping` boolean,
	`Variant Taxable` boolean,
	`Variant Barcode` varchar(255),
	`Image Src` varchar(255) NOT NULL,
	`Image Alt Text` varchar(255),
	`Gift Card` boolean default 0,
	`Google Shopping / MPN` varchar(255), 	
	`Google Shopping / Age Group` varchar(255),	
	`Google Shopping / Gender` varchar(255),	
	`Google Shopping / Google Product Category`	varchar(255),
	`SEO Title` varchar(70),
	`SEO Description` varchar(160),
	`Google Shopping / AdWords Grouping` varchar(255),
	`Google Shopping / AdWords Labels` varchar(255),
	`Google Shopping / Condition` varchar(255),	
	`Google Shopping / Custom Product` varchar(255),	
	`Google Shopping / Custom Label 0` varchar(255),
	`Google Shopping / Custom Label 1` varchar(255),	
	`Google Shopping / Custom Label 2` varchar(255),	
	`Google Shopping / Custom Label 3` varchar(255),	
	`Google Shopping / Custom Label 4` varchar(255),	
	`Variant Image` varchar(255),	
	`Variant Weight Unit` varchar(2),
	collection varchar(255)
);
