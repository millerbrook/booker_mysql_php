# Current Problems

- create.php (and new.php?) for books not capturing and writing to db book_details data? (need to inventory)
- DONE FOR NEW. FIXED FOR EDIT??? CHECK. need to display all book details in show.php for books (ensure capture in new.php and edit.php)
- problems with prize considerationt year, primary genre, postcoloniality and subsequent longlist?
- radio button only prepopulating for metafiction?
- change Gender radio to simple text entry -- add autocorrection for case with male and female?
- super weird db design. need to give authors an id number and add field to identification info as foreign key
- use ![WorldCat API](https://www.oclc.org/developer/api/oclc-apis/worldcat-search-api.en.html) to iteratively grab numbers of books
- get rid of 'subsequent longlist' -- requires going back every year to update, and it can be calculated based on 'is this first longlist' question
- change query_functions.php validations of isbn to use has_isbn function in validation_functions.php
- validation messages need associative array and placement near form entry boxes, plus a listing at top of variables that threw errors
