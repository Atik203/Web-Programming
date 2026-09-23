-- ============================================================================
-- FINAL 261 SET-A (Spring 2026) — Q3 (10 marks)
-- Database: tourism | Table: tourist_spot
-- ============================================================================
USE tourism;

-- ---------------------------------------------------------------------------
-- 1) SpotName, Region, Rating where Rating > 4.5 OR SpotName contains 'Beach'
--    Sort by Rating descending
--    PATTERN: WHERE with OR + LIKE + ORDER BY
-- ---------------------------------------------------------------------------
SELECT SpotName, Region, Rating
FROM tourist_spot
WHERE Rating > 4.5 OR SpotName LIKE '%Beach%'
ORDER BY Rating DESC;
-- Expected: Cox's Bazar Beach 4.9, Ratargul Forest 4.8, Shat Gambuj 4.7,
--           Kuakata Beach 4.5

-- ---------------------------------------------------------------------------
-- 2) Rating BETWEEN 4.0 AND 4.5 (inclusive) AND EntryFee > 0
--    ->  Rating + 0.2 and EntryFee + 10%
--    PATTERN: BETWEEN + UPDATE of two columns with arithmetic
-- ---------------------------------------------------------------------------
UPDATE tourist_spot
SET Rating = Rating + 0.2,
    EntryFee = EntryFee * 1.1
WHERE Rating BETWEEN 4.0 AND 4.5 AND EntryFee > 0;
-- Sundarbans (4.3, 150) -> (4.5, 165); Paharpur (4.1, 30) -> (4.3, 33)
-- NOT idempotent (4.5 is inside BETWEEN after the first run).

-- ---------------------------------------------------------------------------
-- 3) Each category: name, spot count, average rating, total visitors
--    ONLY categories with average rating > 4.4, sort by avg rating DESC
--    PATTERN: GROUP BY + COUNT + AVG + SUM + HAVING + ORDER BY
-- ---------------------------------------------------------------------------
SELECT Category,
       COUNT(*)              AS TotalSpots,
       AVG(Rating)           AS AverageRating,
       SUM(VisitorsPerYear)  AS TotalVisitors
FROM tourist_spot
GROUP BY Category
HAVING AVG(Rating) > 4.4
ORDER BY AverageRating DESC;
-- Expected AFTER the update above: Beach avg 4.70, Nature avg 4.65, Heritage avg 4.50
-- (With ORIGINAL data: Beach 4.7, Nature 4.55, Heritage 4.40 — 4.40 is NOT > 4.4,
--  so Heritage would be excluded if you skip the update.)

-- ---------------------------------------------------------------------------
-- 4) Each region: total estimated yearly revenue = SUM(EntryFee * VisitorsPerYear)
--    ONLY regions above 1,000,000, highest first
--    PATTERN: computed SUM inside GROUP BY + HAVING
-- ---------------------------------------------------------------------------
SELECT Region,
       SUM(EntryFee * VisitorsPerYear) AS TotalRevenue
FROM tourist_spot
GROUP BY Region
HAVING SUM(EntryFee * VisitorsPerYear) > 1000000
ORDER BY TotalRevenue DESC;
-- Expected AFTER the update above: KHL = 13,200,000 (165*80000);
-- SYL = 6,000,000; BGH = 2,100,000; NWG = 1,320,000 (33*40000)
