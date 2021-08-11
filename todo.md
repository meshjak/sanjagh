### version 1

- [x] enable pretty url
- [x] setting database connection
- [x] change the default login route
- [x] edit route login in navbar
- [x] change the default register route
- [x] edit route register in navbar
- [x] add master view dependency in web dir
- [x] change default master route
- [x] unique email field in user table (edit user table)
- [x] add user menu to sidebar
- [x] change label form user
- [x] partitioning main layouts
- [ ] migration
    - [x] user
    - [x] article
- [ ] model
    - [x] user
    - [x] article
- [ ] model form
    - [x] login (default)
    - [x] register
    - [x] user
    - [x] article
- [ ] model search
    - [x] user
  
- [ ] controller
    - [ ] Auth
        - [x] LoginController
            -[x] login action
        - [x] RegisterController
            -[x] register action
    - [ ] admin
        - [x] AdminController
        - [x] UserController
        - [ ] ArticleController
    - [ ] home
        - [x] ArticleController
- [ ] assets
    - [x] MasterAsset 
- [ ] view
    - [x] auth
        - [x] login 
        - [x] register 
    - [ ] master (before name was admin)
        - [x] layouts
        - [x] route page
        - [x] user
            - [x] index
            - [x] create
            - [x] update
            - [x] _search
            - [x] _form
            - [x] view
        - [ ] article
            - [ ] all
    - [ ] home
        - [ ] article
            - [x] index
            - [x] view
            - [x] create
            - [x] update
        - [ ] profile (user)
            - [ ] index
    
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
| body       | body         | text               | `false`    |           |                      |
| status     | status       | boolean            | `false`    |     1     |0 inactive - 1  active|
| created_at | created_at   | timestamp          | `false`    |           |article creation time |

add in version 2
| slug       | slug         | varchar(120)       | `false`    |           |                      |
