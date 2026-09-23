-- ============================================================================
-- FINAL 261 SET-B (Spring 2026) — Q3 (10 marks)
-- Database: uiu_bookshop | Table: book_info
-- ============================================================================
USE uiu_bookshop;

-- ---------------------------------------------------------------------------
-- 1) All books from the Programming category, sorted by Price descending
-- ---------------------------------------------------------------------------
SELECT * FROM book_info
WHERE Category = 'Programming'
ORDER BY Price DESC;
-- Expected: Python Mastery 600, Database Guide 550, Web Basics 450

-- ---------------------------------------------------------------------------
-- 2) BookTitle, Author, Price where Price > 400 AND Category = 'Programming'
-- ---------------------------------------------------------------------------
SELECT BookTitle, Author, Price
FROM book_info
WHERE Price > 400 AND Category = 'Programming';
-- Expected: Database Guide, Python Mastery

-- ---------------------------------------------------------------------------
-- 3) Number of books available in each Category
-- ---------------------------------------------------------------------------
SELECT Category, COUNT(*) AS TotalBooks
FROM book_info
GROUP BY Category;
-- Expected: Programming = 3, Language = 2, Business = 1

-- ---------------------------------------------------------------------------
-- 4) Total net worth of the bookshop = SUM(Price * Stock)
--    PATTERN: computed aggregate (no GROUP BY — one row for the whole table)
-- ---------------------------------------------------------------------------
SELECT SUM(Price * Stock) AS TotalNetWorth
FROM book_info;
-- Expected: 450*10 + 550*8 + 300*15 + 400*12 + 600*5 + 350*7
--         = 4500 + 4400 + 4500 + 4800 + 3000 + 2450 = 23650

-- ---------------------------------------------------------------------------
-- 5) 10% price reduction for the 'Language' category, then show updated prices
-- ---------------------------------------------------------------------------
UPDATE book_info
SET Price = Price * 0.9
WHERE Category = 'Language';

SELECT BookTitle, Price
FROM book_info
WHERE Category = 'Language';
-- Expected: English Grammar 270, French Made Easy 315
-- NOT idempotent: re-run 01_schema.sql to reset.
