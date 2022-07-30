# AuthWiki_Team4
**An authentication code library for different code stacks**

### *For this project frontend developers will be pulling from the 'Frontend' branch and also making pull requests to the same branch. The backend developers will be working on the 'secondary' and 'intermediate' branches. All finalized changes will be merged with the main branch after proper screening.*

> __*Frontend developers will be submitting tasks by making pull requests to the 'Frontend' branch of the parent repository*__

### *[View the project details here](https://docs.google.com/document/d/1yPG9bqNuddG00Du0-APeh92CwtxtiZn0-qrY121pl5o/edit?usp=sharing)*

# Backend Developers Guide

## Initial Setup Procedure for Backend developers
### *Backend developers are allowed to clone the repository directly.* 
__Click on the 'code' button and copy the url of the repository. On your local machine, open the command line or terminal and navigate to the directory you want to clone the repository into. In the command line window, enter ```git clone <enter the url you copied here>```, it should look like ```git clone https://github.com/<your_username>/AuthWiki_Team4.git```. Press 'Enter', your repo should be cloned into your chosen directory now Before working in your remote repository it is necessary to switch to the branch you are to work on by running ```git checkout origin/<branch_name>``` e.g ```git checkout origin/intermediate```.__

> __Before working in your remote repository it is necessary to switch to the branch you are to work on by running ```git checkout origin/<branch_name>``` e.g ```git checkout origin/intermediate```__
    
## Pushing Code to the Repository
   - __Stage and commit the changes made.__
   - __When you want to push your code back to the remote repository, you should push directly to your specific branch. Run ```git push origin HEAD:<branch_name>``` e.g ```git push origin HEAD:intermediate```.__
   
## Pulling Changes made to your Branch from the Remote Repository
   - __Fetch the changes that have been made to original repository using ```git fetch origin```.__
   - __Switch to your branch(if your not already on it) using ```git checkout origin/<branch_name>``` e.g ```git checkout origin/secondary```.__
   - __Merge the changes from your remote branch to your local branch using ```git merge origin/<branch_name>``` e.g ```git merge origin/secondary```.__

# Frontend Developers Guide

## Initial Setup Procedures for Frontend developers
### Forking the Repository and Cloning it to your Local Machine
  - __Click on the Fork icon on the top-right of the repository's page and fork the repository. Your fork should now be created with the directory ```<your_username>/AuthWiki_Team4```. Next, you need to clone it to your local machine/computer.__
  - __Click on the 'code' button and copy the url of the repo. On your local machine, open the command line or terminal and navigate to the directory you want to clone the repository into. In the command line window, enter ```git clone <enter the url you copied here>```, it should look like ```git clone https://github.com/<your_username>/AuthWiki_Team4.git```. Press 'Enter', your repo should be cloned into your chosen directory now. Let's proceed to the next step.__
  - __Now that your have cloned the forked repository you need to set your 'upstream' and pull from the brach you'll be working on. Refer to *[this](#upstream)* part of the README to see how you can do this.__  



## Tasks
### Checking For and Completing Tasks
  - __Go the 'Issues' tab on the parent repository, here you will see all issues created. These issues have tags/categories to describe them, you can hover over them on pc to see what they represent. Every task(issue) should have a/an assignee(s), if you are assigned to a task you can click on the task(issue) to view the details.__
  - __On your machine/computer, You can do the tasks and then stage the files or changes for commit using > ```git add <file_name>``` to stage a specific file or either ```git add .``` or ```git add -A``` to stage all files/changes for commit. To check the staged files enter ```git status``` and run__
  - __You will be saving you work in the 'resources' directory.__
    - __'*.html' files will be saved in the 'resources/views' sub-directory.__
    - __'*.css' files will be saved in the 'resources/css' sub-directory.__
    - __'*.js' files will be saved in the 'resources/js' sub-directory.__
  - __Stage and commit all changes using ```git commit -m <your_commit_message>```.__
  - __Push the changes to your forked repository using ```git push origin```.__
 
 
 
### Submitting Tasks
  - __You will be submitting tasks by making pull requests to the 'secondary' branch of the parent repository__
  - __To make a pull request, go to your forked repository page on *[github](http://github.com)* and navigate to the pull-request tab. From here, you can create a new pull request to the 'secondary' branch of the original repository( Note: For frontend developers, you need need to change ```base: main``` to ```base: Frontend```), add description and submit.__
  > __*NOTE: Always update your forked repo when taking on a task and before making a pull request(submission) to avoid conflicts and overrides. Check [here](#upstream) to learn how to update your forked repository/local repository*__
  - __Your request(task submission) will then be reviewed and merged if okay.__
 
 
 
## <a name='upstream'></a> Pulling Changes from the original repository to update your forked repository
  - __Navigate to the project directory and run command line or terminal. Next, we need to set our upstream repository (here, it will be the original repository ```AuthWiki_Team4```). There, run ```git remote add upstream https://github.com/zuri-training/AuthWiki_Team4```.__
  - __Fetch the changes that have been made to original repository using ```git fetch upstream```.__
  - __Switch to your forked repository's main(default) branch(if your not already on main) using ```git checkout main``` or ```git checkout master``` if your default branch is named 'master'.__
  - __Merge the 'Frontend' branch of the upstream to your main branch using ```git merge upstream/Frontend```.__
  - __Stage and commit your changes and push to reflect the changes in your remote repository using ```git push origin```.__

##### *Similar functionalities are provided by 'Github Desktop' and 'VSCode'*
##### *Reach out to the team-lead @Elsam20 if there is any issue*
