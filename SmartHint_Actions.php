<?php
//Insert script in all pages
add_action( 'wp_enqueue_scripts', 'smarthint_scripts_basic' );
function smarthint_scripts_basic()
{
	if (empty(get_option('smarthint_shcode'))){
		$data = get_smarthint_code();
		update_option('smarthint_shcode', $data);
	}

	if (!empty(get_option('smarthint_shcode'))){
		wp_register_script( 'custom-script', plugins_url( '/js/smarthint.js', __FILE__ ) );
		wp_register_script( 'custom-script', get_template_directory_uri() . '/js/smarthint.js' );
		wp_enqueue_script( 'custom-script' );
		$script_params = array('shcode' => get_option('smarthint_shcode'));
		wp_localize_script( 'custom-script', 'scriptParams', $script_params );
	}
}

function get_smarthint_code() {

	$new_account = array(
		'Domain' => get_option("siteurl")
	);
	
	$json = json_encode($new_account);
	$requestUrl = "https://admin.smarthint.co/Woocommerce/GetCode?domain=" . get_option("siteurl");
	$header = "User-Agent:MyAgent/1.0\r\n"
			. "Content-Type: application/json \r\n";

	$response = wp_remote_get( $requestUrl );
	if ( is_wp_error( $response ) ) {
		return false;
	}
	if ( is_array( $response ) ) {
		return $response['body']; // use the content
	}
}
?>