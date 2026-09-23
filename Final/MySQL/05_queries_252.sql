-- ============================================================================
-- FINAL 252 (Summer 2025) — Q3 (10 marks)
-- Database: sundarban | Table: sales_data
-- ============================================================================
USE sundarban;

-- ---------------------------------------------------------------------------
-- 1) Total revenue per category
--    PATTERN: GROUP BY + SUM
-- ---------------------------------------------------------------------------
SELECT CategoryName, SUM(Revenue) AS TotalRevenue
FROM sales_data
GROUP BY CategoryName;
-- Expected: Electronics = 395000, Furniture = 136000, Accessories = 50000

-- ---------------------------------------------------------------------------
-- 2) Revenue below 40,000  ->  category becomes 'Low Performing'
-- ---------------------------------------------------------------------------
UPDATE sales_data
SET CategoryName = 'Low Performing'
WHERE Revenue < 40000;
-- Bottle (30000) and Pen (20000). Safe to re-run (already renamed).

-- ---------------------------------------------------------------------------
-- 3) Revenue above 70,000  ->  add 10% bonus revenue
--    PATTERN: arithmetic UPDATE, x = x * 1.1
-- ---------------------------------------------------------------------------
UPDATE sales_data
SET Revenue = Revenue * 1.1
WHERE Revenue > 70000;
-- Laptop 350000 -> 385000, Desk 72000 -> 79200. NOT idempotent:
-- re-running would multiply again. Re-run 01_schema.sql to reset.

-- ---------------------------------------------------------------------------
-- 4) Each product: name, category, and 'Top Seller' if revenue is above the
--    average revenue of its OWN category, else 'Regular Seller'
--    PATTERN: correlated subquery + CASE
-- ---------------------------------------------------------------------------
SELECT ProductName,
       CategoryName,
       Revenue,
       CASE
           WHEN Revenue > (SELECT AVG(s2.Revenue)
                           FROM sales_data s2
                           WHERE s2.CategoryID = s1.CategoryID)
           THEN 'Top Seller'
           ELSE 'Regular Seller'
       END AS SellerLabel
FROM sales_data s1;
-- Expected AFTER the updates above have run: Laptop, Desk and Bottle are
-- Top Sellers; Mouse, Chair and Pen are Regular Sellers.
-- (Laptop 385000 > Electronics avg 215000; Desk 79200 > Furniture avg 71600;
--  Bottle 30000 > Low Performing avg 25000.)
