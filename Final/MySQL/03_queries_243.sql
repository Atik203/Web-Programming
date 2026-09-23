-- ============================================================================
-- FINAL 243 (Fall 2024) — Q3 (10 marks)
-- Database: uiuweb_final | Table: student_final
-- ============================================================================
USE uiuweb_final;

-- ---------------------------------------------------------------------------
-- 1) Total number of students who received each letter grade (A, B, C, D)
--    PATTERN: GROUP BY + COUNT
-- ---------------------------------------------------------------------------
SELECT LetterGrade, COUNT(*) AS TotalStudents
FROM student_final
GROUP BY LetterGrade;
-- Expected: A=2, B=2, C=1, D=1

-- ---------------------------------------------------------------------------
-- 2) Grade below 75 and letter grade is not 'D'  ->  change to 'C'
--    PATTERN: guarded conditional UPDATE
-- ---------------------------------------------------------------------------
UPDATE student_final
SET LetterGrade = 'C'
WHERE Grade < 75 AND LetterGrade <> 'D';
-- Affects Jasica Ahmed (65, D) — NO, guard blocks her (she IS 'D')
-- Affects nobody in this data; safe to re-run. Verify with:
SELECT * FROM student_final;

-- ---------------------------------------------------------------------------
-- 3) Grade greater than 80  ->  add 5 bonus points, only if result <= 90
--    PATTERN: arithmetic UPDATE with guard on the NEW value
-- ---------------------------------------------------------------------------
UPDATE student_final
SET Grade = Grade + 5
WHERE Grade > 80 AND Grade + 5 <= 90;
-- Karim 85 -> 90 (OK, 90 <= 90). Rahim 92 -> 97 would exceed 90, skipped.

-- ---------------------------------------------------------------------------
-- 4) For each course: course title + number of students, most popular first
--    PATTERN: GROUP BY + COUNT + ORDER BY alias DESC
-- ---------------------------------------------------------------------------
SELECT CourseTitle, COUNT(*) AS TotalStudents
FROM student_final
GROUP BY CourseTitle
ORDER BY TotalStudents DESC;
-- Expected: Web Programming = 3, Project Management = 2, System Analysis... = 1
