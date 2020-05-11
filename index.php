
<?php
require_once("inc/functions.php");
require_once("inc/conn.php");
// header('Access-Control-Allow-Origin: https://namrata-shakya.myshopify.com');


$requests = $_GET;
$hmac = $_GET['hmac'];
$serializeArray = serialize($requests);
$requests = array_diff_key($requests, array('hmac' => ''));
ksort($requests);

$parsedUrl = parse_url('https://'.$requests['shop']);
$host = explode('.', $parsedUrl['host']);
$subdomain = $host[0];

$shop = $subdomain;

$token = "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"; //access token 
$shopUrl='namrata-shakya.myshopify.com'; //shop-url

class ProductCreation
{

     function fetchProduct($token,$shop,$conn){

        $qry=mysqli_query($conn,"select * from product");

		while( $row = mysqli_fetch_assoc($qry) ){
		echo "<pre>";

		$title=$row['title']; 
		$img=$row['image']; 
		$compare_at_price= $row['compare_price']; 
		$price= $row['price']; 
		$body= $row['description']; 

		$productArr= array (
		          'product' => 
			            array (
			              'title' => $title,
			              'body_html' => $body,
			              // 'vendor' => $vendor,
			              // 'product_type' => ,$productType,
			              // 'handle'=> $handle,
			              // 'tags'=> $tags,
			              // 'published' => $published,
			              'images' => array (
				                         array (
				                          'src' => $img,
				                        ),
			                         ),
			              'variants' => array ( 
							              array (
							                 'price' => $price,
							                 // 'sku' => $sku,
		                //                      'barcode'=> $barcode,
							                 // 'taxable'=> $taxable,
							                 // 'inventory_quantity' => $inventory_quantity,
							                  'inventory_quantity' => 50,
							                 // 'inventory_management'=>$inventory_management,
							                  'inventory_management'=>'shopify',
							                 'compare_at_price'=> $compare_at_price,
							                ),
							             ),
							               
		                     ),
			            );

		$product = shopify_call($token, $shop, "/admin/api/2020-04/products.json", json_encode($productArr), 'POST',array("Content-Type: application/json"));

        $product = json_decode($product['response'], JSON_PRETTY_PRINT);
    
    
    	print_r($productArr);    
    	print_r($product);    
       
		}
     }
    
    
    
	function newProduct(){

			 // $productArr= array (
	   //            'product' => 
			 //            array (
			 //              'title' => 'Created New product Dark-Chocolate By App',
			 //              'body_html' => '<strong>Have A Good Day!</strong>',
			 //              'vendor' => 'Namrata',
			 //              'product_type' => 'Testing',
			 //              'handle'=>'Dark-Chocolate',
			 //              'tags'=> 'choco',
			 //              'published' => 'false',
			 //              'images' => array (
				//                          array (
				//                           'src' => 'https://www.snixykitchen.com/wp-content/uploads/2019/02/Dark-Chocolate-Honey-Walnut-Fig-Truffles-1-720x720.jpg',
				//                         ),
			 //                         ),
			 //              'variants' => array ( 
				// 			                array (
				// 			                  'option1' => 'almond',
				// 			                  'option2' => 'Dark',
				// 			                  // 'option3' =>  ,
				// 			                  'price' => 100.00,
				// 			                  'sku' => 'BA1015_ALMOND_XS',
    //                                        'barcode'=> 'ISBN00012',
				// 			                  'taxable'=> 'true',
				// 			                  'inventory_quantity' => 30,
				// 			                  'inventory_management'=>'shopify',
				// 			                  'compare_at_price'=> 120.00,
				// 			                ),
				// 			               array (
				// 			                  'option1' => 'cashew',
				// 			                  'option2' => 'white',
				// 			                  // 'option3' =>    ,
				// 			                  'price' => 120.00,
				// 			                  'sku' => 'BA1015_CASHEW_XS',
				// 			                  'barcode'=> 'ISBN00013',
				// 			                  'taxable'=> 'true',
				// 			                  'inventory_quantity' => 35,
				// 			                  'inventory_management'=>'shopify',
				// 			                  'compare_at_price'=> 140.00,
				// 			                ),
				// 			              ),
			 //              'options'=> array(
				// 		               array (
				// 		                      'name' => 'Flavor',
				// 		                      'values' => 
				// 	                          array (
				// 	                            0 => 'almond',
				// 	                            1 => 'cashew',
				// 	                             ),
				// 	                          ),
				// 		               array (
				// 	                          'name' => 'chocolate',
				// 	                          'values' => 
				// 	                          array (
				// 	                            0 => 'Dark',
				// 	                            1 => 'white',
				// 	                          ),
				// 		                     ),
				// 		               array (
				// 	                          'name' => 'option3',
				// 	                          'values' => 
				// 	                          array (
				// 	                            0 => 'value1',
				// 	                            1 => 'value2',
				// 	                          ),
				// 		                     ),
						               
				// 		                  ),

              //                   ),
			 //            );


	}
	
}

echo "<pre>";

$obj=new ProductCreation();
// $res=$obj->newProduct();

$res=$obj->fetchProduct($token,$shop,$conn);












