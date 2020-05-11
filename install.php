<?php
// Set variables for our request
$shop = $_GET['shop'];
$api_key = "bf77f5bad9fa492e2794aafb69e864e1";
$scopes = "read_products,write_products,write_script_tags,read_themes,write_themes,read_checkouts,write_checkouts";
$redirect_uri = "http://namrata.codingkloud.com/Add-Product/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();

