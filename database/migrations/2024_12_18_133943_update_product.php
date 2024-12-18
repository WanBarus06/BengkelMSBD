<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE PROCEDURE UpdateProduct(
            IN p_product_id INT,
            IN p_product_name VARCHAR(255),
            IN p_product_description TEXT,
            IN p_size_id INT,
            IN p_brand_id INT,
            IN p_variant_id INT,
            IN p_warning_stock INT,
            IN p_product_sell_price INT,
            IN p_stock INT
        )
        BEGIN
            DECLARE descriptionId INT;
            DECLARE EXIT HANDLER FOR SQLEXCEPTION
                ROLLBACK;


            START TRANSACTION;

            -- Update nama produk di tabel products
            UPDATE products
            SET product_name = p_product_name
            WHERE product_id = p_product_id;

            -- Ambil description_id dari tabel product_descriptions
            SELECT description_id INTO descriptionId
            FROM products
            WHERE product_id = p_product_id
            LIMIT 1;

            -- Update deskripsi produk, ukuran, merek, dan varian di product_descriptions dengan menggunakan description_id
            UPDATE product_descriptions
            SET product_description = p_product_description, size_id = p_size_id, brand_id = p_brand_id, variant_id = p_variant_id
            WHERE description_id = descriptionId;

            -- Update stok produk di product_stock
            UPDATE product_details
            SET stock = p_stock, warning_stock = p_warning_stock, product_sell_price = p_product_sell_price
            WHERE product_id = p_product_id;

            COMMIT;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateProduct');
    }
};
