### version 2
- [ ] migration
    - [x] comment
- [ ] model
    - [x] comment
- [ ] model form
    - [x] comment
- [ ] controller
    - [ ] master -> comment
        - [x] status action
    - [ ] home -> comment
- [ ] rbac
    - [ ] comment
        - [ ] deleteComment
        - [ ] listComment
        - [ ] viewComment
        - [ ] statusComment
        - [ ] answerComment
- [ ] view
    - [ ] master
        - [ ] comment (list with action)
            - [x] list
            - [x] view
    - [ ] home
        - [ ] article -> view (add comment)
        
- [ ] install and config image manager

# Table: comment

- `Name`: comment

## `Columns[]`

| `Label`    | `Name`       | `Type`             | `Nullable` | `Default` | `Comment`            |
| ---------- | ------------ | ------------------ | ---------- | --------- | -------------------- |
| id         | id           | int auto_increment | `false`    |           |                      |
| article_id | article_id   | int                | `false`    |           |article foreign key   |
| user_id    | user_id      | int                | `false`    |           |users foreign key     |
| parent_id  | parent_id    | int                | `false`    |     0     |comment foreign key   |
| body       | body         | text               | `false`    |           |                      |
| status     | status       | boolean            | `false`    |     0     |0 inactive - 1  active|
| created_at | created_at   | timestamp          | `false`    |           |user creation time    |

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
- [x] create permission and role
- [x] just author can update or delete own article
- [x] set rbac in master
- [x] migration
    - [x] user
    - [x] article
- [x] model
    - [x] user
    - [x] article
- [x] model form
    - [x] login (default)
    - [x] register
    - [x] user
    - [x] article
- [x] model search
    - [x] user
- [x] rbac
    - [x] user
    - [x] article
- [x] controller
    - [x] Auth
        - [x] LoginController
            -[x] login action
        - [x] RegisterController
            -[x] register action
    - [x] admin
        - [x] AdminController
        - [x] UserController
        - [x] ArticleController
    - [x] home
        - [x] ArticleController
- [x] assets
    - [x] MasterAsset 
- [x] view
    - [x] auth
        - [x] login 
        - [x] register 
    - [x] master (before name was admin)
        - [x] layouts
        - [x] route page
        - [x] user
            - [x] index
            - [x] create
            - [x] update
            - [x] _search
            - [x] _form
            - [x] view
        - [x] article
            - [x] index
    - [x] home
        - [x] article
            - [x] index
            - [x] view
            - [x] create
            - [x] update
    
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
