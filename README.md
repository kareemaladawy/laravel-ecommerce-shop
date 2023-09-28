<p align="center">
 <img width="512" height="166" src="https://github.com/kareemaladawy/Parking-Reservation-API/assets/62149929/036c7209-ff92-46b3-988f-95da03b9724c" alt="Project logo"></a>
</p>

<p align="center" >Shoply - Ecommerce store built using the Laravel framework</p>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/kylelobo/The-Documentation-Compendium.svg)](https://github.com/kylelobo/The-Documentation-Compendium/pulls)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---

## Table of Contents

-   [Introduction](#introduction)
-   [Features](#Features)
    -   [User](#User)
    -   [Site Admin](#site-admin)
-   [Getting Started](#getting-started)
-   [Authors](#authors)

### Introduction

This E-commerce store is built using the Laravel framework, a popular PHP framework that is known for its speed, scalability, and security. It allows users to:

-   Browse and filter a wide range of products
-   Rate products and share their reviews with other users
-   Benefit from offers and discounts on products
-   Manage their shopping cart and track their orders
-   Checkout using multiple payment methods, including PayPal and credit cards
-   Switch between languages (Multilingual support)

It is designed to be user-friendly and secure, with a focus on providing a seamless shopping experience for customers. It is also scalable and extensible, making it a good choice for businesses of startup sizes.

### Database Schema

![ecommerce-erd](https://github.com/kareemaladawy/Parking-Reservation-API/assets/62149929/2d201695-3f75-4ccf-a97b-779177afc196)

## Features

### User

-   User registration and login with Google OAuth
-   Product browsing, filtering, and rating
-   Shopping cart management
-   Secure checkout with multiple payment methods (PayPal and Credit Card)
-   Order tracking
-   Account management and subscription to email list

### Site Admin

-   Admin login and creation
-   Management of orders, products, categories, attributes, offers, brands, customers, admins, and settings
-   Real-time notifications for new and updated orders

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

-   Composer dependency manager
-   PHP 8+
-   Laravel 10.18+

### Installation

1- Clone the project

```
git clone https://github.com/kareemaladawy/Laravel-Ecommerce.git
```

2- Install the dependencies

```
composer install
```

3- Configure the environment:

```
cp .env.example .env
```

4- Generate the application key:

```
php artisan key:generate
```

5- Migrate the database:

```
php artisan migrate --seed
```

6- Start the development server:

```
php artisan serve
```

## Screenshots

<a href="https://github.com/kareemaladawy/Laravel-Ecommerce/issues/1">Website Screenshots</a> <br>
<a href="https://github.com/kareemaladawy/Laravel-Ecommerce/issues/2">Admin Dashboard Screenshots</a>

## Authors

-   [@kareemaladawy](https://github.com/kareemaladawy) - Idea & Initial work
