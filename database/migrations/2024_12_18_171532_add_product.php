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
        DB::unprepared("
        CREATE PROCEDURE InsertProduct(
            IN p_product_name VARCHAR(255),
            IN p_product_sell_price INT,
            IN p_warning_stock INT,
            IN p_variant_id INT,
            IN p_brand_id INT,
            IN p_size_id INT,
            IN p_description TEXT
        )
        BEGIN
            
            DECLARE v_description_id INT;
            DECLARE v_product_id INT;
            DECLARE EXIT HANDLER FOR SQLEXCEPTION
            BEGIN
                -- Rollback transaction on error
                ROLLBACK;
            END;

            START TRANSACTION;


            -- Insert into product_descriptions
            INSERT INTO product_descriptions (product_description, variant_id, brand_id, size_id, created_at, updated_at)
            VALUES (p_description, p_variant_id, p_brand_id, p_size_id, NOW(), NOW());
            SET v_description_id = LAST_INSERT_ID();

            -- Insert into products
            INSERT INTO products (product_name, description_id, created_at, updated_at)
            VALUES (p_product_name, v_description_id, NOW(), NOW());
            SET v_product_id = LAST_INSERT_ID();

            -- Insert into product_details
            INSERT INTO product_details (product_id, product_sell_price, stock, warning_stock, created_at, updated_at)
            VALUES (v_product_id, p_product_sell_price, 0, p_warning_stock, NOW(), NOW());

            -- Commit transaction on success
            COMMIT;
        END
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS InsertProduct");
    }
};
