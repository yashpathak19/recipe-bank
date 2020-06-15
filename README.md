# recipe-bank
## URL : http://krishnashah.tech/RecipeBank/index.php
### Team communication medium : https://hangouts.google.com/call/ukQVlzEwRQGULPoiLT6ZAGEE
=======
## Team Members :
1. Yash Pathak
2. Krishna Shah
3. Sukhdeep Sandhu
4. Amit Deka

## Team files :
* database/database.php
* database : foodrecipienetwork.sql
* ERD : database/erd.jpeg
* traits/valtrait/validation.php 

## Yash Pathak
### Admin Panel + User Sign UP-LOG IN + USER MANAGE + NOTIFICATIONS + LIKE Functionality + Notification POPUP + Header Improvements + Leadership
-------- Designed Pages --------
* Notifications.php (whole page design)
* header.php (design improvements)
* adminpanel.php (whole page design)
* adminpanel.css (css)
* style.css (css)
* updateUser.php (whole page design)
* feed.php (design fix)
* signup.php (whole page design)
* updateuser.php (whole page design)
* showrecipe.php (error handelling design, like design)

-------- Development Pages --------

### Website USER (ADMIN PANEL WITH SIGN UP, LOG IN and CRUD FUNCTIONALITY, OVERALL USER SUPPORT FOR WHOLE WEBSITE)
* login.php (A page which provides login for the user)
* signup.php (Page which provides sign up for the user, also same page which will provide admin creation if the user is admin)
* deleteuser.php (Page for deletion of the user)
* adminpanel.php (Designed this page for displaying both user and admin panel in a same page depending on user type (admin or normal user), the page has all the user functionality)
* websiteCRUD.php (a database class for notifications and user methods)
* updateUser.php (Page to update the user)
* interface/websietinterface.php (Interface for websiteCRUD class)

### Notifications (Notification Popup, mute notification feature under user profile, like-unlike, like count, all notifications for admin)
* notifications.php (to view notifications and update them)
* feed.php(like functionality, notification popup)
* adminpanel.php (admin can view every notifications)
* websitecrud.php (for database classes)
* js/feed.js (ajax for popup of notification)
* getNotifications.php (for reterieving the notifications for popup)
* showrecipe.php (Like, unlike functionality, displaying the like aswell error handelling)

---Miscellaneous---
* Error fixing in various pages.
* Design fixing in varous pages.
* Deployment
* Database Designing

## Krishna Shah
### Newsletter + Subscription + Header + Footer + Logo
-------- Designed Pages --------
* header.php : colors, fonts, layout, responsiveness 
* footer.php : colors, fonts, layout, responsiveness 
#### Subscription feature
* subscription.php (fonts, button, form with email field for the users)
* thankyousubscriber.php (message to send confirmation email to the users those who have subscribed)
* unsubscription in adminpanel.php (button in admin panel for admin with the list of subscribers and a link for users in users email)
* listsubscribers in adminpanel.php (table to display list of subscribers in admin panel for admin)
* validation.php (using trait to validate the email input by the user in subscription form)

#### Newsletter feature
* addNewsletter.php (form that allows admin to enter the subject and body of the newsletter that they want to be sent to users.) 
* updateNewsletter.php (form that allows admin to update the subject and body of the newsletter that they want to be sent to users.) 
* deleteNewsletter.php (button in the adminpanel.php)
* sendNewsletter.php (view of the newsletter and a button to send the newsletter)

-------- Development Pages --------

#### Subscription feature
* subscriber.php (class that contains add, list and delete subscriber function)
* thankyousubscriber.php (using phpmailer and autoloader to send confirmation email new subscribers)
* subscription.php (form that add the user in subscription list and javascripti is used for confirmation message)

#### Newsletter feature
* listNewsletter.php (calls the listNewsletter function and admin can see the list of newsletter in adminpanel)
* addNewsletter.php (calls the addNewsletter function from class and stores subject and body input in the list in database)
* updateNewsletter.php (calls the updateNewsletter function from class, updates and stores subject and body input in the list in database)
* deleteNewsletter in listNewsletter table (calls deleteNewsletter function from newsletter class and removes the newsletter from the database)
* deleteConfirmLetter (Asks admin for comfirmation to delete the letter)
* sendNewsletter.php (grabs the all subscribers email and sends the selected newsletter to all subscriber using phpmailer and autoloader)

## Sukhdeep Sandhu

### Recipe Form

* recipeform.php(this has a form to add recipe and executes add method which is created in recipeformCRUD.php file)

* recipeformCRUD.php(this has all the methods for database file)

* showrecipe.php(when user posted the recipe successfully this page opens up and displays the recipe with options to update and delete)

* updaterecipe.php(this page has methods to update the recipe and form)

### Comment

* comment.php(this file has database methods-create,update,delete,show,showrecipecomment,showuserrecipe)

* UpdateComment.php(this page upated the comment when user click on edit button in displayComment.php file)

* displayComment.php(it executes when user click on comment icon and has edit and delete button with links)

* DeleteComment.php(this file hase delete function)

* feed.php(this shows all the recipes posted if the user is logged in otherwise show custome error page showerror.php, this page is using AJAX method to show comments)

* showerror.php


__Designed pages__

* desserts.php

* drinks.php

* feed.php

* starters.php

* maincourse.php

* recipeform.php

## Amit Deka
*Designed all pages in Feed and FAQ folder
### FAQ
* addFaq.php
* addFaqCat.php
* deleteFaq.php
* displayFaq.php
* faq.php
* listFaq.php
* updateFaq.php
### Sorting 
* createRecipe.php
* deleteRecipe.php
* feed.php
* feedCRUD.php
* listRecipe.php
* sortRecipe.php
* updateRecipe.php
* uploads
