#Purpose: Store a list of Invoices


USE DSHome;

DROP TABLE IF EXISTS tInvoice;

CREATE TABLE IF NOT EXISTS tInvoice(

	InvoiceID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,

	InvoiceDate DATETIME NULL,

	InvoiceTotal DECIMAL(7,2) NOT NULL,
	
PaidDate DateTime NULL
);

