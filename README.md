# Foodics Task

--- 

## Description

--- 
The system has three main modules

- Product,
- Ingredient,
- Order

A long with Stock management for both products and
ingredients

## System Features:

---

- The system groups the business models into domains with its business logic
- The system sometimes denormalized and accommodates redundancy for the sake of performance , reporting and decrease
  database hits
- In stock management system uses polymorphic relation to stock any type of modules that can be stocked to better serve
  scalability and further business needs with taking into consideration the readability in database with mapping the
  morph to readable entity and also indexing the stockable for further retrieving of data
- The System uses localized content to locales Arabic and English with Arabic as default locale

- The system uses **Laravel** v.10 and **PHP** v.8.1
- All the unit measures are in grams and liters

### Steps to run the project

---

    cd <project_directory>

    composer install

    cp .env.example .env

    php artisan migrate

    php artisan db:seed 

### To run tests

---

    phpunit tests/

## Postman collection

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/740199-fa6df755-28f1-464f-b4f0-015e38787201?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D740199-fa6df755-28f1-464f-b4f0-015e38787201%26entityType%3Dcollection%26workspaceId%3D1a73e2b3-b2a4-4c3e-ba78-134d9fc6b81a)
