# Exo

## Articles

Id (int) / title (varchar) / content (text) / enabled (boolean) / [OPTION] image (varchar) / created_at (datetime) / updated_at (datetime) / category_id / user_id

### Link to One Category

ManyToOne => Many Articles can have One Category

### Link to Many Tags

ManyToMany => Many Articles can have Many Tags

### Link to One User

ManyToOne => Many Articles can have One User

## Categories

Id (int) / name (varchar)

## Tags

Id (int) / name (varchar)

## Users

Id (int) / username (varchar) / Password (varchar) / Role (varchar)