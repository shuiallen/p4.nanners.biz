p4.nanners.biz
==============

CSCI-E15 Project 4

This goal of this website is to help you make a list of things to do today.  It also explores different ways of keeping track of things in lists.

I can envision an application that does a lot of things to help me be organized, but I know my web application development skills are limited, as well as the time I have to implement this to submit it for class.  My approach to organizing is described in the 'What I really want the application to do' section below - but my implementation is going to be limited to just a few features, while include the required components - Javascript, Ajax, the class framework, security checking.

My layouts are primitive, I'm not very experienced in this area.  And they aren't very jazzy or visual (no icons or images), buttons are just rectangular.

My implementation:

You must create a user, sign in to use the site

You can view your profile  (All code from P2)
- Fixed my update profile code from P2, which I broke by adding some error checking

Working functionality
- create new tasks
- view a list of all open tasks
- the tasks in the list are sortable by dragging them  (using JQuery sortable)
- print the list of tasks in the order they appear on the page
  - opens a new tab  (it's not pretty)
  - reorder set of tasks is not saved (future functionality in lists)
- Find a task by id and update/edit the task description and status (open or closed)
  - Report update was executed successfully
- Record time spent on an individual task in two ways
  -- record time on a given task id
  -- use a stopwatch timer to accumulate time while you work  (uses JQUery setInterval)
- Find time entries for a task
- Create a quick list is partially implemented
  - I've run out of time due to running into issues with the live server, and perhaps, trying to solve a bigger problem than I expected.

I've been building little functional tools, hoping to tie them together in quick lists and building lists with first-class tasks.

References:

JQuery Interactions: Sortable
Stopwatch code to capture time worked is based on :  http://jsfiddle.net/ezmilhouse/V2S9d/
  -- I removed the countdown code, to have simpler code, although I'm regretting that now. A countdown timer could be useful to allow you to pre-set an amount of time to spend on a task and ring a bell. If you're not done, you can decide to add more time, or move on - don't get stuck in a rat hole!
Uses the NoCSRF token class, stored in shared/vendors/NoCSRF, per class notes

Issue with live server:
- My main page loads but something is interfering with loading the users/signup, users/login and other pages
- The code works on my local, as well as Dan's.

Missing Functionality
- No delete operations for any objects
  - I would like to learn how to add a standard delete icon to a button that would perform a delete on the object
- print works only for printing tasks, would like to print time entry report and quicklist
  - need to create a util to print an element from #print-task-list click handler in tasks_create

What I really want the application to do:

I am pretty organized person, I'm a list-maker, but it's still pretty hard to keep track of everything I need to do.
I have used many methods of keeping track of things - Excel spreadsheets, a sticky note app, Evernote, paper lists on scraps of paper, paper lists in notebooks or pads.  All frustrating in one way or another.  At the moment, I like Evernote, but I still find things get buried there.

In particular, I end up making a paper list for the things I need to do TODAY, in the order I need to do them in.  

I often need to annotate the list with a circled number because the items are written in the wrong order and obviously I don't want to rewrite the list.  Also on the side, I might add a list of small things (which have some importance/priority) to try to do if I have 20 mins between this and that thing.  

Most times, at the end of the day, I have things that didn't get finished - sometimes they're important, so they need to get pushed to tomorrow's list, and sometimes, they can just get put off to the next day that I have time to think about that thing.  If I lose the piece of paper by the end of the day, I have to recreate it.  It is a nuisance to create a note or Excel entry for everything and then have to move it or remove it from some other list.  This is the frustrating part about making lists - it seems like you spend more time keeping track of the list than getting anything done!  

I'd like to have the daily list recorded (in case I lose it), be able to extract out of it something that wasn't finished, but in general, I can throw it away at the end of the day, or keep it as a template for another day.

Then, I need real task items to track bigger things to do, and those tasks are the things that need to be organized for a project (eg. paint the bathroom), they might need to be in an ordered list.  For some tasks, I'd like to keep track over time how much time I'm spending doing it (eg raking leaves, did i spend more time this year than last year?). And, I may be doing some informal consulting work.  It would be useful to have a way to record time spent that could be used eventually to create an invoice.  It would also be nice to track tasks by projects.  And lots of ways to filter tasks to make lists.

So, I'd like two kinds of lists in this application - a quick list (essentially just a text list) and a real List (which is a list of individual tasks  (first class objects, not a string in a quick list)).  Quick lists, real lists and tasks can be organized by Project (optional).  Building a list for today could start from a quick list, real list, or project list

The quick list has items that are like reminders for today.  The quick list is viewable and printable.  It is also savable as a whole unit.  When you reload it, you can pick items to make into real tasks to save.

Quick list is partially implemented
	- this is a list of items that you might not create individual tasks for - they are kind of temporary
	- or you can use this to create lists such as grocery or packing lists
	- you can add items to a quick list, put the items into a document and save it, or print it;
	- it is loadable

Not done
- build a todo today list by moving tasks from a big list to the today tab
	- put the items into a document and save it, it is printable
- assign tasks to a project, find tasks assigned to a project
- add a tag to tasks, to search for them later

Issues:
- I am dynamically inserting a form to create a new task
- In this case, I am having trouble with 2 things
	1 - Using the ajaxForm to call the server doesn't work.  It works if I use the $.ajax() call and explicitly pass data
	    I need to try more experiments with this - I find behavior of invoking $selector.ajaxForm() not consistent, based on whether there is more than one form on the page, whether you are using a class or id selector
	2 - If I try to add a token to the form, I get an error referencing the token value when calling $.ajax or ajaxForm


Data organization

Users
Tasks
Time Entry
Lists
Projects

Relationships

	Tasks are created by a user and belong to the same user  (no external relationship right now)
	Tasks have a status - open or closed
	A time entry records a task id, a user id and time spent
	tasks can be associated with a project, and can be associated with more than one project



