git repo: https://salmgazer@bitbucket.org/nurseapp/nurseapp.git

project url: http://cs.ashesi.edu.gh/class2016/salifu-mutaru/Hospital_task_manager_ex/

iCare

List of Authors:

1. Salifu Mutaru (Project cordinator)
2. Comfort Tenjier (Nurse implementation)
3. Ali P.F Njie (Task implementation and UI comformity)
4. Adjoa Kwansima Kwaakye (Hospital implementation)
5. William Annoh (Admin implementation)

NB: Salifu did not have a model to work with, hence worked alongside each team member, and 
primarily converted project into Ajax app, and also worked on controller.
Salifu also managed the project on bitbucket and saw to it that conflicts were resolved.

About:

iCare is an Ajax oriented open source web application for hospital adminstrators to manage their nurses.
Due to internet issues in Africa, Ajax was implemented to reduce dependency on internet for page
reloading.
UI/UX was highly influenced by Ashesi HCI class (Nana Baah Gyan)

Instructions:
Create an account to access all functionalities:

Key operations by hospital administrators:
1. Before accessing the platform, the administrator must first create an account.
2. In creating an account, the administrator must add the details of the hospital
he wants to manage, and his personal details.
3. After creating account, the admin can then access the platform by first logging in.
4. Admin can add new nurse: nurse can be a full time nurse or a student intern
5. Admin can view all nurses and delete leaving nurses [lazy deletion is implemented]
6. Admin can assign task to his nurses
7. Admin can view all tasks based on their status [task status include: overdue, completed,
ongoing, requested completion]
8. Admin can reject or accept completion request of a task assigned not a nurse.
9. Admin can logout

Key operations by nurse:
1. Nurse must first have an account registered by admin of the hospital
2. Nurse can login into her account and view task.
3. Nurse can request completion of a task
4. Nurse can view all her tasks based on status [status include: overdue, completed, ongoing
, requested completion] of the task.

Libraries:
jQuery was lightly used.

Design Model:
iCare is stricly MCV.
Models include database mainly, and PHP classes for each table in the database.
Views were implemented in HTML5, CSS, and JS and JQUERY.
Controller was implemented in PHP to receive AJAX requests and send JSON results.

