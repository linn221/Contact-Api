# Lara Contact Api

## contacts
### Bulk delete | `POST`
```http
http://127.0.0.1/api/v1/contact/bulk-delete
```
#### form-data
| Key       | Value    | Description                |
| :-------- | :------- | :------------------------- |
|contacts | [13, 16] | array, contacts' ids|

----------------------------------------------------------------

## Search contacts
### search by keyword | `GET`
```http
http://127.0.0.1/api/v1/contact?keyword={{keyword}}
```

----------------------------------------------------------------

### show search records | `GET`
```http
http://127.0.0.1/api/v1/search-history
```

----------------------------------------------------------------

### delete search records | `DELETE`
```http
http://127.0.0.1/api/v1/search-history/{{id}}
```

----------------------------------------------------------------

### clear search history | `DELETE`
```http
 http://127.0.0.1/api/v1/search-history/reset
```

----------------------------------------------------------------

## Favourites
### Favourite a contact | `GET`

```http
http://127.0.0.1/api/v1/favourite
```
#### form-data
| Key            | Value        | Description                |
| :------------- | :----------- | :------------------------- |
| `contact_id`| 1 | | **Required** |

----------------------------------------------------------------

### List favourites | `GET`
```http
 http://127.0.0.1/api/v1/favourite
```

----------------------------------------------------------------

### Remove favourite | `DELETE`
```http
 http://127.0.0.1/api/v1/favourite/{{contact_id}}
```

----------------------------------------------------------------

### Remove all favourites | `DELETE`
```http
 http://127.0.0.1/api/v1/favourite/reset
```

----------------------------------------------------------------

## Soft deleting

### List deleted contacts | `GET`
```http
 http://127.0.0.1/api/v1/trashed-contact
```

----------------------------------------------------------------

### List contacts including deleted ones | `GET`
```http
 http://127.0.0.1/api/v1/contact?trashed
```

----------------------------------------------------------------

### Show deleted contact | `GET`
```http
 http://127.0.0.1/api/v1/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Restore deleted contact | `GET`
```http
 http://127.0.0.1/api/v1/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Parmanently delete contact | `DELETE`
```http
 http://127.0.0.1/api/v1/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Empty trash | `DELETE`
```http
 http://127.0.0.1/api/v1/trashed-contact/reset
```
----------------------------------------------------------------

### Restore trash bin | `GET`
```http
 http://127.0.0.1/api/v1/trashed-contact/restore
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