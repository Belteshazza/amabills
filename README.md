<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

TASK DETAILS
1. A user can create an account, login to their dashboard, and reset their forgotten password. This authentication system should be a tokenized system that will expire at a certain time range.

Solution : Laravel Passport was used for authentication and the token expires after 

2. A user can have many products and many products can only belong to one user demonstrating ( one-to-many ) relationships.

Solution : One to many was used to achieve this between the users and products table

3. Users products should have [ NAME, DESCRIPTION, QUANTITY, UNIT PRICE, AMOUNT_SOLD etc ] as attributes. ( Use appropriate dataType for all fields )

Solution: Approprite dataTypes were used to achieve this

4. Products can be updated and deleted by the owner. A user is not allowed to update or delete products that don't belong to them.

Solution: The auth check was used toachieve this

5. Products should be listed with pagination and in DESC order.

Solution: The orderBy and pagination was used to achieve this

6. Create a github Repository and push your code and share this repository when done.

Solution: My github repos with the name amabills was used to achieve this and here is the link https://github.com/wealthydeveloper/amabills

7. Demonstrate proper documentation standards by documenting your APIs using postman.
 solution is below, you can also clickon this link to see the api endpoints https://documenter.getpostman.com/view/15373925/2s8ZDbVLEK#1ab30185-e1fb-4011-8ff6-8ef85e6c5267


## The postman API solution link: https://documenter.getpostman.com/view/15373925/2s8ZDbVLEK#1ab30185-e1fb-4011-8ff6-8ef85e6c5267