p4.nanners.biz
==============

CSCI-E15 Project 4

This goal of this website is to keep track of things in lists in several different ways, and help you make a list of things to do today.

I can envision an application that does a lot of things to help me be organized, but I know my web application development skills are limited, as well as the time I have to implement this to submit it for class.  Here's a description of my thinking - but my implementation is going to be limited to just a few features, while include the required components like using Javascript, Ajax, the class framework, security checking.

I am pretty organized, I'm a list-maker, but it's still pretty hard to keep track of everything I need to do.
I have used many methods of keeping track of things - Excel spreadsheets, a sticky note app, Evernote, paper lists on scraps of paper, paper lists in notebooks or pads.  All frustrating in one way or another.  At the moment, I like Evernote, but I still find things get buried there.

In particular, I end up making a paper list for the things I need to do TODAY, in the order I need to do them in.  I often need to annotate the list with a circled number because the items are written in the wrong order and obviously I don't want to rewrite the list.  Also on the side, I might add h a list of small things (which have some importance/priority) to try to do if I have 20 mins between this and that thing.  Most times, at the end of the day, I have things that didn't get finished - sometimes they're important, so they need to get pushed to tomorrow's list, and sometimes, they can just get put off to the next day that I have time to think about that thing.  If I lose the piece of paper by the end of the day, I have to recreate it.  It is a nuisance to create a note or Excel entry for everything and then have to move it or remove it from some other list.  This is the frustrating part about making lists - it seems like you spend more time keeping track of the list than getting anything done!  I'd like to have the daily list recorded (in case I lose it), be able to extract out of it something that wasn't finished, but in general, I can throw it away at the end of the day, or keep it as a template for another day.

Then, I need real task items to track bigger things to do, and those tasks are the things that need to be done for a project (eg. paint the bathroom), they might need to be in an ordered list.  For some tasks, I'd like to keep track over time how much time I'm spending doing it (eg raking leaves, did i spend more time this year than last year?).

So, I have two kinds of lists in this application - a quick list (essentially just a text list) and a real List (which is a list of tasks).  Quick lists, real lists and tasks can be organized by Project (optional).

The quick list has items that are like reminders for today.  The quick list is printable.  It is also savable as a whole unit.  When you reload it, you can pick items to make into real tasks to save.


My application:

You must create a user, sign in to use the site

You can view your profile  (All code from P2)

Working functionality
- create new tasks
- view a list of all open tasks
- the tasks in the list are sortable by dragging them
- Record time spent on an individual task
- edit a task
- update the status to done

Not Working!
- Requires ability to update a task
	



- create a quick list
	- this is a list of items that you might not create individual tasks for - they are kind of temporary
	- or you can use this to create lists such as grocery or packing lists
	- you can add items to a quick list, put the items into a document and save it, or print it;
	- it is loadable

- tasks have a 'done' status - false for not done, true for done, you can find open or done tasks

- build a todo today list by moving tasks from a big list to the today tab
	- put the items into a document and save it, it is printable

- assign tasks to a project, find tasks assigned to a project
- add a tag to tasks, to search for them later

References:

Stopwatch code to capture time worked is based on :  http://jsfiddle.net/ezmilhouse/V2S9d/


Data organization

Users
	represents a user account

Tasks

Projects

Lists


Relationships

	tasks are created by a user and belong to the same user  (no external relationship right now)
	tasks can be associated with a project, and can be associated with more than one project



