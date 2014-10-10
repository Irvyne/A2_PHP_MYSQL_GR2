# PHP A2

## Instructions

* Deadline => Sunday 12th by 23:59
* Send it to => thibaud.bardin [at] gmail [dot] com 
* Email all files in an .zip, .rar, .tar or .7z format
* +1 point if the website is online

## FrontOffice

* List all articles 6 by 6 with a pagination (show only enabled articles)
* Show one article by its id (show only enabled articles)
* Contact form which send an email via mail() function
* Login page with error display if I submit bad credentials

## BackOffice 

All back-office files will be protected (redirection or Not Authorized)

* CRUD for Article => ROLE_USER can only show and modify their own articles
* CRUD for Category => Not accessible by ROLE_USER
* CRUD for Tag [OPTION] => Not accessible by ROLE_USER
* CRUD for User (2 roles: ROLE_ADMIN & ROLE_USER) => Not accessible by ROLE_USER

## Database

### Articles

Id (int) / title (varchar) / content (text) / enabled (boolean) / [OPTION] image (varchar) / created_at (datetime) / updated_at (datetime) / category_id / user_id

#### Link to One Category

ManyToOne => Many Articles can have One Category

#### Link to Many Tags

ManyToMany => Many Articles can have Many Tags

#### Link to One User

ManyToOne => Many Articles can have One User

### Categories

Id (int) / name (varchar)

### Tags

Id (int) / name (varchar)

### Users

Id (int) / username (varchar) / Password (varchar) / Role (varchar)