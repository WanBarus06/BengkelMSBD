
DELIMITER $$
CREATE PROCEDURE `CompleteOrder`(IN cartId INT)
BEGIN
            DECLARE customerId INT;
            DECLARE approved_at TIMESTAMP;
            DECLARE salesRecordId INT;
            DECLARE insufficient_stock BOOLEAN DEFAULT FALSE;

            START TRANSACTION;

            SELECT user_id, NOW() INTO customerId, approved_at FROM carts WHERE id = cartId;

            IF customerId IS NULL THEN
                ROLLBACK;  -- Jika cart tidak ditemukan, rollback transaksi
            ELSE

                SELECT 
                    COUNT(*) 
                INTO insufficient_stock
                FROM cart_items ci
                JOIN product_details p ON ci.product_id = p.product_id
                WHERE ci.cart_id = cartId
                AND p.stock < ci.quantity;

                IF insufficient_stock > 0 THEN
                    ROLLBACK;
                ELSE
                    INSERT INTO sales_records (customer_id, is_fully_paid, created_at, updated_at)
                    VALUES (customerId, TRUE, NOW(), NOW());

                    SET salesRecordId = LAST_INSERT_ID();

                    INSERT INTO sales_record_details (sales_id, product_id, quantity, price_per_unit, created_at, updated_at)
                    SELECT 
                        salesRecordId, 
                        ci.product_id, 
                        ci.quantity, 
                        ci.price, 
                        NOW(), 
                        NOW()
                    FROM cart_items ci
                    WHERE ci.cart_id = cartId;

                    UPDATE product_details p
                    JOIN cart_items ci ON p.product_id = ci.product_id
                    SET p.stock = p.stock - ci.quantity
                    WHERE ci.cart_id = cartId;

                    UPDATE carts 
                    SET 
                        status = "Transaksi Selesai", 
                        approved_at = approved_at
                    WHERE id = cartId;

                    COMMIT;
                END IF;
            END IF;
        END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `ConfirmOrder`(IN cartId INT)
BEGIN
            DECLARE customerId INT;
            DECLARE approved_at TIMESTAMP;
            DECLARE pickupCode VARCHAR(50);

            START TRANSACTION;

            SELECT user_id, NOW() INTO customerId, approved_at FROM carts WHERE id = cartId;

            IF customerId IS NULL THEN
                ROLLBACK;  -- Jika cart tidak ditemukan, rollback transaksi
            ELSE
                SET pickupCode = CONCAT("PKP-", LEFT(UUID(), 8));  -- Contoh: PKP-xxxxxxxx

                UPDATE carts 
                SET 
                    status = "Menunggu Pengambilan", 
                    expired_at = DATE_ADD(approved_at, INTERVAL 2 DAY),
                    pickup_code = pickupCode,
                    updated_at = NOW() 
                WHERE id = cartId;

                IF ROW_COUNT() = 0 THEN
                    ROLLBACK;
                ELSE
                    UPDATE product_details pd
                    JOIN cart_items ci ON pd.product_id = ci.product_id
                    SET pd.stock = pd.stock - ci.quantity
                    WHERE ci.cart_id = cartId;

                    IF ROW_COUNT() = 0 THEN
                        ROLLBACK; 
                    ELSE
                        COMMIT;
                    END IF;
                END IF;
            END IF;
        END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `CompleteOfflineOrder`(
                IN cartId INT,
                IN offlineCustomerName VARCHAR(255),
                IN offlineCustomerPhoneNumber VARCHAR(15),
                IN offlineCustomerAddress TEXT,
                IN isFullyPaid BOOLEAN
            )
BEGIN
                DECLARE salesRecordId INT;

                START TRANSACTION;


                INSERT INTO sales_records (offline_customer_name, offline_customer_phone_number, offline_customer_address, is_fully_paid, created_at, updated_at)
                VALUES (offlineCustomerName, offlineCustomerPhoneNumber, offlineCustomerAddress, isFullyPaid, NOW(), NOW());

                SET salesRecordId = LAST_INSERT_ID();

                INSERT INTO sales_record_details (sales_id, product_id, quantity, price_per_unit, created_at, updated_at)
                SELECT salesRecordId, product_id, quantity, price, NOW(), NOW()
                FROM cart_items
                WHERE cart_id = cartId;

                UPDATE product_details pd
                JOIN cart_items ci ON pd.product_id = ci.product_id
                SET pd.stock = pd.stock - ci.quantity
                WHERE ci.cart_id = cartId;

                DELETE FROM cart_items WHERE cart_id = cartId;

                DELETE FROM carts WHERE id = cartId;

                COMMIT;
            END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `ConfirmPurchaseInvoice`(IN cartId INT, IN supplierId INT)
BEGIN
                DECLARE purchaseInvoiceId INT;

                START TRANSACTION;

                INSERT INTO purchase_invoices (supplier_id, invoice_date, created_at, updated_at)
                VALUES (supplierId, NOW(), NOW(), NOW());

                SET purchaseInvoiceId = LAST_INSERT_ID();

                INSERT INTO purchase_invoice_details (invoice_id, product_id, quantity, unit_price, created_at, updated_at)
                SELECT
                    purchaseInvoiceId, 
                    product_id, 
                    quantity, 
                    price, 
                    NOW(), 
                    NOW()
                FROM cart_items
                WHERE cart_id = cartId;

                UPDATE product_details pd
                JOIN cart_items ci ON pd.product_id = ci.product_id
                SET pd.stock = pd.stock + ci.quantity
                WHERE ci.cart_id = cartId;

                DELETE FROM carts WHERE id = cartId;

                COMMIT;
            END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `MarkSaleAsPaid`(IN saleId INT)
BEGIN
            UPDATE sales_records
            SET is_fully_paid = TRUE, updated_at = NOW()
            WHERE sales_id = saleId;
        END$$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION `cartTotal`(cartId INT) RETURNS decimal(10,2)
    DETERMINISTIC
BEGIN
                DECLARE total DECIMAL(10, 2);
                
                SELECT SUM(quantity * price) 
                INTO total
                FROM cart_items
                WHERE cart_id = cartId;
                
                RETURN COALESCE(total, 0);
            END$$
DELIMITER ;

