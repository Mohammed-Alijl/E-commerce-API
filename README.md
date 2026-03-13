# 🛒 E-commerce API

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 9">
  <img src="https://img.shields.io/badge/PHP-8.0.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/OAuth2-Passport-orange?style=for-the-badge" alt="Passport">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License">
</p>

---

## 📖 Table of Contents

- [About the Project](#-about-the-project)
- [Real-World Usage](#-real-world-usage)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Environment Configuration](#environment-configuration)
- [Authentication](#-authentication)
- [Request Headers](#-request-headers)
- [API Reference](#-api-reference)
  - [Customer Authentication](#1-customer-authentication)
  - [Dashboard Authentication](#2-dashboard-authentication)
  - [Customer Management](#3-customer-management)
  - [Products](#4-products)
  - [Product Colors](#5-product-colors)
  - [Product Sizes](#6-product-sizes)
  - [Product Images](#7-product-images)
  - [Categories](#8-categories)
  - [Wishlist (Likes)](#9-wishlist-likes)
  - [Shopping Cart](#10-shopping-cart)
  - [Shipping Addresses](#11-shipping-addresses)
  - [Shipping Types](#12-shipping-types)
  - [Orders](#13-orders)
- [Response Format](#-response-format)
- [Database Schema](#-database-schema)
- [Localization](#-localization)
- [License](#-license)

---

## 🌟 About the Project

This project is a **complete E-commerce REST API** — a pure backend with no frontend. It provides every feature you'd expect from a modern online store: customer accounts with Google OAuth, a full product catalog with variants (colors, sizes, images), a shopping cart with checkout, order management, saved wishlists, address management, and configurable shipping options.

The API is stateless, secured via **OAuth 2.0 Bearer tokens** (Laravel Passport), and also protected by an **API key** header. It supports **English and Arabic** localization, making it accessible to a wider audience. It exposes two distinct authentication guards — one for **customers** and one for **dashboard employees** — allowing both a mobile app and an admin control panel to be built on top of the same backend.

---

## 📱 Real-World Usage

This API powers two real Flutter applications built by **[Saleem Mahdi](https://github.com/saleem-15)**:

> **[shop-control-panel (Flutter Windows Dashboard)](https://github.com/saleem-15/shop-control-panel)**
> A full-featured admin dashboard for Windows that lets employees manage products, categories, orders, customers, and shipping options.

> **[Online-Shop (Flutter Mobile App)](https://github.com/saleem-15/Online-Shop)**
> A complete e-commerce mobile application for customers — browse products, manage a cart, place orders, and track deliveries.

If you're a developer looking to build a frontend (mobile, desktop, or web) on top of this API, both applications above serve as excellent reference implementations showing exactly how every endpoint is consumed in production.

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔐 **Dual Authentication** | Separate OAuth 2.0 guards for customers and dashboard employees |
| 🌐 **Google OAuth** | Customers can sign in with their Google account |
| 🔑 **Password Reset** | Reset password via emailed numeric verification code |
| 🛍️ **Product Catalog** | Full CRUD for products with category, price, description, and quantity |
| 🎨 **Product Variants** | Per-product color and size management |
| 🖼️ **Product Images** | Upload and manage multiple images per product |
| 🗂️ **Categories** | Organize products into categories with optional category images |
| 🛒 **Shopping Cart** | Add, update, and remove items; checkout to create an order |
| ❤️ **Wishlist** | Like/unlike products to build a personal wishlist |
| 📦 **Order Management** | Place, update, process, and track orders end-to-end |
| 🏠 **Address Book** | Manage multiple shipping addresses with a default address selector |
| 🚚 **Shipping Types** | Configure shipping options with pricing and estimated delivery windows |
| 🔍 **Product Search** | Search products by name |
| 🌍 **Localization** | Full Arabic and English support via a request header |
| 🛡️ **API Key Protection** | All routes protected by a shared API key header |

---

## 🛠 Tech Stack

| Layer | Technology |
|---|---|
| **Framework** | [Laravel 9](https://laravel.com) |
| **Language** | PHP 8.0.2+ |
| **Authentication** | [Laravel Passport](https://laravel.com/docs/passport) (OAuth 2.0) |
| **Social Login** | [Laravel Socialite](https://laravel.com/docs/socialite) (Google) |
| **Database** | MySQL |
| **File Storage** | Laravel local disk (configurable) |
| **Email** | Laravel Mail (SMTP / Mailgun) |
| **Testing** | PHPUnit |

---

## 🚀 Getting Started

### Prerequisites

- PHP **8.0.2** or higher
- [Composer](https://getcomposer.org/)
- MySQL (or compatible) database server
- An SMTP mail server (for password reset emails)

### Installation

**1. Clone the repository**

```bash
git clone https://github.com/Mohammed-Alijl/E-commerce-API.git
cd E-commerce-API
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Copy the environment file and generate the application key**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure your database** (see [Environment Configuration](#environment-configuration))

**5. Run database migrations**

```bash
php artisan migrate
```

**6. Install and configure Laravel Passport**

```bash
php artisan passport:install
```

**7. Create the storage symbolic link** (for media file access)

```bash
php artisan storage:link
```

**8. Start the development server**

```bash
php artisan serve
```

The API will be available at `http://localhost:8000`.

---

### Environment Configuration

Open `.env` and configure the following values:

```dotenv
APP_NAME="E-commerce API"
APP_URL=http://localhost:8000

# API Key (used to authenticate all API requests — set this to a strong random secret before deploying)
# Note: this project uses the camelCase name "apiKey" as the env variable and header name
apiKey=your_secret_api_key_here

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_commerce
DB_USERNAME=root
DB_PASSWORD=your_password

# Mail (for password reset emails)
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@your-domain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🔐 Authentication

This API uses **OAuth 2.0 Bearer Tokens** via Laravel Passport and exposes **two separate authentication guards**:

| Guard | Description | Prefix |
|---|---|---|
| **Customer** | End-users of the online shop | `/api/auth/customer` |
| **Dashboard** | Admin employees managing the store | `/api/auth/dashboard` |

### Customer Flow

```
1. Register       →  POST /api/auth/customer/register
2. Login          →  POST /api/auth/customer/login  →  receive { access_token }
3. Use token      →  Authorization: Bearer {access_token}
   — or —
1. Google OAuth   →  GET  /api/auth/customer/google  →  redirects to Google
2. Callback       →  GET  /api/auth/customer/google/callback  →  receive { access_token }
```

### Dashboard (Employee) Flow

```
1. Register  →  POST /api/auth/dashboard/register
2. Login     →  POST /api/auth/dashboard/login  →  receive { access_token }
3. Use token →  Authorization: Bearer {access_token}
```

### Token Usage

Include the token in the `Authorization` header of every protected request:

```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGci...
```

---

## 📋 Request Headers

Every API request (authenticated or not) **must** include the following headers:

| Header | Value | Required | Description |
|---|---|---|---|
| `apiKey` | Your configured API key (see `.env`) | ✅ Yes | Shared API key — **must** be set via the `apiKey` variable in your `.env` before deploying |
| `Authorization` | `Bearer {token}` | ✅ On protected routes | OAuth 2.0 access token |
| `Accept` | `application/json` | ✅ Recommended | Ensures JSON responses |
| `lang` | `en` or `ar` | ❌ Optional | Response language (default: `en`) |

---

## 📚 API Reference

> **Base URL:** `http://your-domain.com/api`
>
> All endpoints require the `apiKey` header.
> Endpoints marked 🔒 also require the `Authorization: Bearer {token}` header.

---

### 1. Customer Authentication

#### Register

```http
POST /auth/customer/register
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ✅ | Unique username |
| `email` | string | ✅ | Unique email address |
| `password` | string | ✅ | Min 8 characters |
| `password_confirmation` | string | ✅ | Must match `password` |
| `phone` | string | ✅ | Unique phone number |
| `date_of_birth` | date | ✅ | Format: `YYYY-MM-DD` |
| `nick_name` | string | ❌ | Display name |
| `image` | file | ❌ | Profile picture (image file) |

**Response:**
```json
{
    "Data": {
        "access_token": "eyJ0eXAiOiJKV1Qi...",
        "user": { "..." }
    },
    "Status": 201,
    "Messages": "User registered successfully"
}
```

---

#### Login

```http
POST /auth/customer/login
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅* | Customer's email *or* username *or* phone |
| `password` | string | ✅ | Customer's password |

> \* You may login with `email`, `name` (username), or `phone`. Only one identifier is required.

**Response:**
```json
{
    "Data": {
        "access_token": "eyJ0eXAiOiJKV1Qi...",
        "user": { "..." }
    },
    "Status": 200,
    "Messages": "Login successful"
}
```

---

#### Logout 🔒

```http
POST /auth/customer/logout
```

Revokes the current customer's access token.

---

#### Get Authenticated Customer Profile 🔒

```http
GET /auth/customer/profile
```

Returns the currently authenticated customer's profile.

---

#### Check if Email is Already Registered

```http
POST /auth/customer/email
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Email address to check |

---

#### Google OAuth — Redirect

```http
GET /auth/customer/google
```

Redirects the customer to Google's OAuth consent screen.

---

#### Google OAuth — Callback

```http
GET /auth/customer/google/callback
```

Google redirects back to this URL after authentication. Returns an `access_token` on success.

---

#### Send Password Reset Code

```http
POST /auth/customer/password/code/send
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Registered email address |

Sends a numeric reset code to the provided email address.

---

#### Verify Reset Code

```http
POST /auth/customer/password/code/check
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Registered email address |
| `code` | string | ✅ | The code received by email |

---

#### Reset Password

```http
POST /auth/customer/password/reset
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Registered email address |
| `code` | string | ✅ | The verified reset code |
| `new_password` | string | ✅ | New password (min 8 chars) |

---

### 2. Dashboard Authentication

#### Register Employee

```http
POST /auth/dashboard/register
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ✅ | Employee name |
| `email` | string | ✅ | Unique email address |
| `password` | string | ✅ | Min 8 characters |
| `password_confirmation` | string | ✅ | Must match `password` |

---

#### Login Employee

```http
POST /auth/dashboard/login
```

| Field | Type | Required | Description |
|---|---|---|---|
| `email` | string | ✅ | Employee's email |
| `password` | string | ✅ | Employee's password |

---

#### Logout Employee 🔒

```http
POST /auth/dashboard/logout
```

Revokes the current employee's access token.

---

### 3. Customer Management

#### List All Customers 🔒

```http
GET /customer
```

Returns a paginated list of all registered customers.

| Query Param | Type | Description |
|---|---|---|
| `page` | integer | Page number (default: 1) |

---

#### Get Customer by ID 🔒

```http
GET /customer/{id}
```

Returns details for the customer with the given `id`.

---

#### Update Customer Profile 🔒

```http
PUT /customer/update
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ❌ | New username |
| `email` | string | ❌ | New email address |
| `nick_name` | string | ❌ | Display name |
| `phone` | string | ❌ | Phone number |
| `date_of_birth` | date | ❌ | Date of birth |
| `image` | file | ❌ | New profile picture |

---

#### Delete Customer Account 🔒

```http
DELETE /customer/destroy
```

Permanently deletes the authenticated customer's account and all associated data.

---

### 4. Products

#### List All Products 🔒

```http
GET /product
```

Returns a paginated list of all products.

| Query Param | Type | Description |
|---|---|---|
| `page` | integer | Page number (default: 1) |

---

#### Get Product 🔒

```http
GET /product/{id}
```

Returns a single product with its variants and media.

---

#### Create Product 🔒

```http
POST /product
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ✅ | Product name |
| `category_id` | integer | ✅ | ID of the product's category |
| `price` | numeric | ✅ | Product price |
| `description` | string | ❌ | Product description |
| `quantity` | integer | ✅ | Stock quantity |

---

#### Update Product 🔒

```http
PUT /product/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ❌ | Updated product name |
| `category_id` | integer | ❌ | Updated category |
| `price` | numeric | ❌ | Updated price |
| `description` | string | ❌ | Updated description |
| `quantity` | integer | ❌ | Updated stock quantity |

---

#### Delete Product 🔒

```http
DELETE /product/{id}
```

---

#### Search Products 🔒

```http
POST /product/search
```

| Field | Type | Required | Description |
|---|---|---|---|
| `search` | string | ✅ | Search query (matches product name) |

---

#### Get Products by Category 🔒

```http
GET /products/category/{id}
```

Returns a paginated list of products belonging to the category with the given `id`.

---

### 5. Product Colors

#### List Colors for a Product 🔒

```http
GET /product/color
```

---

#### Get Color 🔒

```http
GET /product/color/{id}
```

---

#### Add Color to Product 🔒

```http
POST /product/color
```

| Field | Type | Required | Description |
|---|---|---|---|
| `product_id` | integer | ✅ | ID of the product |
| `color` | string | ✅ | Color name or hex value |

---

#### Update Color 🔒

```http
PUT /product/color/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `color` | string | ✅ | Updated color value |

---

#### Delete Color 🔒

```http
DELETE /product/color/{id}
```

---

### 6. Product Sizes

#### List Sizes for a Product 🔒

```http
GET /product/size
```

---

#### Get Size 🔒

```http
GET /product/size/{id}
```

---

#### Add Size to Product 🔒

```http
POST /product/size
```

| Field | Type | Required | Description |
|---|---|---|---|
| `product_id` | integer | ✅ | ID of the product |
| `size` | string | ✅ | Size label (e.g., `S`, `M`, `L`, `XL`) |

---

#### Update Size 🔒

```http
PUT /product/size/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `size` | string | ✅ | Updated size label |

---

#### Delete Size 🔒

```http
DELETE /product/size/{id}
```

---

### 7. Product Images

#### List Images for a Product 🔒

```http
GET /product/image
```

---

#### Get Image 🔒

```http
GET /product/image/{id}
```

---

#### Upload Product Image 🔒

```http
POST /product/image
```

| Field | Type | Required | Description |
|---|---|---|---|
| `product_id` | integer | ✅ | ID of the product |
| `image` | file | ✅ | Image file to upload |

---

#### Delete Product Image 🔒

```http
DELETE /product/image/{id}
```

---

### 8. Categories

#### List All Categories 🔒

```http
GET /category
```

---

#### Get Category 🔒

```http
GET /category/{id}
```

---

#### Create Category 🔒

```http
POST /category
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ✅ | Category name |
| `image` | file | ❌ | Category image |

---

#### Update Category 🔒

```http
PUT /category/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `name` | string | ❌ | Updated category name |
| `image` | file | ❌ | Updated category image |

---

#### Delete Category 🔒

```http
DELETE /category/{id}
```

---

### 9. Wishlist (Likes)

#### Get Wishlist 🔒

```http
GET /product/like
```

Returns a list of products liked (saved to wishlist) by the authenticated customer.

---

#### Add Product to Wishlist 🔒

```http
POST /product/like
```

| Field | Type | Required | Description |
|---|---|---|---|
| `product_id` | integer | ✅ | ID of the product to like |

---

#### Remove Product from Wishlist 🔒

```http
DELETE /product/like/{id}
```

`{id}` is the ID of the **like record** (not the product ID).

---

### 10. Shopping Cart

#### List Cart Items 🔒

```http
GET /cart/item
```

Returns all items currently in the authenticated customer's cart.

---

#### Get Cart Item 🔒

```http
GET /cart/item/{id}
```

---

#### Add Item to Cart 🔒

```http
POST /cart/item
```

| Field | Type | Required | Description |
|---|---|---|---|
| `product_id` | integer | ✅ | ID of the product |
| `color_id` | integer | ❌ | ID of the chosen color variant |
| `size_id` | integer | ❌ | ID of the chosen size variant |
| `quantity` | integer | ✅ | Number of units |

---

#### Update Cart Item 🔒

```http
PUT /cart/item/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `quantity` | integer | ❌ | Updated quantity |
| `color_id` | integer | ❌ | Updated color variant |
| `size_id` | integer | ❌ | Updated size variant |

---

#### Remove Item from Cart 🔒

```http
DELETE /cart/item/{id}
```

---

#### Checkout Cart 🔒

```http
POST /cart/item/checkout
```

| Field | Type | Required | Description |
|---|---|---|---|
| `address_id` | integer | ✅ | ID of the delivery address |
| `shipping_type_id` | integer | ✅ | ID of the chosen shipping option |

Converts all items in the cart into orders and clears the cart.

---

### 11. Shipping Addresses

#### List Addresses 🔒

```http
GET /shipping/address
```

Returns all saved addresses for the authenticated customer.

---

#### Get Address 🔒

```http
GET /shipping/address/{id}
```

---

#### Get Default Address 🔒

```http
GET /shipping/address/default
```

Returns the customer's currently set default shipping address.

---

#### Create Address 🔒

```http
POST /shipping/address
```

| Field | Type | Required | Description |
|---|---|---|---|
| `title` | string | ✅ | Label for the address (e.g., "Home", "Work") |
| `address` | string | ✅ | Full address string |

---

#### Update Address 🔒

```http
PUT /shipping/address/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `title` | string | ❌ | Updated label |
| `address` | string | ❌ | Updated address string |

---

#### Delete Address 🔒

```http
DELETE /shipping/address/{id}
```

---

#### Set Default Address 🔒

```http
POST /shipping/address/default/set
```

| Field | Type | Required | Description |
|---|---|---|---|
| `address_id` | integer | ✅ | ID of the address to set as default |

---

### 12. Shipping Types

#### List Shipping Types 🔒

```http
GET /shipping/type
```

---

#### Get Shipping Type 🔒

```http
GET /shipping/type/{id}
```

---

#### Create Shipping Type 🔒

```http
POST /shipping/type
```

| Field | Type | Required | Description |
|---|---|---|---|
| `title` | string | ✅ | Shipping option name (e.g., "Standard", "Express") |
| `price` | numeric | ✅ | Shipping cost |
| `minNumberDaysToArrival` | integer | ✅ | Minimum estimated delivery days |
| `maxNumberDaysToArrival` | integer | ✅ | Maximum estimated delivery days |

---

#### Update Shipping Type 🔒

```http
PUT /shipping/type/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `title` | string | ❌ | Updated name |
| `price` | numeric | ❌ | Updated price |
| `minNumberDaysToArrival` | integer | ❌ | Updated minimum days |
| `maxNumberDaysToArrival` | integer | ❌ | Updated maximum days |

---

#### Delete Shipping Type 🔒

```http
DELETE /shipping/type/{id}
```

---

### 13. Orders

#### List Orders 🔒

```http
GET /order
```

Returns a paginated list of orders (customers see their own; employees see all).

| Query Param | Type | Description |
|---|---|---|
| `page` | integer | Page number (default: 1) |

---

#### Get Order 🔒

```http
GET /order/{id}
```

Returns details for a single order.

---

#### Create Order 🔒

```http
POST /order
```

| Field | Type | Required | Description |
|---|---|---|---|
| `product_id` | integer | ✅ | ID of the product |
| `color_id` | integer | ❌ | ID of the chosen color |
| `size_id` | integer | ❌ | ID of the chosen size |
| `address_id` | integer | ✅ | ID of the delivery address |
| `shipping_type_id` | integer | ✅ | ID of the shipping option |
| `quantity` | integer | ✅ | Number of units |

---

#### Update Order 🔒

```http
PUT /order/{id}
```

| Field | Type | Required | Description |
|---|---|---|---|
| `status_id` | integer | ❌ | New order status ID |
| `address_id` | integer | ❌ | Updated delivery address |

---

#### Cancel / Delete Order 🔒

```http
DELETE /order/{id}
```

---

#### Get Completed Orders 🔒

```http
GET /order/complete
```

Returns a list of all orders with a completed/delivered status.

---

#### Process Order 🔒

```http
POST /order/process
```

| Field | Type | Required | Description |
|---|---|---|---|
| `order_id` | integer | ✅ | ID of the order to process |

Advances the order to the next processing stage.

---

## 📦 Response Format

All API responses follow a unified structure:

```json
{
    "Data": {},
    "Status": 200,
    "Messages": "A descriptive success or error message"
}
```

| Field | Type | Description |
|---|---|---|
| `Data` | object / array / null | The response payload. `null` for operations with no return data. |
| `Status` | integer | HTTP-equivalent status code |
| `Messages` | string / object | Human-readable message or validation error details |

### Common Status Codes

| Code | Meaning |
|---|---|
| `200` | OK — Request succeeded |
| `201` | Created — Resource created successfully |
| `422` | Unprocessable Entity — Validation failed |
| `401` | Unauthorized — Missing or invalid API key / Bearer token |
| `403` | Forbidden — Authenticated but not permitted |
| `404` | Not Found — Resource does not exist |
| `500` | Internal Server Error |

### Example: Validation Error (422)

```json
{
    "Data": null,
    "Status": 422,
    "Messages": {
        "email": ["The email has already been taken."],
        "password": ["The password must be at least 8 characters."]
    }
}
```

---

## 🗄 Database Schema

The application uses the following core database tables:

| Table | Description |
|---|---|
| `users` | Customer accounts (name, email, phone, date_of_birth, image, google_id, etc.) |
| `employees` | Dashboard employee accounts (name, email, password) |
| `categories` | Product categories (name, image) |
| `products` | Product catalog (name, category_id, price, description, quantity) |
| `colors` | Product color variants (color, product_id) |
| `sizes` | Product size variants (size, product_id) |
| `images` | Product images (image, product_id) |
| `carts` | Shopping carts (user_id) |
| `cart_items` | Items in a cart (cart_id, product_id, color_id, size_id, quantity) |
| `likes` | Wishlist records (user_id, product_id) |
| `addresses` | Customer shipping addresses (user_id, title, address, default) |
| `orders` | Customer orders (user_id, product_id, color_id, size_id, address_id, status_id, shippingType_id, quantity) |
| `statuses` | Order status definitions (status label) |
| `shipping_types` | Shipping options (title, price, minNumberDaysToArrival, maxNumberDaysToArrival) |
| `reset_code_passwords` | Password reset codes (user_id, code) |
| `oauth_access_tokens` | Laravel Passport OAuth tokens |

---

## 🌍 Localization

The API supports **English** (`en`) and **Arabic** (`ar`). All validation messages, success messages, and error responses are translated.

To select a language, include the `lang` header in your request:

```
lang: ar
```

or

```
lang: en
```

If the header is omitted, the API defaults to **English**.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
