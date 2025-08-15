 is available, null otherwise.
	 */
	private function fetch_new_woocommerce_version() {
		$plugin_updates = SafeGlobalFunctionProxy::get_plugin_updates();

		// Check if WooCommerce plugin update information is available.
		if ( ! is_array( $plugin_updates ) || ! isset( $plugin_updates[ WC_PLUGIN_BASENAME ] ) ) {
			return null;
		}

		$wc_plugin_update = $plugin_updates[ WC_PLUGIN_BASENAME ];

		// Ensure the update object exists and has the required information.
		if ( ! $wc_plugin_update || ! isset( $wc_plugin_update->update->new_version ) ) {
			return null;
		}

		$new_version = $wc_plugin_update->update->new_version;
		return is_string( $new_version ) ? $new_version : null;
	}

	/**
	 * Sanitize the content to exclude sensitive data.
	 *
	 * The trace is sanitized by:
	 *
	 * 1. Remove the absolute path to the plugin directory based on WC_ABSPATH. This is more accurate than using WP_PLUGIN_DIR when the plugin is symlinked.
	 * 2. Remove the absolute path to the WordPress root directory.
	 * 3. Redact potential user data such as email addresses and phone numbers.
	 *
	 * For example, the trace:
	 *
	 * /var/www/html/wp-content/plugins/woocommerce/includes/class-wc-remote-logger.php on line 123
	 * will be sanitized to: **\/woocommerce/includes/class-wc-remote-logger.php on line 123
	 *
	 * Additionally, any user data like email addresses or phone numbers will be redacted.
	 *
	 * @param string $content The content to sanitize.
	 *
	 * @return string The sanitized content.
	 */
	private function sanitize( $content ) {
		if ( ! is_string( $content ) ) {
			return $content;
		}

		$sanitized = $this->normalize_paths( $content );
		$sanitized = $this->redact_user_data( $sanitized );

		if ( ! function_exists( 'apply_filters' ) ) {
			require_once ABSPATH . WPINC . '/plugin.php';
		}

		/**
		 * Filter the sanitized log content before it's sent to the remote logging service.
		 *
		 * @since 9.5.0
		 *
		 * @param string $sanitized The sanitized content.
		 * @param string $content The original content.
		 */
		return apply_filters( 'woocommerce_remote_logger_sanitized_content', $sanitized, $content );
	}

	/**
	 * Normalize file paths by replacing absolute paths with relative ones.
	 *
	 * @param string $content The content containing paths to normalize.
	 *
	 * @return string The content with normalized paths.
	 */
	private function normalize_paths( string $content ): string {
		$plugin_path = StringUtil::normalize_local_path_slashes( trailingslashit( dirname( WC_ABSPATH ) ) );
		$wp_path     = StringUtil::normalize_local_path_slashes( trailingslashit( ABSPATH ) );

		return str_replace(
			array( $plugin_path, $wp_path ),
			array( './', './' ),
			$content
		);
	}

	/**
	 * Sanitize the error trace to exclude sensitive data.
	 *
	 * @param array|string $trace The error trace.
	 * @return string The sanitized trace.
	 */
	private function sanitize_trace( $trace ): string {
		if ( is_string( $trace ) ) {
			return $this->sanitize( $trace );
		}

		if ( ! is_array( $trace ) ) {
			return '';
		}

		$sanitized_trace = array_map(
			function ( $trace_item ) {
				if ( is_array( $trace_item ) && isset( $trace_item['file'] ) ) {
					$trace_item['file'] = $this->sanitize( $trace_item['file'] );
					return $trace_item;
				}

				return $this->sanitize( $trace_item );
			},
			$trace
		);

		$is_array_by_file = isset( $sanitized_trace[0]['file'] );
		if ( $is_array_by_file ) {
			return SafeGlobalFunctionProxy::wc_print_r( $sanitized_trace, true );
		}

		return implode( "\n", $sanitized_trace );
	}


	/**
	 * Redact potential user data from the content.
	 *
	 * @param string $content The content to redact.
	 * @return string The redacted message.
	 */
	private function redact_user_data( $content ) {
		// Redact email addresses.
		$content = preg_replace( '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', '[redacted_email]', $content );

		// Redact potential IP addresses.
		$content = preg_replace( '/\b(?:\d{1,3}\.){3}\d{1,3}\b/', '[redacted_ip]', $content );

		// Redact potential credit card numbers.
		$content = preg_replace( '/(\d{4}[- ]?){3}\d{4}/', '[redacted_credit_card]', $content );

		// API key redaction patterns.
		$api_patterns = array(
			'/\b[A-Za-z0-9]{32,40}\b/',                // Generic API key.
			'/\b[0-9a-f]{32}\b/i',                     // 32 hex characters.
			'/\b(?:[A-Z0-9]{4}-){3,7}[A-Z0-9]{4}\b/i', // Segmented API key (e.g., XXXX-XXXX-XXXX-XXXX).
			'/\bsk_[A-Za-z0-9]{24,}\b/i',              // Stripe keys (starts with sk_).
		);

		foreach ( $api_patterns as $pattern ) {
			$content = preg_replace( $pattern, '[redacted_api_key]', $content );
		}

		/**
		 * Redact potential phone numbers.
		 *
		 * This will match patterns like:
		 * +1 (123) 456 7890 (with parentheses around area code)
		 * +44-123-4567-890 (with area code, no parentheses)
		 * 1234567890 (10 consecutive digits, no area code)
		 * (123) 456-7890 (area code in parentheses, groups)
		 * +91 12345 67890 (international format with space)
		 */
		$content = preg_replace(
			'/(?:(?:\+?\d{1,3}[-\s]?)?\(?\d{3}\)?[-\s]?\d{3}[-\s]?\d{4}|\b\d{10,11}\b)/',
			'[redacted_phone]',
			$content
		);

		return $content;
	}

	/**
	 * Check if the current environment is development or local.
	 *
	 * Creates a helper method so we can easily mock this in tests.
	 *
	 * @return bool
	 */
	protected function is_dev_or_local_environment() {
		return in_array( SafeGlobalFunctionProxy::wp_get_environment_type() ?? 'production', array( 'development', 'local' ), true );
	}
	/**
	 * Sanitize the request URI to only allow certain query parameters.
	 *
	 * @param string $request_uri The request URI to sanitize.
	 * @return string The sanitized request URI.
	 */
	private function sanitize_request_uri( $request_uri ) {
		$default_whitelist = array(
			'path',
			'page',
			'step',
			'task',
			'tab',
			'section',
			'status',
			'post_type',
			'taxonomy',
			'action',
		);

		/**
		 * Filter to allow other plugins to whitelist request_uri query parameter values for unmasked remote logging.
		 *
		 * @since 9.4.0
		 *
		 * @param string   $default_whitelist The default whitelist of query parameters.
		 */
		$whitelist = apply_filters( 'woocommerce_remote_logger_request_uri_whitelist', $default_whitelist );

		$parsed_url = SafeGlobalFunctionProxy::wp_parse_url( $request_uri );
		if ( ! is_array( $parsed_url ) || ! isset( $parsed_url['query'] ) ) {
			return $request_uri;
		}

		parse_str( $parsed_url['query'], $query_params );

		foreach ( $query_params as $key => &$value ) {
			if ( ! in_array( $key, $whitelist, true ) ) {
				$value = 'xxxxxx';
			}
		}

		$parsed_url['query'] = http_build_query( $query_params );
		return $this->build_url( $parsed_url );
	}

	/**
	 * Build a URL from its parsed components.
	 *
	 * @param array $parsed_url The parsed URL components.
	 * @return string The built URL.
	 */
	private function build_url( $parsed_url ) {
		$path     = $parsed_url['path'] ?? '';
		$query    = isset( $parsed_url['query'] ) ? "?{$parsed_url['query']}" : '';
		$fragment = isset( $parsed_url['fragment'] ) ? "#{$parsed_url['fragment']}" : '';

		return "$path$query$fragment";
	}
}
