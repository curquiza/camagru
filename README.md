# Camagru

## Database schema
![Alt text](resources/camagru_database_schema.jpg)

## Views
- sign in and sign up page
- montage page : taking a photo and seeing your last photos
- galery with all users photos
- photo page : seeing the photo, the comments and the likes
- user account : editing your email, password...

## Routes

### Users
```
GET     /users/:id
POST    /users
PATCH   /users/:id
DELETE  /users/:id
```

### Photos
```
GET     /photos
GET     /photos/:id
POST    /photos
DELETE  /photos/:id
```

### Comments
```
GET     /photos/:id/comments
POST    /photos/:id/comments
PATCH   /photos/:id/comments/:id
DELETE  /photos/:id/comments/:id
```

### Likes
```
POST    /photos/:id/likes
DELETE  /photos/:id/likes/:id
```
