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
    "password" : "string, min:8, required",
}
```
- Response :
```json 
{
    "message" : "User created successfully."
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
    "message" : "User logged in successfully.",
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
    "message" : "User logged out successfully."
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
        "picture": "string, url",
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
    "name": "string",
    "picture": "string, url",
    "birth_date": "date",
    "age": "integer",
    "address": "string",
    "phone_number": "string"
}
```
- Response :
```json 
{
    "message": "Profile updated successfully.",
    "profile": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
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

## Get on Home Screen

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

### Update Store Details

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


### Store Details View

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

### Store Catalogs

- Endpoint :
    - /stores/:id/catalogs
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - page as int, optional
- Response :
```json 
{
    "message": "Store catalogs fetched successfully.",
    "store": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "address": "string",
        "latitude": "double",
        "longitude": "double",
        "description": "text",
        "rating": "float",
        "profile_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime"
    },
    "catalog": {
        "current_page": "integer",
        "data": [
            {
                "id": "integer",
                "name": "string",
                "picture": "string, url",
                "description": "text",
                "type_id": "integer",
                "price": "integer",
                "stock": "integer",
                "sold": "integer",
                "rating": "float",
                "relevance": "string",
                "brand": "string",
                "store_id": "integer",
                "created_at": "datetime",
                "updated_at": "datetime",
                "deleted_at": "datetime"
            },
        ],
        "first_page_url": "string, url",
        "from": "integer",
        "last_page": "integer",
        "last_page_url": "string, url",
        "links": [
            {
                "url": "string, url",
                "label": "string or integer",
                "active": "boolean"
            },
        ],
        "next_page_url": "string, url",
        "path": "string, url",
        "per_page": "integer",
        "prev_page_url": "string, url",
        "to": "integer",
        "total": "integer"
    }
}
```



# Items CRUD

## Buyer POV

### Get All Active Items

- Endpoint :
    - /stores/items/actives
- Method :
    - GET
- Response :
```json 
{
    "message": "All active items fetched successfully.",
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": [{
            "id": "integer",
            "name": "string"
        }],
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": {
            "id": "integer",
            "name": "string",
            "address": "string",
            "rating": "float"
        },
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "plants": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_parts": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
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
    "message": "Item details fetched successfully",
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": [{
            "id": "integer",
            "name": "string"
        }],
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": {
            "id": "integer",
            "name": "string",
            "address": "string",
            "rating": "float"
        },
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "plants": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_parts": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
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
    "message": "All inactive items fetched successfully.",
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": [{
            "id": "integer",
            "name": "string"
        }],
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": {
            "id": "integer",
            "name": "string",
            "address": "string",
            "rating": "float"
        },
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "plants": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_parts": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
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
    "message": "All items fetched successfully.",
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": [{
            "id": "integer",
            "name": "string"
        }],
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": {
            "id": "integer",
            "name": "string",
            "address": "string",
            "rating": "float"
        },
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "plants": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_parts": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
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
        "picture": "string, url",
        "description": "text, required",
        "type_id": "integer, required",
        "price": "integer, required",
        "stock": "integer, required",
        "relevance": "text",
        "brand": "string",
        "plant_id": "array of integer, required",
        "plant_part_id": "array of integer, required"
    }
}
```
- Response :
```json 
{
    "message": "Item created successfully.",
    "Item": {
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "brand": "keren",
        "store_id": "integer",
        "sold": "integer",
        "rating": "float",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer",
        "plant_id": "array of integer",
        "plant_part_id": "array of integer"
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
    "picture": "string, url",
    "description": "text, required",
    "type_id": "integer, required",
    "price": "integer, required",
    "stock": "integer, required",
    "relevance": "text",
    "brand": "string",
    "plant_id": "array of integer, required",
    "plant_part_id": "array of integer, required"
}
```
- Response :
```json 
{
    "message": "Item created successfully.",
    "Item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "string",
        "brand": "keren",
        "store_id": "integer",
        "updated_at": "datetime",
        "created_at": "datetime",
        "deleted_at": "datetime",
        "plant_id": "array of integer",
        "plant_part_id": "array of integer"
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
        "picture": "string, url",
        "description": "text",
        "type_id": [{
            "id": "integer",
            "name": "string"
        }],
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": {
            "id": "integer",
            "name": "string",
            "address": "string",
            "rating": "float"
        },
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "plants": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_parts": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
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
        "picture": "string, url",
        "description": "text",
        "type_id": [{
            "id": "integer",
            "name": "string"
        }],
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": {
            "id": "integer",
            "name": "string",
            "address": "string",
            "rating": "float"
        },
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "plants": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_parts": [{
            "id": "integer",
            "name": "string",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
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
    "message": "Item deleted permanently."
}
```

# Categories

## Types

### Get all types

- Endpoint :
    - /types
- Method :
    - GET
- Response :
```json 
{
    "message": "All types fetched successfully.",
    "type": [
        {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        },
    ]
}
```

## Plants

### Get all plants

- Endpoint :
    - /plants
- Method :
    - GET
- Response :
```json 
{
    "message": "All plants fetched successfully.",
    "plant": [
        {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        },
    ]
}
```

## Plant Parts

### Get all plant parts

- Endpoint :
    - /plant-parts
- Method :
    - GET
- Response :
```json 
{
    "message": "All plant parts fetched successfully.",
    "plant_part": [
        {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        },
    ]
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
