-- ============================================================================
-- FINAL 253 (Fall 2025) — Q3 (10 marks)
-- Database: campus_library | Table: book_loans
-- ============================================================================
USE campus_library;

-- ---------------------------------------------------------------------------
-- 1) Total books per Status, but ONLY statuses with more than 1 entry
--    PATTERN: GROUP BY + HAVING COUNT(*) > n
-- ---------------------------------------------------------------------------
SELECT Status, COUNT(*) AS TotalBooks
FROM book_loans
GROUP BY Status
HAVING COUNT(*) > 1;
-- Expected: Returned = 2, Overdue = 3 (Lost = 1 excluded by HAVING)

-- ---------------------------------------------------------------------------
-- 2) Status = 'Overdue' AND DaysOverdue < 7  ->  'Grace Period' and fee = 0
--    PATTERN: guarded UPDATE setting TWO columns
-- ---------------------------------------------------------------------------
UPDATE book_loans
SET Status = 'Grace Period', PenaltyFee = 0
WHERE Status = 'Overdue' AND DaysOverdue < 7;
-- Barkat (5 days) and Rahim (2 days). Safe to re-run.

-- ---------------------------------------------------------------------------
-- 3) PenaltyFee > 20  ->  +10% processing charge, only if final fee <= 50
-- ---------------------------------------------------------------------------
UPDATE book_loans
SET PenaltyFee = PenaltyFee * 1.1
WHERE PenaltyFee > 20 AND PenaltyFee * 1.1 <= 50;
-- Jabbar 24 -> 26.40. Karim 30 -> 33 but status Lost, still matches!
-- (No status condition in the question.) NOT idempotent: 26.40*1.1 = 29.04
-- would update again on a re-run. Re-run 01_schema.sql to reset.

-- ---------------------------------------------------------------------------
-- 4) Each BookTitle + total PenaltyFee for that book, highest money first
--    PATTERN: GROUP BY + SUM + ORDER BY aggregate DESC
-- ---------------------------------------------------------------------------
SELECT BookTitle, SUM(PenaltyFee) AS TotalPenalty
FROM book_loans
GROUP BY BookTitle
ORDER BY TotalPenalty DESC;
-- Expected AFTER the updates above: Data Structures = 33.00 (Karim 30*1.1),
-- Operating Systems = 26.40 (Jabbar 24*1.1), Discrete Math = 0, Linear Algebra = 0
