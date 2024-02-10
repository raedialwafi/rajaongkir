<a href="https://codeclimate.com/github/raedialwafi/rajaongkir/maintainability"><img src="https://api.codeclimate.com/v1/badges/5c8a5fc18f63e9c326a8/maintainability" /></a>
<a href="https://codeclimate.com/github/raedialwafi/rajaongkir/test_coverage"><img src="https://api.codeclimate.com/v1/badges/5c8a5fc18f63e9c326a8/test_coverage" /></a>

# Raja Ongkir App

## Description

Rajaongkir Laravel Project is a web application built on the Laravel framework. It primarily focuses on integrating with the Rajaongkir API to fetch and manage data related to provinces and cities. The application includes functionalities such as fetching data from the Rajaongkir API, storing it in the database, and providing an API endpoint to search for provinces and cities.

## Project Structure

The project follows a modular structure with the following components:

- **Fetch Raja Ongkir Data Command:** Responsible for fetching provinces and cities data from the Rajaongkir API and storing it in the database.

- **RajaOngkir Controller:** Provides API endpoints to search for provinces and cities.

## Onboarding and Development Guide

### Getting Started
1. **Install PHP, MySQL, NPM**
   Read from this link to install:
    - [Github](https://docs.github.com/en)
    - PHP and Composer installed on your machine. You can download them from [php.net](https://www.php.net/) and [getcomposer.org](https://getcomposer.org/).
    - [Laravel](https://laravel.com/)
    - [MySQL](https://www.mysql.com/)
    - [NPM](https://www.npmjs.com/)

2. **Clone the Repository**
   ```bash
   git clone https://github.com/raedialwafi/rajaongkir.git
   cd rajaongkir
3. **Configure Environment**
   ```bash
   cp .env.example .env
   
   Fill the value
   --------------------------
   RAJAONGKIR_API_KEY=
   SWAPAPI_VALUE=
   PARTNER_IN_AUTH_USERNAME=
   PARTNER_IN_AUTH_PASSWORD=
   ```
   Note: 
   1. Contact the developer for the API Key
   2. SWAPAPI_VALUE `True` means the data is taken from the Rajaongkir API, while `False` means the data is taken from the database.
4. **Migrate Database**
   ```bash
   php artisan migrate
5. **Seed Database (Optional)**
    ```bash
    php artisan db:seed
6. **Run the Laravel Project**
    ```bash
    php artisan serve
The project will be accessible at http://localhost:8000.

### Additional Steps
If the project includes JavaScript and a package.json file, you can install JavaScript dependencies using NPM:

    npm install

You can run unit test with:

    php artisan test .\tests

## Endpoints

For all API endpoints, please read the blueprint or the routes folder in the code.

## Contributing

Contributions to this project are welcome! Feel free to open issues or submit pull requests to improve the functionality or fix any bugs.

## Demo

You can reach my demo website [here](https://rajaongkir-five.vercel.app)

But there's problem with Vercel Hosting. Vercel doesn't directly support PHP or Laravel migrations during its build process, so you need to consider alternative approaches.

An alternative for storing data in the form of MySQL can be found on the website https://freesqldatabase.com/.


## License

This project is open-source and available under the [MIT License](LICENSE).