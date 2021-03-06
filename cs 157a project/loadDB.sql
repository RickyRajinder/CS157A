USE ClothingDatabase;

LOAD DATA INFILE 'storeInput.txt'
INTO TABLE Store COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'customerInput.txt'
INTO TABLE Customer COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'transactionInput.txt'
INTO TABLE Transaction COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'productInput.txt'
INTO TABLE Product COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'topInput.txt'
INTO TABLE Top COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'bottomInput.txt'
INTO TABLE Bottom COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'shoeInput.txt'
INTO TABLE Shoe COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'carryInput.txt'
INTO TABLE Carry COLUMNS TERMINATED BY '\t';