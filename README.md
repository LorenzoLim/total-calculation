# Get Started

-   Run "yarn" to install all the dependencies
-   Run "yarn start" to start the development server
-   Run "yarn test" to start the unit tests once the server is running

# Files

-   PurchaseOrderService.php is located at interview-test/app/Helpers
-   PurchaseOrderServiceController.php where the logic is being handled and is located at interview-test/app/Http/Controllers
-   web.php is where the route for /test is established and is located at interview-test/routes
-   All the test files can be found under interview-test/tests/Unit

# Environment Variables

-   Create a .env file and add these values:

API_USERNAME_CARTON_CLOUD=The username to access the Carton Cloud API
API_PASSWORD_CARTON_CLOUD=The password to access the Carton Cloud API

API_USERNAME=The username to access the POST request endpoint at /test
API_PASSWORD=The password to access the POST request endpoint at /test
