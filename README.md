## CarShop Laravel Technical Challenge

Clone this repo, and complete the following:

* Add a column to the cars model called "seller" the options for this will be "Owner", "Car Dealership".
* Update the seeder to populate this column, and seed your database with a few hundred entries.
* Modify the welcome.blade.php view to do the following:
    - List the cars in a paginated table
    - Add two select boxes, one that lets you select which column to order by, one that lets you filter by car type
    - The page should autoreload when a new selection is made on one of the select boxes