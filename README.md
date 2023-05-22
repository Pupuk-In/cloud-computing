# API Spec

## API
https://auth-api-ocgnabibnq-et.a.run.app/api

## Authentication

### Register

- Endpoint :
    - /auth/signup
- Method :
    - POST
- Header :
    - Content-Type: application/json
    - Accept: application/json
- Body :
```json 
{
    "username" : "string, no whistespace, alphanumeric, required",
    "email" : "string, email, required",
    "password" : "string, min:8, required",
    "password_confirmation" : "string, required"
}
```
- Response :
```json 
{
    "message" : "User created successfully"
}
```

### Login

All API must use this authentication
- Endpoint :
    - /auth/login
- Method :
    - POST
- Header :
    - Content-Type: application/json
    - Accept: application/json
- Body :
```json 
{
    "email" : "string, required",
    "password" : "string, required"
}
```
- Response :
```json 
{
    "message" : "User logged in successfully",
    "user" : 
    {
        "id": "integer",
        "email": "string",
        "email_verified_at": "string",
        "created_at": "datetime",
        "updated_at": "datetime",
        "access_token": "string"
    }
}
```

### Logout

- Endpoint :
    - /auth/logout
- Method :
    - GET
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Parameters :
    - 
- Response :
```json 
{
    "message" : "User logged out successfully"
}
```

### Profile

- Endpoint :
    - /user/profiles
- Method :
    - PATCH
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "name" : "string",
    "picture" : "string",
    "birth_date" : "date",
    "age" : "integer",
    "address" : "string",
    "phone_number" : "string"
}
```
- Response :
```json 
{
    "profile": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "birth_date": "date, format: yyyy-mm-dd",
        "age": "age",
        "address": "string",
        "phone_number": "string",
        "user_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
    }
}
```



# DIBAWAH INI BELUM DITERAPKAN SEMUA APINYA (WIP)
# Home Screen

## Get Items on Home Screen

### Get All Fertilizer Types

- Endpoint :
    - /fertilizerTypes
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - 
- Response :
```json 
{
    "message" : "Fertilizer Types fetched successfully",
    "types" : 
    {
        "id" : "integer",
        "name" : "string",
        "picture" : "string, URL"
    }
}
```

### Get All Plants

- Endpoint :
    - /plants
- Method :
    - GET
- Header :
    - Accept: application/json
 - Parameters :
    - 
- Response :
```json 
{
    "message" : "Plants fetched successfully",
    "plants" : 
    {
        "id" : "integer",
        "name" : "string",
        "picture" : "string, URL",
        "soils_id" : "integer"
    }
}
```


# Search Page

## Card Item Lists

### Get All Items

- Endpoint :
    - /items
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - page as int, optional
    - size as int, optional
    - query as string
    - price as int
    - type as string
    - plant as string
    - part as string
    - soil as string
    - sort_by as string
- Response :
```json 
{
    "message" : "Items fetched successfully",
    "items" : 
    {
        "id" : "integer",
        "name" : "string",
        "picture" : "string, URL",
        "description" : "string, longtext",
        "price" : "integer",
        "stock" : "integer",
        "rating" : "float",
        "type" : "string",
        "plant" : "string",
        "part" : "string"
    }
}
```


# Item Detail Page

## Item Details

### Get Details of Clicked Items

- Endpoint :
    - /items/:id
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - 
- Response :
```json 
{
    "message" : "Item Details fetched successfully",
    "items" : 
    {
        "id" : "integer",
        "name" : "string",
        "picture" : "string, URL",
        "description" : "string, longtext",
        "price" : "integer",
        "stock" : "integer",
        "rating" : "float",
        "type" : "string",
        "plant" : "string",
        "part" : "string"
    }
}
```


# Cart Items Page

## Lists of Items in Cart

### Get All Items

- Endpoint :
    - /carts
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - 
- Response :
```json 
{
    "message" : "Cart items fetched successfully",
    "carts" : "items" : 
    {
        {
            "id" : "integer",
            "name" : "string",
            "picture" : "string, URL",
            "description" : "string, longtext",
            "price" : "integer",
            "stock" : "integer",
            "rating" : "float",
            "type" : "string",
            "plant" : "string",
            "part" : "string"
        }
    }
}
```


# Wishlisted Items Page

## Lists of Items in Wishlists

### Get All Items

- Endpoint :
    - /wishlists
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - 
- Response :
```json 
{
    "message" : "Cart items fetched successfully",
    "wishlists" : "items" : 
    {
        {
            "id" : "integer",
            "name" : "string",
            "picture" : "string, URL",
            "description" : "string, longtext",
            "price" : "integer",
            "stock" : "integer",
            "rating" : "float",
            "type" : "string",
            "plant" : "string",
            "part" : "string"
        }
    }
}
```


# Store Page

## Seller POV

### Create Store Profile

- Endpoint :
    - /stores/create
- Method :
    - Post
- Header :
    - Content-Type: application/json
    - Accept: application/json
- Body :
```json 
{
    "name" : "string",
    "picture" : "string, URL",
    "address" : "string, longtext",
    "latitude" : "double",
    "longitude" : "double",
    "description" : "string, longtext"
}
```
- Response :
```json 
{
    "message" : "Store created successfully"
}
```


## Buyer POV

### Store Profile

- Endpoint :
    - /stores/:id
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - stores_id as int
    - page as int, optional
    - size as int, optional
- Response :
```json 
{
    "message" : "Store page fetched successfully",
    "stores" : 
    {
        "name" : "string",
        "picture" : "string, URL",
        "address" : "string, longtext",
        "latitude" : "double",
        "longitude" : "double",
        "description" : "string, longtext",
        "rating" : "double"
    },
    "items" :
    {
        "id" : "integer",
        "name" : "string",
        "picture" : "string, URL",
        "description" : "string, longtext",
        "price" : "integer",
        "stock" : "integer",
        "rating" : "float",
        "type" : "string",
        "plant" : "string",
        "part" : "string",
    }
}
```
