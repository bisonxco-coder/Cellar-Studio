<?php
declare(strict_types=1);

/**
 * Zoho CRM v3 integration (OAuth2 refresh token flow).
 *
 * Expected constants (optional; define in wp-config.php or server env):
 * - CELLAR_ZOHO_DC            (e.g. 'EU', 'US')
 * - CELLAR_ZOHO_CLIENT_ID
 * - CELLAR_ZOHO_CLIENT_SECRET
 * - CELLAR_ZOHO_REFRESH_TOKEN (optional if we store token via callback)
 * Optional:
 * - CELLAR_ZOHO_LEAD_SOURCE   (default 'Website')
 */

function cellar_studio_zoho_get_refresh_token(): string {
	$opt = get_option('cellar_zoho_refresh_token');
	if (is_string($opt) && $opt !== '') {
		return $opt;
	}

	if (defined('CELLAR_ZOHO_REFRESH_TOKEN')) {
		return (string) CELLAR_ZOHO_REFRESH_TOKEN;
	}

	return '';
}

function cellar_studio_zoho_is_configured(): bool {
	$refreshToken = cellar_studio_zoho_get_refresh_token();
	return defined('CELLAR_ZOHO_DC')
		&& defined('CELLAR_ZOHO_CLIENT_ID')
		&& defined('CELLAR_ZOHO_CLIENT_SECRET')
		&& (string) CELLAR_ZOHO_DC !== ''
		&& (string) CELLAR_ZOHO_CLIENT_ID !== ''
		&& (string) CELLAR_ZOHO_CLIENT_SECRET !== ''
		&& $refreshToken !== '';
}

/**
 * @return array{accounts:string, api:string}
 */
function cellar_studio_zoho_domains(): array {
	$dc = strtoupper((string) (defined('CELLAR_ZOHO_DC') ? CELLAR_ZOHO_DC : ''));

	// Zoho's default is US when dc is missing; we explicitly require it in config,
	// but keep safe fallbacks here.
	if ($dc === 'EU') {
		return ['accounts' => 'https://accounts.zoho.eu', 'api' => 'https://www.zohoapis.eu'];
	}
	if ($dc === 'IN') {
		return ['accounts' => 'https://accounts.zoho.in', 'api' => 'https://www.zohoapis.in'];
	}
	if ($dc === 'AU') {
		return ['accounts' => 'https://accounts.zoho.com.au', 'api' => 'https://www.zohoapis.com.au'];
	}
	if ($dc === 'JP') {
		return ['accounts' => 'https://accounts.zoho.jp', 'api' => 'https://www.zohoapis.jp'];
	}
	if ($dc === 'CN') {
		return ['accounts' => 'https://accounts.zoho.com.cn', 'api' => 'https://www.zohoapis.com.cn'];
	}

	// US
	return ['accounts' => 'https://accounts.zoho.com', 'api' => 'https://www.zohoapis.com'];
}

function cellar_studio_zoho_get_access_token(): string {
	$cached = get_transient('cellar_zoho_access_token');
	if (is_string($cached) && $cached !== '') {
		return $cached;
	}

	return cellar_studio_zoho_refresh_access_token();
}

function cellar_studio_zoho_refresh_access_token(): string {
	if (!cellar_studio_zoho_is_configured()) {
		throw new RuntimeException('Zoho CRM is not configured.');
	}

	$domains = cellar_studio_zoho_domains();
	$url = $domains['accounts'] . '/oauth/v2/token';

	$response = wp_remote_post($url, [
		'timeout' => 15,
		'headers' => ['Accept' => 'application/json'],
		'body' => [
			'refresh_token' => cellar_studio_zoho_get_refresh_token(),
			'client_id' => (string) CELLAR_ZOHO_CLIENT_ID,
			'client_secret' => (string) CELLAR_ZOHO_CLIENT_SECRET,
			'grant_type' => 'refresh_token',
		],
	]);

	if (is_wp_error($response)) {
		throw new RuntimeException('Zoho token request failed: ' . $response->get_error_message());
	}

	$code = (int) wp_remote_retrieve_response_code($response);
	$raw = (string) wp_remote_retrieve_body($response);
	$data = json_decode($raw, true);

	if ($code < 200 || $code >= 300 || !is_array($data) || !isset($data['access_token'])) {
		$msg = is_array($data) && isset($data['error']) ? (string) $data['error'] : 'unknown_error';
		throw new RuntimeException('Zoho token response invalid: ' . $msg);
	}

	$token = (string) $data['access_token'];
	$expiresIn = isset($data['expires_in_sec']) ? (int) $data['expires_in_sec'] : 3600;
	$ttl = max(60, $expiresIn - 120); // refresh a bit before expiry

	set_transient('cellar_zoho_access_token', $token, $ttl);
	return $token;
}

/**
 * Create a Lead in Zoho CRM.
 *
 * @param array{name:string, phone:string, phone_prefix:string, email:string, message:string, page:string, source?:string} $form
 * @return array The decoded Zoho response (best-effort).
 */
function cellar_studio_zoho_create_lead(array $form): array {
	if (!cellar_studio_zoho_is_configured()) {
		throw new RuntimeException('Zoho CRM is not configured.');
	}

	$domains = cellar_studio_zoho_domains();
	$url = $domains['api'] . '/crm/v3/Leads';

	$leadSource = defined('CELLAR_ZOHO_LEAD_SOURCE') && (string) CELLAR_ZOHO_LEAD_SOURCE !== ''
		? (string) CELLAR_ZOHO_LEAD_SOURCE
		: 'Website';

	$fullPhone = trim((string) $form['phone_prefix'] . ' ' . (string) $form['phone']);
	$source = isset($form['source']) ? (string) $form['source'] : '';
	$propertyType = isset($form['property_type']) ? (string) $form['property_type'] : '';
	$location = isset($form['location']) ? (string) $form['location'] : '';
	$descriptionParts = [];
	if ($source !== '') {
		$descriptionParts[] = "Service: " . $source;
	}
	if ($propertyType !== '') {
		$descriptionParts[] = "Property type: " . $propertyType;
	}
	if ($location !== '') {
		$descriptionParts[] = "Location: " . $location;
	}
	if ((string) $form['message'] !== '') {
		$descriptionParts[] = "Project:\n" . (string) $form['message'];
	}
	if ((string) $form['page'] !== '') {
		$descriptionParts[] = "Page: " . (string) $form['page'];
	}
	$description = trim(implode("\n\n", $descriptionParts));

	$lead = [
		// Zoho Leads requires Last_Name. We store "Full Name" here since the form has one name field.
		'Last_Name' => (string) $form['name'],
		'Email' => (string) $form['email'],
		'Phone' => $fullPhone,
		'Lead_Source' => $leadSource,
		'Description' => $description,
	];
	if ($location !== '') {
		$lead['City'] = $location;
	}

	$payload = [
		'data' => [$lead],
	];

	$token = cellar_studio_zoho_get_access_token();
	$result = cellar_studio_zoho_post_json($url, $payload, $token);

	// If token expired/invalid, refresh once and retry.
	if ($result['http_code'] === 401) {
		delete_transient('cellar_zoho_access_token');
		$token = cellar_studio_zoho_refresh_access_token();
		$result = cellar_studio_zoho_post_json($url, $payload, $token);
	}

	cellar_studio_zoho_assert_lead_created($result);

	return is_array($result['json']) ? $result['json'] : [];
}

/**
 * Zoho often returns HTTP 200/201 even when the record was not created.
 *
 * @param array{http_code:int, raw:string, json:mixed} $result
 */
function cellar_studio_zoho_assert_lead_created(array $result): void {
	if ($result['http_code'] < 200 || $result['http_code'] >= 300) {
		$err = is_array($result['json']) ? wp_json_encode($result['json']) : (string) $result['raw'];
		throw new RuntimeException('Zoho lead create failed (' . $result['http_code'] . '): ' . $err);
	}

	$json = $result['json'];
	if (!is_array($json) || !isset($json['data']) || !is_array($json['data']) || $json['data'] === []) {
		throw new RuntimeException('Zoho lead create failed: empty response.');
	}

	$record = $json['data'][0] ?? null;
	if (!is_array($record)) {
		throw new RuntimeException('Zoho lead create failed: invalid response payload.');
	}

	$status = strtolower((string) ($record['status'] ?? ''));
	if ($status !== 'success') {
		$code = (string) ($record['code'] ?? 'UNKNOWN');
		$message = (string) ($record['message'] ?? 'Lead was not created.');
		throw new RuntimeException('Zoho lead create failed [' . $code . ']: ' . $message);
	}
}

/**
 * @param array $payload
 * @return array{http_code:int, raw:string, json:mixed}
 */
function cellar_studio_zoho_post_json(string $url, array $payload, string $accessToken): array {
	$response = wp_remote_post($url, [
		'timeout' => 15,
		'headers' => [
			'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
			'Content-Type' => 'application/json; charset=utf-8',
			'Accept' => 'application/json',
		],
		'body' => wp_json_encode($payload),
	]);

	if (is_wp_error($response)) {
		return ['http_code' => 0, 'raw' => $response->get_error_message(), 'json' => null];
	}

	$httpCode = (int) wp_remote_retrieve_response_code($response);
	$raw = (string) wp_remote_retrieve_body($response);
	$json = json_decode($raw, true);
	return ['http_code' => $httpCode, 'raw' => $raw, 'json' => $json];
}

function cellar_studio_zoho_callback_redirect_uri(): string {
	// Must match the Redirect URI configured in Zoho.
	return home_url('/wp-json/cellar-studio/v1/zoho/callback');
}

function cellar_studio_zoho_authorization_url(string $state): string {
	$domains = cellar_studio_zoho_domains();
	$url = $domains['accounts'] . '/oauth/v2/auth';

	$scope = 'ZohoCRM.modules.leads.CREATE,ZohoCRM.modules.leads.READ,offline_access';

	$query = [
		'client_id' => (string) CELLAR_ZOHO_CLIENT_ID,
		'response_type' => 'code',
		'scope' => $scope,
		'redirect_uri' => cellar_studio_zoho_callback_redirect_uri(),
		'access_type' => 'offline',
		'state' => $state,
	];

	return $url . '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
}

function cellar_studio_zoho_exchange_code_for_refresh_token(string $code): array {
	if (!defined('CELLAR_ZOHO_CLIENT_ID') || !defined('CELLAR_ZOHO_CLIENT_SECRET')) {
		throw new RuntimeException('Zoho CRM is not configured (missing client id/secret).');
	}

	$domains = cellar_studio_zoho_domains();
	$url = $domains['accounts'] . '/oauth/v2/token';

	$response = wp_remote_post($url, [
		'timeout' => 15,
		'headers' => ['Accept' => 'application/json'],
		'body' => [
			'code' => $code,
			'client_id' => (string) CELLAR_ZOHO_CLIENT_ID,
			'client_secret' => (string) CELLAR_ZOHO_CLIENT_SECRET,
			'redirect_uri' => cellar_studio_zoho_callback_redirect_uri(),
			'grant_type' => 'authorization_code',
		],
	]);

	if (is_wp_error($response)) {
		throw new RuntimeException('Zoho code exchange failed: ' . $response->get_error_message());
	}

	$httpCode = (int) wp_remote_retrieve_response_code($response);
	$raw = (string) wp_remote_retrieve_body($response);
	$json = json_decode($raw, true);
	return ['http_code' => $httpCode, 'raw' => $raw, 'json' => $json];
}

