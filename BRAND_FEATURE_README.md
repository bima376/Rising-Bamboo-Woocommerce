# Fitur Brand untuk Widget WooCommerce Products

## Deskripsi
Fitur ini menambahkan opsi "Brand" ke dalam widget WooCommerce Products di Elementor, memungkinkan pengguna untuk menampilkan produk berdasarkan taxonomy `product_brand`.

## Perubahan yang Dibuat

### 1. File: `wp-content/plugins/rising-bamboo/inc/elementor/widgets/woo-products/class-products.php`

#### A. Menambahkan Opsi Brand ke Kontrol Type
```php
'options' => [
    'category' => __('Category', App::get_domain()),
    'brand'    => __('Brand', App::get_domain()),  // Baru ditambahkan
    'product'  => __('Product', App::get_domain()),
],
```

#### B. Menambahkan Kontrol Brands
```php
$this->add_control(
    $this->get_name_setting('brands'),
    [
        'label'          => __('Brands', App::get_domain()),
        'description'    => __('If no brand is selected, then all products will be shown.', App::get_domain()),
        'multiple'       => true,
        'type'           => RisingBambooElementorControl::SELECT2,
        'default'        => [],
        'select2options' => [
            'placeholder'        => __('Write Title Brand', App::get_domain()),
            'ajax'               => [
                'url'      => admin_url('admin-ajax.php') . '?action=rbb_get_brand&nonce=' . wp_create_nonce(App::get_nonce()),
                'dataType' => 'json',
                'delay'    => 500,
                'cache'    => 'true',
            ],
            'minimumInputLength' => 3,
        ],
        'condition'      => [
            $this->get_name_setting('type') => 'brand',
        ],
    ]
);
```

#### C. Memodifikasi Kontrol Limit
```php
'condition' => [
    $this->get_name_setting('type') => [ 'category', 'brand' ],  // Menambahkan 'brand'
],
```

#### D. Menambahkan Logika Brand di Method `get_product_data()`
```php
} elseif ( 'brand' === $type ) {
    $ids                = $this->get_value_setting('brands');
    $brands             = WoocommerceHelper::get_brands_by_ids($ids, 'include');
    $result['brands']   = [];
    foreach ( $brands as $brand ) {
        $result['brands'][ $brand->term_id ] = $brand->name;
    }
    $result['products'] = WoocommerceHelper::get_products(
        ( ! empty($result['brands']) ) ? array_key_first($result['brands']) : [], 
        'brand', 
        $order_by, 
        $order, 
        $limit
    );
}
```

### 2. File: `wp-content/plugins/rising-bamboo/inc/helper/class-woocommerce.php`

#### A. Menambahkan Method `get_brands_by_ids()`
```php
public static function get_brands_by_ids( $ids, string $oder_by = 'none', string $oder = 'ASC' ) {
    return get_terms(
        [
            'taxonomy' => 'product_brand',
            'include'  => (array) $ids,
            'orderby'  => $oder_by,
            'order'    => $oder,
        ]
    );
}
```

#### B. Memodifikasi Method `get_products()` untuk Mendukung Brand
```php
} elseif ( 'brand' === $by ) {
    $brands     = self::get_brands_by_ids($ids);
    $brand_slug = [];
    foreach ( $brands as $brand ) {
        $brand_slug[] = $brand->slug;
    }
    // Add brand filter to WC_Product_Query
    add_filter('woocommerce_product_object_query_args', function($query_args) use ($brand_slug) {
        if (!empty($brand_slug)) {
            $query_args['tax_query'][] = [
                'taxonomy' => 'product_brand',
                'field'    => 'slug',
                'terms'    => $brand_slug,
                'operator' => 'IN',
            ];
        }
        return $query_args;
    });
    $args['limit'] = $limit;
}
```

### 3. File: `wp-content/plugins/rising-bamboo/inc/elementor/class-ajax.php`

#### A. Menambahkan AJAX Handler untuk Brand
```php
add_action('wp_ajax_rbb_get_brand', [ $this, 'rbb_get_brand' ]); // nonce - ok.
add_action('wp_ajax_nopriv_rbb_get_brand', [ $this, 'rbb_get_brand' ]); // nonce - ok.
```

#### B. Menambahkan Method `rbb_get_brand()`
```php
public function rbb_get_brand(): void {
    $return = [];
    if ( ( check_ajax_referer(App::get_nonce(), 'nonce') ) ) {
        if ( isset($_POST['ids']) ) {
            $ids    = array_map('esc_attr', $_POST['ids']);
            $brands = WoocommerceHelper::get_brands_by_ids($ids, 'include');
            foreach ( $brands as $brand ) {
                $return[] = [
                    'id'   => $brand->term_id,
                    'text' => $brand->name . '(ID: ' . $brand->term_id . ')',
                ];
            }
        } elseif ( isset($_GET['q']) ) {
            $search_results = get_terms(
                [
                    'taxonomy'   => 'product_brand',
                    'name__like' => sanitize_text_field(wp_unslash($_GET['q'])),
                ]
            );
            if ( $search_results ) {
                foreach ( $search_results as $result ) {
                    $return[] = [
                        'id'   => $result->term_id,
                        'text' => $result->name . ' (ID:' . $result->term_id . ')',
                    ];
                }
            }
        }
    }
    wp_send_json([ 'results' => $return ]);
}
```

## Cara Penggunaan

1. **Buka Elementor Editor** dan tambahkan widget "Products"
2. **Pilih Type "Brand"** dari dropdown
3. **Pilih Brand** yang diinginkan (atau biarkan kosong untuk menampilkan semua produk)
4. **Atur pengaturan lainnya** seperti limit, ordering, dll.
5. **Preview dan Publish**

## Fitur

- **Multiple Brand Selection**: Dapat memilih lebih dari satu brand
- **AJAX Search**: Pencarian brand dengan AJAX untuk performa yang lebih baik
- **Fallback ke Semua Produk**: Jika tidak ada brand yang dipilih, akan menampilkan semua produk
- **Konsisten dengan Fitur Existing**: Menggunakan pola yang sama dengan opsi Category dan Product

## Dependensi

- Taxonomy `product_brand` harus sudah terdaftar di sistem
- WooCommerce Brands plugin atau custom taxonomy registration
- RisingBambooCore plugin framework

## Catatan

- Fitur ini memerlukan taxonomy `product_brand` yang sudah terdaftar
- Jika taxonomy brand belum ada, perlu didaftarkan terlebih dahulu
- Filter `woocommerce_product_object_query_args` digunakan untuk menambahkan dukungan brand ke WC_Product_Query
