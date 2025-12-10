USE library_system;

-- Stored procedure: lend_book
DROP PROCEDURE IF EXISTS lend_book;
DELIMITER $$
CREATE PROCEDURE lend_book(IN p_book_id INT, IN p_student_id INT, IN p_due_date DATE)
BEGIN
  DECLARE v_copies INT;
  SELECT copies INTO v_copies FROM books WHERE id=p_book_id FOR UPDATE;
  IF v_copies <= 0 THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No copies available';
  ELSE
    UPDATE books SET copies = copies - 1 WHERE id=p_book_id;
    INSERT INTO loans (book_id, student_id, loan_date, due_date) VALUES (p_book_id, p_student_id, CURDATE(), p_due_date);
  END IF;
END$$
DELIMITER ;

-- Stored procedure: return_book
DROP PROCEDURE IF EXISTS return_book;
DELIMITER $$
CREATE PROCEDURE return_book(IN p_loan_id INT)
BEGIN
  DECLARE v_book INT;
  SELECT book_id INTO v_book FROM loans WHERE id = p_loan_id;
  UPDATE loans SET returned = 1, returned_date = CURDATE() WHERE id = p_loan_id;
  UPDATE books SET copies = copies + 1 WHERE id = v_book;
END$$
DELIMITER ;

-- Function: overdue_days
DROP FUNCTION IF EXISTS overdue_days;
DELIMITER $$
CREATE FUNCTION overdue_days(p_loan_id INT) RETURNS INT
DETERMINISTIC
BEGIN
  DECLARE v_due DATE;
  DECLARE v_ret DATE;
  SELECT due_date, returned_date INTO v_due, v_ret FROM loans WHERE id=p_loan_id;
  IF v_ret IS NULL THEN
    RETURN GREATEST(DATEDIFF(CURDATE(), v_due),0);
  ELSE
    RETURN GREATEST(DATEDIFF(v_ret, v_due),0);
  END IF;
END$$
DELIMITER ;

-- Trigger: prevent_deleting_book_if_loaned (example)
DROP TRIGGER IF EXISTS trg_before_delete_book;
DELIMITER $$
CREATE TRIGGER trg_before_delete_book
BEFORE DELETE ON books
FOR EACH ROW
BEGIN
  IF (SELECT COUNT(*) FROM loans WHERE book_id = OLD.id AND returned = 0) > 0 THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot delete book while it is loaned out';
  END IF;
END$$
DELIMITER ;
