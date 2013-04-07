Setting up a CDPF Server instance on OpenShift
=====

This web app is the server component for the **Connected Digital Photo Frame** project based on the Raspberry Pi, 
see http://tinyurl.com/pi-cdpf for more info about this project.

STEP 1: Got to http://openshift.com and sign up for a free account. 
-----

You will need to use a real email address that you can check and confirm to complete the signup process 

After you verify your email you will be ready for the next step.

STEP 2: Create an application
-----

After email verification you should be on your way to creating and application,

0. Choose a type of application
   * pick (click on) PHP 5.3
0. Configure and deploy the application
   * give your app a name like photofeed
   * if needed, pick a namespace, I use *mscalora* for my personal stuff
   * In the "Source Code" section, next to "Default" click "Change"
   * Paste in this github URL to get my software: https://github.com/mscalora/cdpf-server.git
0. Finally, click the "Create Application" button at the bottom

It will take a minute or two, OpenSHift is going to spin up a virtual linux server, pull the code from github and deploy it. 
Five minutes would be impressive for all that so you should be impressed it is so fast, *and free!*

OpenShift will give you lots of info about your server, the only think you really need is the URL which should look something like

&nbsp;&nbsp;&nbsp;&nbsp;http://photofeed-mscalora.rhcloud.com/

STEP 3: Visit your new web server and set the password
-----

* In order to control who can upload and delete photos, you will need to set a password for your server.

*Note:* If you forget your password, you can follow instructions on the http://OpenShift.com web site to 
log into your server with SSH. Once you are loged in, you can reset your password with the following command. 
Visit the site to set the new password once you have run this command.

    rm $OPENSHIFT_DATA_DIR.passwd

OpenShift has created a copy of the cdpf-server source code. As it stands, you won't get updates if the 
code changes on github. If you are a coder, you can can get updates or even modify the web application 
yourself by using git and an editor. To get started, follow one of the OpenShift *getting started* tutorials.

You will be limited to 1 GB total disk space on an OpenShift free account but that's plenty for most people. 
I find that most of the photos I use with CDPF are under 1 MB each.
=======
Other resources are available at: http://tinyurl.com/pi-cdpf

Test: 4
