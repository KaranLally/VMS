# VMS
Bootstrap link:
https://getbootstrap.com/docs/5.3/getting-started/introduction/

The html body should be sth like:
```sh
<body>
        <div class="d-flex">
            <?= sidebarShow("/*currentTab*/"); ?>
            <!--Main div==============================================================================-->
            <div class="container-fluid content flex-grow-1 p-5">
                //Code here==========
                
            </div>
        </div>
</body>
```
Call `sideBarShow()` to insert sidebar html code

TODO list:
-------
* something here
