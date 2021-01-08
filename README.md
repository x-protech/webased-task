# webased-task
=======
## Requirements

- Laravel installer
- Composer
- Npm installer

## Installation

```
# Clone the repository from GitHub and open the directory:
git clone https://github.com/miten5/larawind.git

# cd into your project directory
cd larawind

# install composer and npm packages
composer install
npm install && npm run dev
```
## Seed and Serve
```
# run 
# php artisan migarte --seed
# php artisan serve
```
### The App will be seeded with :
#### 1. A user that you could use to login using an email: admin@admin.com and password: password
#### 2. 5 fake companies 
#### 3. 25 fake employees 5 for each company  

## Using Routes with Postman

### Route: http://localhost:8000/companies Method: GET
#### Action: returns all the companies
#### The Data will be recieved from postman in this shape:
```
```
#### The Data will be returned from api as json object in this shape:
```
{
    "companies": [
        {
            "id": ,
            "name": ,
            "email": ,
            "website": ,
            "logo": 
        },
        {
        }...
    ],
    "next_page": ,
    "previous_page": 
}
```
### Route: http://localhost:8000/companies Method: POST
#### Action: create new company and return it
#### The Data will be recieved from postman in this shape:
```
{
    "name": ,
    "email": ,
    "website": ,
    "logo": 
}
```
#### The Data will be returned from api as json object in this shape:
```
{
    "data": {
        "id": ,
        "name": ,
        "email": ,
        "website": ,
        "logo": 
    }
}
```
### Route: http://localhost:8000/companies/id Method: POST
#### Action: Update a spcific company and return it
#### The Data will be recieved from postman in this shape:
```
{
    "name": ,
    "email": ,
    "website": ,
    "logo": 
}
```
#### The Data will be returned from api as json object in this shape:
```
{
    "data": {
        "id": ,
        "name": ,
        "email": ,
        "website": ,
        "logo": 
    }
}
```
### Route: http://localhost:8000/companies/id Method: DESTROY
#### Action: Soft delete a specific company and return it
#### The Data will be recieved from postman in this shape:
```
```
#### The Data will be returned from api as json object in this shape:
```
{
    "data": {
        "id": ,
        "name": ,
        "email": ,
        "website": ,
        "logo": 
    }
}
```
### Route: http://localhost:8000/employees Method: GET
#### Action: return all employees
#### The Data will be recieved from postman in this shape:
```
```
#### The Data will be returned from api as json object in this shape:
```
{
    "employees": [
        {
            "id": ,
            "name": ,
            "email": ,
            "phone_number": 
        },
        { 
        }...    
    ],
    "next_page": ,
    "previous_page": 
}
```
### Route: http://localhost:8000/companies/id/employees Method: POST
#### Action: create a new employee related to a specific company
#### The Data will be recieved from postman in this shape:
```
{
    "first_name": ,
    "last_name": ,
    "email": ,
    "phone_number": 
}
```
#### The Data will be returned from api as json object in this shape:
```
{
    "data": {
        "id": ,
        "name": ,
        "email": ,
        "phone_number": ,
        "company_id": 
    }
}
```
### Route: http://localhost:8000/companies/id/employee/id Method: PATCH/PUT
#### Action: Update a specific employee related to a specific company
#### The Data will be recieved from postman in this shape:
```
{
    "first_name": ,
    "last_name": ,
    "email": ,
    "phone_number": ,
}
```
#### The Data will be returned from api as json object in this shape:
```
{
    "data": {
        "id": ,
        "name": ,
        "email": ,
        "phone_number": ,
        "company_id": 
    }
}
```
### Route: http://localhost:8000/companies/id/employees/id Method: DESTROY
#### Action: Soft delete a specific employee related to a specific company
#### The Data will be recieved from postman in this shape:
```
```
#### The Data will be returned from api as json object in this shape:
```
{
    "data": {
        "id": ,
        "name": ,
        "email": ,
        "phone_number": ,
        "company_id": 
    }
}
```

