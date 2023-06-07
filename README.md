# API Spec

# Lists
- [Authentication](#authentication)
    - [Register](#register)
    - [Login](#login)
    - [Logout](#logout)
    - [Reset Password](#reset-password)
- [Profiles CRUD](#profile-crud)
    - [Read Profile Details](#read-user-profile)
    - [Update Profile Details](#update-user-profile)
- [Stores CRUD](#store-crud)
    - [Create New Store](#create-new-store)
    - [Read Store Details](#read-store-details)
    - [Read Store Catalogs](#read-store-catalogs)
    - [Update Store Details](#update-store-details)
- [Home Page CRUD](#home-page-crud)
    - [Read 10 Random Types](#read-10-random-fertilizer-types)
    - [Read 5 Random Plants](#read-5-random-plants)
- [Items CRUD](#items-crud)
    - [Create New Item](#create-new-items)
    - [Read All Active Items](#read-all-active-items)
    - [Read All Inactive Items](#read-all-inactive-items)
    - [Read All Active and Inactive Items](#read-all-active-and-inactive-items)
    - [Update Item Details](#update-item-details)
    - [Soft Delete Item](#soft-delete-items)
    - [Restore Soft Deleted Item](#restore-soft-deleted-items)
    - [Permanent Delete Item](#permanently-delete-items-from-table)
- [Images CRUD](#images-crud)
    - [Create New Image](#create-image)
    - [Delete Image](#delete-image)
- [Wishlists CRUD](#wishlists-crud)
    - [Create New Item to Wishlist](#create-new-item-to-wishlist)
    - [Read All Items on Wishlist](#read-all-wishlisted-items-can-be-queried)
    - [Delete Item from Wishlist](#delete-item-from-wishlist)
- [Carts CRUD](#carts-crud)
    - [Create new Item to Cart](#add-new-item-to-cart)
    - [Read All Items on Cart](#read-all-items-on-cart)
    - [Update Item from Cart](#update-item-from-cart)
    - [Delete item from Cart](#delete-item-from-cart)
- [Search Query](#searchquery-page)
- [Types CRUD](#types-crud)
    - [Create New Type](#create-new-type)
    - [Read All Types](#read-all-types)
    - [Update Type](#update-type)
    - [Delete Type](#delete-type)
- [Plants CRUD](#plants-crud)
    - [Create New Plant](#create-new-plant)
    - [Read All Plants](#read-all-plants)
    - [Update Plant](#update-plant)
    - [Delete Plant](#delete-plant)
- [Plant Parts CRUD](#plant-parts-crud)
    - [Create New Plant Part](#create-new-plant-part)
    - [Read All Plant Parts](#read-all-plant-parts)
    - [Update Plant Part](#update-plant-part)
    - [Delete Plant Part](#delete-plant-part)
- [Soils CRUD](#soils-crud)
    - [Create New Soil](#create-new-soil)
    - [Read All Soils](#read-all-soils)
    - [Update Soil](#update-soil)
    - [Delete Soil](#delete-soil)

<br>
<br>
<br>

# Authentication

## Register

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
<br>

## Login

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
<br>

## Logout

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
<br>

## Reset Password

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

<br>
<br>

# Profile CRUD

## Read User Profile

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
        "updated_at": "datetime",
        "username": "string"
    }
}
```
<br>

## Update User Profile

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

<br>
<br>

# Store CRUD

## Create New Store

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
<br>

## Read Store Details

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
`Ctt:
Jika {id} tidak diisi pada endpoint, maka akan mengembalikan response berupa toko milik akun yang sedang login.`

<br>

## Read Store Catalogs

- Endpoint :
    - /stores/:id/catalogs
- Method :
    - GET
- Header :
    - Accept: application/json
- Parameters :
    - filter[name] as string, partial query
    - filter[type] as integer, exact query
    - filter[plant] as integer, exact query
    - filter[part] as integer, exact query
    - filter[price] as integer, range of price, ex value =50000-90000
    - sort as string, input should be 'name', 'price', 'created_at', add - for DESC order
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
        "distance": "double",
        "description": "text",
        "rating": "float",
        "profile_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime"
    },
    "catalog": {
        "current_page": "integer",
        "data": [{
            "item": {
                "id": "integer",
                "name": "string",
                "picture": "string, url",
                "description": "text",
                "type_id": "integer",
                "price": "integer",
                "stock": "integer",
                "sold": "integer",
                "rating": "float",
                "relevance": "text",
                "brand": "string",
                "store_id": "integer",
                "created_at": "datetime",
                "updated_at": "datetime",
                "deleted_at": "datetime",
                "picture": [{
                    "id": "integer",
                    "item_id": "integer",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime"
                }],
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
                    "updated_at": "datetime",
                },
                "type": {
                    "id": "integer",
                    "name": "string",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime",
                },
                "plant": [{
                    "id": "integer",
                    "name": "string",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime",
                    "pivot": {
                        "item_id": "integer",
                        "plant_id": "integer"
                    }
                }],
                "plant_part": [{
                    "id": "integer",
                    "name": "string",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime",
                    "pivot": {
                        "item_id": "integer",
                        "plant_part_id": "integer"
                    }
                }]
            }
        }],
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
<br>

## Update Store Details

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
    "picture" : "string, url",
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

<br>
<br>

# Home Page CRUD

## Read 10 Random Fertilizer Types

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
<br>

## Read 5 Random Plants

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

<br>
<br>

# Items CRUD

## Create New Items

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
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Read All Active Items

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
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Read All Inactive Items

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
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Read All Active and Inactive Items

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
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Read Item Details Page

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
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Update Item Details

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
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Soft Delete Items

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
    "message": "Item soft deleted successfully.",
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Restore Soft Deleted Items

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
    "message": "Item restored successfully.",
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime",
        "picture": [{
            "id": "integer",
            "item_id": "integer",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime"
        }],
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
            "updated_at": "datetime",
        },
        "type": {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
        },
        "plant": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_id": "integer"
            }
        }],
        "plant_part": [{
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "created_at": "datetime",
            "updated_at": "datetime",
            "pivot": {
                "item_id": "integer",
                "plant_part_id": "integer"
            }
        }]
    }
}
```
<br>

## Permanently Delete Items from Table

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

<br>
<br>

# Images CRUD

## Create Image
- Endpoint :
    - /images
- Method :
    - POST
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "picture": "file"
}
```
- Response :
```json 
{
    "message": "File uploaded successfully.",
    "file": {
        "name": "string",
        "url": "string, udl"
    }
}
```
<br>

## Delete Image
- Endpoint :
    - /images
- Method :
    - DELETE
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "picture": "filename OR file URL"
}
```
- Response :
```json 
{
    "message": "File deleted successfully.",
    "name": "ab6761610000e5eb45f6762cc91177b960e7ca2b_647c66fc48a47.jpg"
}
```

<br>
<br>

# Wishlists CRUD

## Create New Item to Wishlist

- Endpoint :
    - /wishlists
- Method :
    - POST
- Header :
    - Content-Type: application/json
    - Accept: application/json
- Body :
```json 
{
    "item_id" : "integer, required",
}
```
- Response :
```json 
{
    "message": "Item added to wishlist successfully.",
    "wishlist": {
        "item_id": "integer",
        "profile_id": "integer",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    },
    "item": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "type_id": "integer",
        "price": "integer",
        "stock": "integer",
        "sold": "integer",
        "rating": "float",
        "relevance": "text",
        "brand": "string",
        "store_id": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "deleted_at": "datetime"
    }
}
```
<br>

## Read All Wishlisted Items (can be queried)

- Endpoint :
    - /wishlists
- Method :
    - GET
- Header :
    - Authorization: Bearer <access_token>
- Parameters :
    - search as string, partial query
    - type as integer, exact query
    - plant as integer, exact query
    - part as integer, exact query
    - price as integer, range of price, ex: price=5000-9000
    - sort as string, input should be 'name', 'price', 'created_at'
    - order as string, either 'desc' or 'asc', default 'desc' if not defined
    - perPage as int, item shown per page, default 10 if not defined
    - page as int, pagination page number, default 1 if not defined
- Response :
```json 
{
    "message" : "Wishlisted items fetched successfully",
    "wishlist" : {
        "current_page": "integer",
        "data": [{
            "id": "integer",
            "name": "string",
            "description": "text",
            "type_id": "integer",
            "price": "integer",
            "stock": "integer",
            "sold": "integer",
            "rating": "float",
            "relevance": "text",
            "brand": "string",
            "store_id": "integer",
            "created_at": "datetime",
            "updated_at": "datetime",
            "deleted_at": "datetime",
            "date_added": "datetime",
            "picture": [{
                    "id": "integer",
                    "item_id": "integer",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime"
            }],
            "store": {
                    "id": "integer",
                    "name": "string",
                    "picture": "string, url",
                    "address": "string",
                    "latitude": "double",
                    "longitude": "double",
                    "distance": "double",
                    "description": "text",
                    "rating": "float",
                    "profile_id": "integer",
                    "created_at": "datetime",
                    "updated_at": "datetime"
            },
            "type": {
                "id": "integer",
                "name": "string",
                "picture": "string",
                "created_at": "datetime",
                "updated_at": "datetime"
            },
            "plant": [{
                "id": "integer",
                "name": "string",
                "picture": "string, url",
                "created_at": "datetime",
                "updated_at": "datetime",
                "pivot": {
                    "item_id": "integer",
                    "plant_id": "integer"
                }
            }],
            "plant_part": [{
                "id": "integer",
                "name": "string",
                "picture": "string, url",
                "created_at": "datetime",
                "updated_at": "datetime",
                "pivot": {
                    "item_id": "integer",
                    "plant_part_id": "integer"
                }
            }]
        }],
        "first_page_url": "string, url",
        "from": "integer",
        "last_page": "integer",
        "last_page_url": "string, url",
        "links": [
            {
                "url": "string, url",
                "label": "string",
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
<br>

## Delete Item from Wishlist

- Endpoint :
    - /wishlists/:id
- Method :
    - DELETE
- Header :
    - Content-Type: application/json
    - Accept: application/json
- Response :
```json 
{
    "message": "Item removed from wishlist successfully.",
}
```

<br>
<br>

# Carts CRUD

## Create New Item to Cart

- Endpoint :
    - /carts
- Method :
    - POST
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "item_id": "integer",
    "quantity": "integer"
}
```
- Response :
```json 
{
    "message": "Item added to cart successfully.",
    "cart": {
        "id": "integer",
        "cart_id": "integer",
        "item_id": "integer",
        "quantity": "integer",
        "price": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "item": {
            "id": "integer",
            "name": "string",
            "description": "text",
            "type_id": "integer",
            "price": "integer",
            "stock": "integer",
            "sold": "integer",
            "rating": "float",
            "relevance": "text",
            "brand": "string",
            "store_id": "integer",
            "created_at": "datetime",
            "updated_at": "datetime",
            "deleted_at": "datetime"
        }
    }
}
```
<br>

## Read All Items on Cart

- Endpoint :
    - /carts
- Method :
    - GET
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "message": "Cart items fetched successfully.",
    "cart": {
        "id": "integer",
        "profile_id": "integer",
        "total": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "cart_item": [
            {
                "id": "integer",
                "cart_id": "integer",
                "item_id": "integer",
                "quantity": "integer",
                "price": "integer",
                "created_at": "datetime",
                "updated_at": "datetime",
                "item": {
                    "id": "integer",
                    "name": "string",
                    "description": "text",
                    "type_id": "integer",
                    "price": "integer",
                    "stock": "integer",
                    "sold": "integer",
                    "rating": "float",
                    "relevance": "string",
                    "brand": "text",
                    "store_id": "integer",
                    "updated_at": "datetime",
                    "created_at": "datetime",
                    "deleted_at": "datetime",
                    "picture": [
                        {
                            "id": "integer",
                            "item_id": "integer",
                            "picture": "string, url",
                            "created_at": "datetime",
                            "updated_at": "datetime"
                        },
                    ],
                    "store": {
                        "id": "integer",
                        "name": "string",
                        "picture": "string, url",
                        "address": "string",
                        "latitude": "double",
                        "longitude": "double",
                        "distance": "double",
                        "description": "text",
                        "rating": "float",
                        "profile_id": "integer",
                        "created_at": "datetime",
                        "updated_at": "datetime"
                    }
                }
            }
        ]
}
```
<br>

## Update Item from Cart

- Endpoint :
    - /carts/:id
- Method :
    - PATCH
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Body :
```json 
{
    "quantity": "integer"
}
```
- Response :
```json 
{
    "message": "Item updated successfully.",
    "cart": {
        "id": "integer",
        "cart_id": "integer",
        "item_id": "integer",
        "quantity": "integer",
        "price": "integer",
        "created_at": "datetime",
        "updated_at": "datetime",
        "item": {
            "id": "integer",
            "name": "string",
            "description": "text",
            "type_id": "integer",
            "price": "integer",
            "stock": "integer",
            "sold": "integer",
            "rating": "float",
            "relevance": "text",
            "brand": "string",
            "store_id": "integer",
            "created_at": "datetime",
            "updated_at": "datetime",
            "deleted_at": "datetime"
        }
    }
}
```
<br>

### Delete Item from Cart

- Endpoint :
    - /carts/:id
- Method :
    - DELETE
- Header :
    - Accept: application/json
    - Authorization: Bearer <access_token>
- Response :
```json 
{
    "message": "Item deleted from cart successfully."
}
```

<br>
<br>

# Search/Query Page

## Query Items with Filters

- Endpoint :
    - /search/items
- Method :
    - GET
- Parameters :
    - search as string, partial query
    - type as integer, exact query
    - plant as integer, exact query
    - part as integer, exact query
    - price as integer, range of price, ex: price=5000-9000
    - sort as string, input should be 'name', 'price', 'created_at'
    - order as string, either 'desc' or 'asc', default 'desc' if not defined
    - perPage as int, item shown per page, default 10 if not defined
    - page as int, pagination page number, default 1 if not defined
- Response :
```json 
{
    "message" : "Item list fetched successfully",
    "items" : 
    {
        "current_page": "integer",
        "data": [{
            "item": {
                "id": "integer",
                "name": "string",
                "picture": "string, url",
                "description": "text",
                "type_id": "integer",
                "price": "integer",
                "stock": "integer",
                "sold": "integer",
                "rating": "float",
                "relevance": "text",
                "brand": "string",
                "store_id": "integer",
                "created_at": "datetime",
                "updated_at": "datetime",
                "deleted_at": "datetime",
                "picture": [{
                    "id": "integer",
                    "item_id": "integer",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime"
                }],
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
                    "updated_at": "datetime",
                },
                "type": {
                    "id": "integer",
                    "name": "string",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime",
                },
                "plant": [{
                    "id": "integer",
                    "name": "string",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime",
                    "pivot": {
                        "item_id": "integer",
                        "plant_id": "integer"
                    }
                }],
                "plant_part": [{
                    "id": "integer",
                    "name": "string",
                    "picture": "string, url",
                    "created_at": "datetime",
                    "updated_at": "datetime",
                    "pivot": {
                        "item_id": "integer",
                        "plant_part_id": "integer"
                    }
                }]
            }
        }],
        "first_page_url": "string, url",
        "from": "integer",
        "last_page": "integer",
        "last_page_url": "string, url",
        "links": [
            {
                "url": "string, url",
                "label": "string",
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

<br>
<br>

# Types CRUD

## Create New Type

- Endpoint :
    - /types
- Method :
    - POST
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url"
}
```
- Response :
```json 
{
    "message": "Type created successfully.",
    "type": {
        "name": "string",
        "picture": "string, url",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    }
}
```
<br>

## Read All Types

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
<br>

## Update Type

- Endpoint :
    - /types/:id
- Method :
    - PATCH
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url"
}
```
- Response :
```json 
{
    "message": "Type updated successfully.",
    "type": {
        "name": "string",
        "picture": "string, url",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    }
}
```
<br>

## Delete Type

- Endpoint :
    - /types/:id
- Method :
    - DELETE
- Header :
    - Accept: application/json
- Response :
```json 
{
    "message": "Type deleted successfully."
}
```

<br>
<br>

# Plants CRUD

## Create New Plant

- Endpoint :
    - /plants
- Method :
    - POST
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url"
}
```
- Response :
```json 
{
    "message": "Plant created successfully.",
    "plant": {
        "name": "string",
        "picture": "string, url",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    }
}
```
<br>

## Read All Plants

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
<br>

## Update Plant

- Endpoint :
    - /plants/:id
- Method :
    - PATCH
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url"
}
```
- Response :
```json 
{
    "message": "Plant updated successfully.",
    "plant": {
        "name": "string",
        "picture": "string, url",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    }
}
```
<br>

## Delete Plant

- Endpoint :
    - /plants/:id
- Method :
    - DELETE
- Header :
    - Accept: application/json
- Response :
```json 
{
    "message": "Plant deleted successfully."
}
```

<br>
<br>

# Plant Parts CRUD

## Create New Plant Part

- Endpoint :
    - /plant-parts
- Method :
    - POST
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url"
}
```
- Response :
```json 
{
    "message": "Plant part created successfully.",
    "plant_part": {
        "name": "string",
        "picture": "string, url",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    }
}
```
<br>

## Read All Plant Parts

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
<br>

## Update plant part

- Endpoint :
    - /plant-parts/:id
- Method :
    - PATCH
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url"
}
```
- Response :
```json 
{
    "message": "Plant part updated successfully.",
    "plant_part": {
        "name": "string",
        "picture": "string, url",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    }
}
```
<br>

## Delete plant part

- Endpoint :
    - /plant-parts/:id
- Method :
    - DELETE
- Header :
    - Accept: application/json
- Response :
```json 
{
    "message": "Plant part deleted successfully."
}
```

<br>
<br>

# Soils CRUD

## Create New Soil

- Endpoint :
    - /soils
- Method :
    - POST
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url",
    "description": "text",
    "nitrogen": "double, optional",
    "phospor": "double, optional",
    "calium": "double, optional",
    "ph": "double, optional",
    "temp": "double, optional",
    "humidity": "double, optional",
}
```
- Response :
```json 
{
    "message": "Soil created successfully.",
    "soil": {
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "nitrogen": "double",
        "phospor": "double",
        "calium": "double",
        "ph": "double",
        "temp": "double",
        "humidity": "double",
        "updated_at": "datetime",
        "created_at": "datetime",
        "id": "integer"
    }
}
```
<br>

## Read All Soils

- Endpoint :
    - /soils
- Method :
    - GET
- Response :
```json 
{
    "message": "All soils fetched successfully.",
    "soil": [
        {
            "id": "integer",
            "name": "string",
            "picture": "string, url",
            "description": "text",
            "nitrogen": "double",
            "phospor": "double",
            "calium": "double",
            "ph": "double",
            "temp": "double",
            "humidity": "double",
            "created_at": "datetime",
            "updated_at": "datetime"
        },
    ]
}
```
<br>

## Update Soil

- Endpoint :
    - /soils/:id
- Method :
    - PATCH
- Header :
    - Accept: application/json
- Body :
```json 
{
    "name": "string",
    "picture": "string, url"
}
```
- Response :
```json 
{
    "message": "Soil updated successfully.",
    "soil": {
        "id": "integer",
        "name": "string",
        "picture": "string, url",
        "description": "text",
        "nitrogen": "double",
        "phospor": "double",
        "calium": "double",
        "ph": "double",
        "temp": "double",
        "humidity": "double",
        "created_at": "datetime",
        "updated_at": "datetime"
    }
}
```
<br>

## Delete Soil

- Endpoint :
    - /soils/:id
- Method :
    - DELETE
- Header :
    - Accept: application/json
- Response :
```json 
{
    "message": "Soil deleted successfully."
}
```