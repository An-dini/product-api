# Product API

The Product API is a simple API designed for authentication (login & register), as well as CRUD operations for categories and products. To access the CRUD functionalities for categories and products, you must first log in to obtain a token.

## Features

- User Authentication (Login & Register)
- CRUD Operations for Categories
- CRUD Operations for Products

## Getting Started with Postman

Follow these steps to use the Product API in Postman:

1. **Download the API Collection**

   - Download the API collection file from the link provided [HERE](#).

2. **Open Postman**

   - Launch the Postman application on your device.

3. **Import the API Collection**

   - Go to the "APIs" tab in Postman.
   - Click on "Import" and select the downloaded API collection file.
   - Alternatively, you can drag and drop the JSON file directly into Postman.

4. **Authentication**

   - Before using the CRUD operations, you need to log in to obtain a token.
   - Use the login endpoint to authenticate and receive your token.

5. **Using CRUD Operations**
   - Once you have the token, include it in the headers of your requests to access the category and product endpoints.
   - The URL and Token variables values can be replaced with yours.

## Example Usage

### Login

- **Endpoint:** `POST /login`
- **Body:**
  ```json
  {
  	"email": "your_email",
  	"password": "your_password"
  }
  ```
- Or you can use **form-data**
- **Key:** `email` | **Value:** `your_email`
- **Key:** `password` | **Value:** `your_password`

### Register

- **Endpoint:** `POST /register`
- **Body:**
  ```json
  {
  	"name": "your_name",
  	"email": "your_email",
  	"password": "your_password",
  	"password_confirmation": "your_password"
  }
  ```
- Or you can use **form-data**
- **Key:** `name` | **Value:** `your_name`
- **Key:** `email` | **Value:** `your_email`
- **Key:** `password` | **Value:** `your_password`
- **Key:** `password_confirmation` | **Value:** `your_password`

### CRUD Category

#### Create Category

- **Endpoint:** `POST /category-products`
- **Headers:** `Authorization: Bearer your_token`
- **Body:**
  ```json
  {
  	"name": "category_name"
  }
  ```
- Or you can use **form-data**
- **Key:** `name` | **Value:** `category_name`

#### Read Category

- **Endpoint:** `GET /category-products`
- **Headers:** `Authorization: Bearer your_token`

#### Read Category by ID

- **Endpoint:** `GET /category-products/{id}`
- **Headers:** `Authorization: Bearer your_token`

#### Update Category

- **Endpoint:** `PATCH /category-products/{id}`
- **Headers:** `Authorization: Bearer your_token`
- **Body:**
  ```json
  {
  	"name": "category_name"
  }
  ```

#### Update Category with form-data

- **Endpoint:** `POST /category-products/{id}`
- **Params:**
- **Key:** `_method` | **Value:** `PATCH`
- **Headers:** `Authorization: Bearer your_token`
- **Body:**
- **Key:** `name` | **Value:** `category_name`

#### Delete Category

- **Endpoint:** `DELETE /category-products/{id}`
- **Headers:** `Authorization: Bearer your_token`

### CRUD Product

#### Create Product

- **Endpoint:** `POST /product`
- **Headers:** `Authorization: Bearer your_token`
- **Body:**
  ```json
  {
  	"product_category_id": "category_id",
  	"name": "product_name",
  	"price": "product_price",
  	"image": "(product_image)"
  }
  ```
- Or you can use **form-data**
- **Key:** `product_category_id` | **Value:** `category_id`
- **Key:** `name` | **Value:** `product_name`
- **Key:** `price` | **Value:** `product_price`
- **Key:** `image` | **Value:** `select the image`

#### Read Product

- **Endpoint:** `GET /product`
- **Headers:** `Authorization: Bearer your_token`

#### Read Product by ID

- **Endpoint:** `GET /product/{id}`
- **Headers:** `Authorization: Bearer your_token`

#### Update Product

- **Endpoint:** `PATCH /product/{id}`
- **Headers:** `Authorization: Bearer your_token`
- **Body:**
  ```json
  {
  	"product_category_id": "category_id",
  	"name": "product_name",
  	"price": "product_price",
  	"image": "(product_image)"
  }
  ```

#### Update Product with form-data

- **Endpoint:** `POST /product/{id}`
- **Params:**
- **Key:** `_method` | **Value:** `PATCH`
- **Headers:** `Authorization: Bearer your_token`
- **Body:**
- **Key:** `product_category_id` | **Value:** `category_id`
- **Key:** `name` | **Value:** `product_name`
- **Key:** `price` | **Value:** `product_price`
- **Key:** `image` | **Value:** `select the image`

#### Delete Product

- **Endpoint:** `DELETE /product/{id}`
- **Headers:** `Authorization: Bearer your_token`
