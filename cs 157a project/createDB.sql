CREATE DATABASE ClothingDatabase;
USE ClothingDatabase;

CREATE TABLE Store (
	storeName VARCHAR(255),
	popularity FLOAT,
	PRIMARY KEY(storeName)
);

CREATE TABLE Customer (
	customerID INT,
	password VARCHAR(255) NOT NULL,
	firstName VARCHAR(255),
	lastName VARCHAR(255),
	address VARCHAR(255),
	email VARCHAR(255) UNIQUE NOT NULL,
	cardNumber VARCHAR(16) NOT NULL,
	PRIMARY KEY(customerID)
);

CREATE TABLE Transaction (
	transactionID INT,
	price FLOAT,
	PRIMARY KEY(transactionID)
);

CREATE TABLE Product (
	productID INT,
	color VARCHAR(255),
	price FLOAT, 
	brandName VARCHAR(255),	
	name VARCHAR(255),
	count INT,
	PRIMARY KEY(productID)
);

CREATE TABLE Top (
	productID INT,
	hood TINYINT(1),
	size VARCHAR(5),
	pocket TINYINT(1),
	zipper TINYINT(1),
	PRIMARY KEY(productID),
	FOREIGN KEY (productID) REFERENCES Product(productID) ON DELETE CASCADE
);

CREATE TABLE Bottom (
	productID INT,
	waistSize INT,
	lengthSize INT,
	PRIMARY KEY(productID),
	FOREIGN KEY (productID) REFERENCES Product(productID) ON DELETE CASCADE
);

CREATE TABLE Shoe (
	productID INT,
	shoeSize FLOAT,
	PRIMARY KEY(productID),
	FOREIGN KEY (productID) REFERENCES Product(productID) ON DELETE CASCADE
);

CREATE TABLE Carry (
	storeName VARCHAR(255),
	productID INT,
	PRIMARY KEY(storeName, productID),
	FOREIGN KEY (storeName) REFERENCES Store(storeName) ON DELETE CASCADE,
	FOREIGN KEY (productID) REFERENCES Product(productID) ON DELETE CASCADE
);

CREATE TABLE CustomerPurchases (
	customerID INT,
	transactionID INT,
	PRIMARY KEY(customerID, transactionID),
	FOREIGN KEY (customerID) REFERENCES Customer(customerID) ON DELETE CASCADE,
	FOREIGN KEY (transactionID) REFERENCES Transaction(transactionID) ON DELETE CASCADE
);

CREATE TABLE Purchases (
	transactionID INT,
	productID INT,
	PRIMARY KEY(transactionID, productID),
	FOREIGN KEY (transactionID) REFERENCES Transaction(transactionID) ON DELETE CASCADE,
	FOREIGN KEY (productID) REFERENCES Product(productID) ON DELETE CASCADE
);

CREATE TABLE Cart (
	customerID INT,
	transactionID INT,
	productID INT,
	PRIMARY KEY(transactionID, productID),
	FOREIGN KEY (customerID) REFERENCES Customer(customerID) ON DELETE CASCADE,
	FOREIGN KEY (productID) REFERENCES Product(productID) ON DELETE CASCADE
);
