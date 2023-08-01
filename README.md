# Lara Contact Api

## Search contacts
### search by keyword
```http
GET  api://contact?keyword={{keyword}}
```
----------------------------------------------------------------

### show search records
```http
GET  api://search-history
```

----------------------------------------------------------------

### delete search records
```http
DELETE  api://search-history/{{id}}
```

----------------------------------------------------------------

### clear search history
```http
DELETE  api://search-history/reset
```

----------------------------------------------------------------

## Favourites
### Favourite a contact

```http
POST  api://favourite
```
#### form-data
| Key            | Value        | Description                |
| :------------- | :----------- | :------------------------- |
| `contact_id` | 1 | **Required** |

----------------------------------------------------------------

### List favourites
```http
GET  api://favourite
```

----------------------------------------------------------------

### Remove favourite
```http
DELETE  api://favourite/{{contact_id}}
```

----------------------------------------------------------------

### Remove all favourites
```http
DELETE  api://favourite/reset
```

----------------------------------------------------------------

## Soft deleting

### List deleted contacts
```http
GET  api://trashed-contact
```

----------------------------------------------------------------

### List contacts including deleted ones
```http
GET  api://contact?trashed
```

----------------------------------------------------------------

### Show deleted contact
```http
GET  api://trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Restore deleted contact
```http
GET  api://trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Parmanently delete contact
```http
DELETE  api://trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Clear trashed contacts
```http
DELETE  api://trashed-contact/reset
```
----------------------------------------------------------------

<!-- 

### request name
```http
POST  api://f
```
#### form-data
| Key       | Value    | Description                |
| :-------- | :------- | :------------------------- |

----------------------------------------------------------------
-->