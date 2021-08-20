# timecard
timecard module for adding to the MVC framework

the controller, model, and views are added here.  

The app allows the user to:
1) create and store clients in the database
2) enter hours worked and attach those to the correct client
3) create a pdf incvoice for clients of recent hours worked.

Notes:
1) this app is still very early in development
2) there is very little form verification in place currently
3) mpdf is installed through composer.  Those files are not included in this repository
4) This app currently creates an invoice pdf and saves it in the proper directory, However I still need to add in a database entry for the invoice and attach the invoice id to the hours worked table so duplicate invoices are not made.
