# Lara Contact Api
## Favourite

### Favourite a contact

```http
POST  {{base_url}}/favourite
```
#### form-data
| Key            | Value        | Description                |
| :------------- | :----------- | :------------------------- |
| `contact_id` | 1 | **Required** |

----------------------------------------------------------------

### List favourites
```http
GET  {{base_url}}/favourite
```

----------------------------------------------------------------

### Remove favourite
```http
DELETE  {{base_url}}/favourite/{{contact_id}}
```

----------------------------------------------------------------

## Soft deleting

### List deleted contacts
```http
GET  {{base_url}}/trashed-contact
```

----------------------------------------------------------------

### Show deleted contact
```http
GET  {{base_url}}/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

### Restore deleted contact
```http
GET  {{base_url}}/trashed-contact/{{contact_id}}
```

----------------------------------------------------------------

<!-- 

### request name
```http
POST  {{base_url}}/f
```
#### form-data
| Key       | Value    | Description                |
| :-------- | :------- | :------------------------- |

----------------------------------------------------------------
-->