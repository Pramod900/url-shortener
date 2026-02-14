# **URL Shortener**
This is a Laravel-based url shortening service, which supports multiple companies and role-based access control. I built this to handle private link management where visibility is restricted based on your role in the company.



## **📦 Prerequisites**
- PHP >= 8.2
- Composer
- MySQL >= 8.0



## **🛠 Tech Stack**
- Framework: Laravel
- Database: MySQL
- Mail Testing: Mailtrap
- Background Tasks: Laravel Queue (Database driver)



## **📋 Features & Rules**
- SuperAdmin: Can view all URLs across the entire system but cannot create them.
- Admin: Can invite new users to their company and see all company links.
- Member: Can create links but only see their own links.
- Invitations: Handled via queued emails for better performance.
- Redirection: Short URLs are public and redirect to the original destination.



## **🚀 Installation & Setup**
Follow these steps to get the project running on your local machine 

### 1. Clone the Project
Open your terminal and run:

```bash
git clone https://github.com/Pramod900/url-shortener.git
cd url-shortener
```

Since I am using Windows and MySQL, please follow these steps to get the project running.

1. Database Setup
    - Open your MySQL tool(like phpMyAdmin or MySQL Workbench).
    - Create a new database named: url_shortener

2. Install Dependencies
Open your terminal in the project folder and run:
```bash
composer install
npm install && npm run build
```

3. Environment Config
Copy the .env.example file to a new file named .env:
```bash
cp .env.example .env
```

Open .env and update these specific lines:
    - DB_DATABASE: url_shortener
    - QUEUE_CONNECTION: database
    
4. Mail Setup Example Configuration in .env
```
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=mailtrap_user_name
MAIL_PASSWORD=mailtrap_user_password
MAIL_FROM_ADDRESS="urlshortener123@gmail.com"       <-- You can change it.
MAIL_FROM_NAME="Url Shortener"                     <-- You can change it.
```

5. Database Setup Example Configuration in .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=root
DB_PASSWORD=

6. Initialize the App
Run these commands to set up the keys and the data:
```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Note: The seeder will create the initial SuperAdmin Account.



## **🔑 Login Credentials (For Testing)**
To login as a SuperAdmin use these credentials after running the command
```bash
php artisan migrate --seed
```
or

```bash
php artisan db:seed
```

- Email: superadmin123@gmail.com
- Password: 12345678



## **✉️ How to Test Emails (Queues)**
I used shouldQueue for the invitations to make the app faster, the emails won't send automatically. You need to start a "worker" to process them.

In a second terminal run this command:
```bash
php artisan queue:work
```

Now you can see mails in your Mailtrap inbox.



## **🤖 AI Usage**
I used Gemini during the development of this assignment for the following reasons:
- Debugging: Solving a htmlspecialchars array error in the Blade views.
- Queue Setup: Help with the syntax for implementing shouldQueue on the invitation mailables.
- Documentation: assistance in structuring README.md file.
- Environment: Help configuring Mailtrap on a windows environment.
- Testing Url: Got some testing working urls.

### The core logic database design and role-based authorization were implemented by me.



## **🧪 Test URLs**

```
https://github.com/laravel/framework/blob/10.x/src/Illuminate/Database/Eloquent/Concerns/HasRelationships.php

https://github.com/tensorflow/tensorflow/tree/master/tensorflow/python/keras/layers

https://laravel.com/docs/10.x/eloquent-relationships

https://kubernetes.io/docs/tutorials/kubernetes-basics/

https://www.theverge.com/2024/1/9/24030667/ai-artificial-intelligence-ces-2024

https://www.youtube.com/watch?v=MFuwkrseXVE
```
