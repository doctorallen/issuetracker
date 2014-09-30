#Overview
The issue tracker is a simple application for tracking issues found while developing web bases software in a controlled environment. The application is built to tbe client facing, 
allowing clients to submit bug reports and grabbing any browser/user information it can parse. Knowing the browser with version, as well as window size is often half the battle when
trying to recreate bugs.

Some of the major features of the issue tracker:
* Simple yet comprehensive issue reporting form
* User management and authentication system including password reset
* Simple project management system
* Fully fledged subscription based notification system
* Sortable table views
* Design is entirely responsive

## Notification System
The issue tracker has a fully featured notification subscription system, which automatically subscribes users to projects and issues based on their actions, but allows the user to manage
their own subscriptions if they want to watch a particular issue they might not have interacted with, or if they want to remove notifications from and issue they are no longer interested in.

![Image of Single Issue]
(https://i.imgur.com/VJ7Syzl.png)

#Setup
1. Clone the codebase

2. Create a new MySQL database

3. Rename the .env.php.editme file to .env.php

4. Update .env.php file with proper mysql credentials

5. Create the neccessary database tables by running the command `php artisan migrate` in the project root

6. Run the command `composer install` to install of the neccessary depdendencies

7. Once composer has installed all of the dependencies, you can populate the database with fake data by running the command `php artisan db:seed`

# Using the Application
## Creating Admin Account

1. Navigate to the [issue tracker]

2. Login using the username **admin** with the password **admin**

3. Click **Create User**

4. Enter your email, username, and password

5. Choose a project

6. Choose **Admin** as the user level

## Adding A New Project

1. Click **Create Project** in the top navigation

2. Enter the project name

3. Enter a the URL slug. This is what will appear in the URL when viewing the project issue page. This should basically be a lowercase version of the project name without spaces. Use hyphens instead of spaces. Ex: "Test Project" becomes “test-project”

## Adding A New Client User

1. Click **Create User**

2. Enter the users details 

3. Choose the project for the user from the list

4. Choose **Client** as the user level

## Editing a User

1. Navigate to the [User List](http://example.com/user) in the navigation

2. Click on the username of the user you want to edit

3. Click the **edit** button

4. Update the user’s information and click **submit**

## Editing a Project

1. Navigate to the[ project list](http://example.com/project) in the navigation

2. Click on the project name of the project you want to edit

3. Click the **edit** button

4. Update the project’s information and click **submit**
