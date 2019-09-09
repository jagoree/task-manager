Simple TaskManager with tags based on CakePHP3 framework

## Installation
1. Clone this repository
2. Apply dump from config/schema/dump.sql
3. Set 777 permissions to following folders:
```
tmp
logs
```
4. Configure your database connection in `config/db.php`
5. Enjoy!

Some options in `config/app.php`  
`useAuth` - use authentication (true/false)  
`useAjax` - use AJAX interface (true/false)

Default access for Administrator
```
admin
adminpass
```
