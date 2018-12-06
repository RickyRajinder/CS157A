USE ClothingDatabase;

DELIMITER //
CREATE PROCEDURE decrementCountInProduct
(IN p_productID INT)
BEGIN
  UPDATE Product
  SET count = count - 1
  WHERE productID = p_productID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE finalizeCartTransact
(IN p_transactionID INT, IN p_customerID INT)
BEGIN
  DECLARE v_totalprice FLOAT DEFAULT 0;

  SELECT SUM(p1.price) INTO v_totalprice
  FROM Product p1 INNER JOIN (SELECT * FROM Cart WHERE transactionID = p_transactionID AND customerID = p_customerID) c1 ON p1.productID = c1.productID;

  INSERT INTO Transaction(transactionID, price)
  VALUES(p_transactionID, v_totalprice);

  INSERT INTO CustomerPurchases(transactionID, customerID)
  VALUES(p_transactionID, p_customerID);

  INSERT INTO Purchases(transactionID, productID)
  SELECT transactionID, productID
  FROM Cart WHERE transactionID = p_transactionID AND customerID = p_customerID;

  DELETE FROM Cart WHERE transactionID = p_transactionID AND customerID = p_customerID;

END //
DELIMITER ;

DELIMITER $$
CREATE FUNCTION calculateTax (input FLOAT) RETURNS FLOAT
    DETERMINISTIC
  BEGIN
    RETURN input * 0.0875;
END

DELIMITER $$
CREATE FUNCTION calculateTotal (input FLOAT) RETURNS FLOAT
    DETERMINISTIC
BEGIN
  DECLARE subtotal FLOAT DEFAULT 0;
  SET subtotal = input;
  SET subtotal = subtotal + calculateTax(subtotal);
    RETURN subtotal + 6.99;
END //