# Lara Contact Api

## Search contacts
### search by keyword
```http
GET  http://127.0.0.1/api/v1/contact?keyword={{keyword}}
```
----------------------------------------------------------------

### show search records
```http
GET  http://127.0.0.1/api/v1/search-history
```

----------------------------------------------------------------

### delete search records
```http
DELETE  http://127.0.0.1/api/v1/search-history/{{id}}
```

----------------------------------------------------------------

### clear search history
```http
DELETE  http://127.0.0.1/api/v1/search-history/reset
```

----------------------------------------------------------------

## Favourites
### Favourite a contact

```http
POST  http://127.0.0.1/api/v1/favourite
```
#### form-data
| Key            | Value        | Description                |
| :------------- | :----------- | :------------------------- |
| `contact_id` | 1 | **Required** |

----------------------------------------------------------------

### List favourites
```http
GET  http://127.0.0.1/api/v1/favourite
```

----------------------------------------------------------------

### Remove favourite
```http
DELETE  http://127.0.0.1/api/v1/favourite/{{contact_id}}
```

----------------------------------------------------------------

### Remove all favourites
```http
DELETE  http://127.0.0.1/api/v1/favourite/reset
```

----------------------------------------------------------------

## Soft deleting

### List deleted contacts
```http
GET  http://127.0.0.1/api/v1/trashed-contact
```

----------------------------------------------------------------

### List contacts including deleted ones
```http
GET  http://127.0.0.1/api/v1/contact?trashed
```

----------------------------------------------------------------

### Show deleted contact
```http
GET  http://127.0.0.1/api/v1/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Restore deleted contact
```http
GET  http://127.0.0.1/api/v1/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Parmanently delete contact
```http
DELETE  http://127.0.0.1/api/v1/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Clear trashed contacts
```http
DELETE  http://127.0.0.1/api/v1/trashed-contact/reset
```
----------------------------------------------------------------

<!-- 

### request name
```http
POST  http://127.0.0.1/api/v1/f
```
#### form-data
| Key       | Value    | Description                |
| :-------- | :------- | :------------------------- |

----------------------------------------------------------------
-->