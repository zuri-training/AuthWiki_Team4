# AuthWiki_Team4
**An authentication code library for different code stacks**

### *For this project we will be pulling from the 'secondary' branch and also making pull requests to the same branch. All finalized changes will be merged with the main branch after proper screening*

> __*You will be submitting tasks by making pull requests to the 'secondary' branch of the parent repository*__

### *[View the project details here](https://docs.google.com/document/d/1yPG9bqNuddG00Du0-APeh92CwtxtiZn0-qrY121pl5o/edit?usp=sharing)*

# Initial Setup Procedures
### Forking the Repository and Cloning it to your Local Machine
  - __Click on the Fork icon on the top-right of the repo's page and fork the repository. You fork should be created now with the directory ```<your_username>/AuthWiki_Team4```. Next, you need to clone it to our local machine/computer.__
  - __Click on the 'code' button and copy the url of the repo. On your local machine, open the command line or terminal and navigate to the directory you want you clone the repo into. In the command line window, enter ```git clone <enter the url you copied here>```, it should look like ```git clone https://github.com/<your_username>/AuthWiki_Team4.git```. Press 'Enter', your repo should be clone in your chosen directory now. Let's proceed to the next step.__ 



# Tasks
### Checking For and Completing Tasks
  - __Go the 'Issues' tab on the parent repository, here you will see all issues created. These issues have tags/categories to describe them, you can hover over them on pc to see want they represent. Every task(issue) should have a/an assignee(s), if you assigned to a task you can click on the task(issue) to view the details.__
  - __On your machine/computer, You can do the tasks and then stage the files or changes for commit using > ```git add <file_name>``` to stage a specific file or either ```git add .``` or ```git add -a``` to stage all files/changes for commit. To check the staged files enter ```git status```__
  - __Commit all changes using ```git commit -m <your_commit_message>```.__
  - __Push the changes to your forked repository using ```git push```.__
 
 
 
 ### Submitting Tasks
  - __You will be submitting tasks by making pull requests to the 'secondary' branch of the parent repository__
  - __To make a pull request, go to you forked repository page on *[github](http://github.com)* and navigate to the pull-request tab. From here, you can create a new pull request to the 'secondary' branch of the original repository( Note: you need need to change ```base: main``` to ```base: secondary```), add description and submit.__
  > __*NOTE: Always update your forked repo when taking on a task and before making a pull request to avoid conflicts and overrides. Check [here](https://github.com/zuri-training/AuthWiki_Team4/edit/main/README.md#pulling-changes-from-the-original-repository-to-update-your-forked-repository) to learn how to update to forked repository/local repository*__
  - __Your request(task submission) will then be reviewed and merged if okay.__
 
 
 
# Pulling Changes from the original repository to update your forked repository
### There are two ways to do this:
#### First, through github-
  - __On your forked repository page, you should see the ```Sync Fork``` button at the top and should be able to click and sync to update your forked repository if any changes have been made to the original repository ```AuthWiki_Team4```. There are options you can play with to customize the sync process.__
  - __To reflect the changes on your local repository, you navigate to the project directory on command line or terminal on your computer and run ```git pull origin```. This should pull all changes from the defualt branch in your remote repository to you local machine.__
 
#### Alternatively, you can do this on your local machine-
  - __Navigate to the project directory and run command line or terminal. Next, we need to set our upstream repository (here, it will the original repository ```AuthWiki_Team4```). There, run ```git remote add upstream https://github.com/zuri-training/AuthWiki_Team4```.__
  - __Fetch the changes in the 'secondary' branch of the original repository using ```git fetch upstream```.__
  - __Switch to your main branch(if your not already on main) using ```git checkout main``` or ```git checkout master``` if your default branch is named 'master'.__
  - __Merge the secondary branch of the upstream to your main branch using ```git merge upstream/secondary```.__
  - __Commit your changes and push to reflect the changes your remote repository.__ 

##### *Similar functionalities is provided by 'Git Desktop' and 'VSCode'*
