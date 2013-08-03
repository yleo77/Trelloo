
#Trelloo - Trello For Alfred 

Some Alias for Trello With Alfred Workflow

* Show Boards & Cards from Local Cache.
* Quickly Open or Copy Boards & Cards URL.
* Add Card to Master Board.
* Set Master Board.
* Check Notification.

##Setup
1. visit [Authorize Page](http://yleo77.github.io/trello/index.html) to get Your Token.
2. Download & Install **Trelloo.alfredworkflow**
3. Open This Workflow Dir (right click to select **Show in Finder** )
4. Replace `$token = "__placeholder__"` With Your Token in **userconfig.php**
5. Optional: fill in `$masterBoard = ""` With A Board Id.
6. Optional: Set Your preferred Hotkey. Default Config: **Control + Option + Command + Shift + t**  (I use [KeyRemap4MacBook](https://github.com/tekezo/KeyRemap4MacBook))


##Usage

Just Press your Hotkey or Type **tl** in Alfred…

###Alias

* `tll` for Pull Data Frome Server. (you need run it **first**)
* `tlb` for Show Boards.
* `tlc` for Show Cards.
* `tln` for Check Notification.
* `tla` for Add Card to Your Master Board.

###Default behavior (in board & card view)

Select a Item, then:

* Open a link by pressing **ENTER**.
* Copy url by pressing **Shift + ENTER** key.
* Also Set Master Board by pressing **Command + ENTER** key. (when you use **Add Card** feature, you need it.)


###example

	tla test Frome Trelloo

*test Frome Trelloo* will be the card name.

	tla 2 card for list2

*card for list2* will be the card name. *2* will be the list No.. (use No. to special a list is some easier, i guess).
 
 
 
 
