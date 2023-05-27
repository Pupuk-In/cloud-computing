# API Spec

## Authentication

### Register

- Endpoint :
    - /signup
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
    "password" : "string, min:8, required"
}
```
- Response :
```json 
{
    "message" : "User created successfully"
}
```

### Login

- Endpoint :
    - /login
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
    - /logout
- Method :
    - GET
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "message" : "User logged out successfully"
}
```

### Reset Password

- Endpoint :
    - /reset-password
- Method :
    - POST
- Header :
    - Content-Type: application/json
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "old_password" : "string, required",
    "new_password" : "string, required, min:6",
    "confirm_password" : "string, required, same: new_password"
}
```
- Response :
```json 
{
    "message" : "Password updated successfully.",
}
```


# Profile Page Screen

## User Profile

### User Profile View

- Endpoint :
    - /users
- Method :
    - GET
- Header :
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "message": "Profile fetched successfully.",
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
        "updated_at": "datetime"
    }
}
```

### User Profile Edit

- Endpoint :
    - /users
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
    "message": "Profile updated successfully.",
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
        "updated_at": "datetime"
    }
}
```


# Home Screen

## Get Items on Home Screen

### Get All Fertilizer Types

- Endpoint :
    - /home/types
- Method :
    - GET
- Response :
```json 
{
    "message" : "Fertilizer types fetched successfully.",
    "type" : 
    {
        "id" : "integer",
        "name" : "string",
        "picture" : "string, URL",
        "created_at": "datetime",
        "updated_at": "datetime"
    }
}
```

### Get All Plants

- Endpoint :
    - /plants
- Method :
    - GET
- Response :
```json 
{
    "message" : "Plants fetched successfully.",
    "plants" : 
    {
        "id" : "integer",
        "name" : "string",
        "picture" : "string, URL",
        "soils_id" : "integer"
    }
}
```


# Store Page Screen

## Store View

### Store Details Page View

- Endpoint :
    - /stores/:id
- Method :
    - GET
- Response :
```json 
{
    "message": "Store details fetched successfully",
    "store": {
        "id": "integer",
        "name": "string",
        "picture" : "string",
        "address": "string",
        "latitude": "double",
        "longitude": "double",
        "description": "string",
        "rating": "float",
        "profile_id": "integer",
        "updated_at": "datetime",
        "created_at": "datetime",
    }
}
```

Ctt: Jika {id} tidak diisi pada endpoint, maka akan mengembalikan response berupa toko milik akun yang sedang login.

### Create New Store

- Endpoint :
    - /stores
- Method :
    - POST
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "name": "string, required, unique",
    "picture" : "string",
    "address": "string, required",
    "latitude": "double, required",
    "longitude": "double, required",
    "description": "string",
}
```
- Response :
```json 
{
    "message": "Store created successfully",
    "store": {
        "id": "integer",
        "name": "string",
        "picture" : "string",
        "address": "string",
        "latitude": "double",
        "longitude": "double",
        "description": "string",
        "rating": "float",
        "profile_id": "integer",
        "updated_at": "datetime",
        "created_at": "datetime",
    }
}
```

### Update Store Profile

- Endpoint :
    - /stores
- Method :
    - PATCH
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "name": "string, required, unique",
    "picture" : "string",
    "address": "string, required",
    "latitude": "double, required",
    "longitude": "double, required",
    "description": "string",
}
```
- Response :
```json 
{
    "message": "Store updated successfully",
    "store": {
        "id": "integer",
        "name": "string",
        "picture" : "string",
        "address": "string",
        "latitude": "double",
        "longitude": "double",
        "description": "string",
        "rating": "float",
        "profile_id": "integer",
        "updated_at": "datetime",
        "created_at": "datetime",
    }
}
```


# Item Page

## Buyer POV

### Get All Active Items

- Endpoint :
    - /stores/items/actives
- Method :
    - GET
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```

### Item Details Page

- Endpoint :
    - /stores/items/:id
- Method :
    - GET
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```


## Seller POV

### Get All Inactive Items

- Endpoint :
    - /stores/items/inactives
- Method :
    - GET
- Header :
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```

### Get All Active and Inactive Items

- Endpoint :
    - /stores/items/getall
- Method :
    - GET
- Header :
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```


### Create New Items

- Endpoint :
    - /stores/items
- Method :
    - POST
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "item": {
        "name": "string, required",
        "picture": "string",
        "description": "text, required",
        "price": "integer, required",
        "stock": "integer, required",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer"
    }
}
```
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```

### Update Item Details

- Endpoint :
    - /stores/items/:id
- Method :
    - PATCH
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "name": "string, required",
    "picture": "string",
    "description": "text, required",
    "price": "integer, required",
    "stock": "integer, required",
    "relevance": "text",
    "brand": "string",
    "type_id": "integer",
    "plant_part_id": "integer"
}
```
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```

### Soft Delete Items

- Endpoint :
    - /stores/items/del/:id
- Method :
    - DELETE
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```

### Restore Soft Deleted Items

- Endpoint :
    - /stores/items/restore/:id
- Method :
    - PATCH
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string",
        "description": "text",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "type_id": "integer",
        "plant_part_id": "integer",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```

### Permanently Delete Items from Table

- Endpoint :
    - /stores/items/permdel/:id
- Method :
    - DELETE
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "message": "Item deleted permanently"
}
```




# DIBAWAH INI BELUM DITERAPKAN SEMUA APINYA (WIP)

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
    "message" : "Item details fetched successfully",
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
        "test" : "test"
    }
}
```
