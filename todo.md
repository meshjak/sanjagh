### version 1

- [x] enable pretty url
- [x] setting database connection
- [x] change the default login route
- [x] edit route login in navbar
- [x] change the default register route
- [x] edit route register in navbar
- [x] add master view dependency in web dir
- [ ] add MasterAsset for management master view dependency
- [ ] migration
    - [x] user
    - [ ] article
- [ ] model
    - [x] user
    - [ ] article
- [ ] model form
    - [x] login (default)
    - [x] register
    - [ ] user
    - [ ] article
- [ ] controller
    - [ ] Auth
        - [x] LoginController
            -[x] login action
        - [x] RegisterController
            -[x] register action
    - [ ] admin
        - [x] AdminController
        - [ ] UserController
        - [ ] ArticleController
- [ ] assets
    - [x] MasterAsset 
- [ ] view
    - [x] auth
        - [x] login 
        - [x] register 
    - [ ] master (before name was admin)
        - [ ] route page
        - [ ] user
            - [ ] all
            - [ ] create
        - [ ] article
            - [ ] all
    
---
# Table: user

- `Name`: user

## `Columns[]`

| `Label`    | `Name`       | `Type`             | `Nullable` | `Default` | `Comment`            |
| ---------- | ------------ | ------------------ | ---------- | --------- | -------------------- |
| id         | id           | int auto_increment | `false`    |           |                      |
| fullname   | fullname     | varchar(50)        | `false`    |           |                      |
| username   | username     | varchar(50)        | `false`    |           |                      |
| email      | email        | varchar(100)       | `false`    |           |                      |
| authKey    | string       | varchar(255)       | `false`    |           |                      |
| accessToken| string       | varchar(255)       | `false`    |           |                      |
| password   | password     | varchar(100)       | `false`    |           |                      |
| isAdmin    | isAdmin      | boolean            | `false`    |     0     |0 admin - 1 user      |
| status     | status       | boolean            | `false`    |     1     |0 inactive - 1  active|
| created_at | created_at   | timestamp          | `false`    |           |user creation time    |

---
# Table: article

- `Name`: article

## `Columns[]`

| `Label`    | `Name`       | `Type`             | `Nullable` | `Default` | `Comment`            |
| ---------- | ------------ | ------------------ | ---------- | --------- | -------------------- |
| id         | id           | int auto_increment | `false`    |           |                      |
| author_id  | author_id    | int                | `false`    |           |users foreign key     |
| title      | title        | varchar(70)        | `false`    |           |                      |
| slug       | slug         | varchar(120)       | `false`    |           |                      |
| body       | body         | text               | `false`    |           |                      |
| status     | status       | boolean            | `false`    |     1     |0 inactive - 1  active|
| created_at | created_at   | timestamp          | `false`    |           |article creation time |