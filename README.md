# Job Portal

- Laravel UI installed
- [Laratrust](https://laratrust.santigarcor.me/docs/6.x/) Installed and configured
- UserController and AdminController created
- User Panel Created
  - User Can Register
  - Can Upload CV in .pdf, doc, docx and .jpg formats
  - Cannot upload cv greater than 1MB
  - User Can Update their Profile
  - Can Change their Password
  - User can Search the job
  - They can apply for the job
- Admin Panel Created
  - Create Job
  - Edit Job
  - See Job wise Applications
  - Activate/Inactivate Job Status

## Do after cloning
A. After cloning this repository set up the database and run the below command
```bash
php artisan migrate --seed
```
It will migrate all the necessary tables and populate with some dummy data like

1. UserSeeder
1. RoleUserSeeder
1. LaratrustSeeder
1. RoleUserSeeder
1. CategorySeeder
1. ProfileSeeder
1. QualificationSeeder
1. SkillSeeder
1. StateCitySeeder

B. Run `composer install` to download all laravel dependencies
C. Run `npm install` to download all JavaScript dependencies


## Demo Account Email and Password

### Super Admin

super@gmail.com
password

### Admin
admin@gmail.com
password


### User
user@gmail.com
password
