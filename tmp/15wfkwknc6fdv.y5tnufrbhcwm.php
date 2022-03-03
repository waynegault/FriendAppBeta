<!--Obtained from https://getbootstrap.com/docs/5.1/examples/dashboard/ and modified by WG-->

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= ($BASE) ?>/logout">Logout</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= ($BASE) ?>/">Dashboard</a></li>

<!--                <li><a href="#">Profile</a></li>-->
<!--                <li><a href="#">Help</a></li>-->
            </ul>
            <form class="navbar-form navbar-right">
                <input class="form-control" placeholder="Search... - not activated yet" type="text">
            </form>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="<?= ($BASE) ?>/About">About <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="#">Users <span class="sr-only">(current)</span></a></li>
                <li><a href="<?= ($BASE) ?>/ListUsers">List Users</a></li>
                <li><a href="<?= ($BASE) ?>/Register">Register - here temporarily</a></li>
                <li><a href="<?= ($BASE) ?>/UpdateUser/<?= ($SESSION['user']['id']) ?>">Update my details</a></li>
                <li class="active"><a href="#">Topics <span class="sr-only">(current)</span></a></li>
                <li><a href="<?= ($BASE) ?>/ListTopics">List Topics</a></li>
                <li><a href="<?= ($BASE) ?>/NewTopic">Create New Topic</a></li>
                <li><a href="<?= ($BASE) ?>/UpdateTopic">Update Topic</a></li>
                <li class="active"><a href="#">Events <span class="sr-only">(current)</span></a></li>
                <li><a href="<?= ($BASE) ?>/ListEvents">List Events</a></li>
                <li><a href="<?= ($BASE) ?>/NewEvent">Create New Event</a></li>
                <li><a href="<?= ($BASE) ?>/UpdateEvent">Update Event - not working</a></li>
                <li class="active"><a href="#">Search <span class="sr-only">(current)</span></a></li>
                <li><a href="<?= ($BASE) ?>/Search">Search for Events</a></li>
                <li class="active"><a href="#">My Stuff <span class="sr-only">(current)</span></a></li>
                <li><a href="<?= ($BASE) ?>/UpdateUser/@id">Me - yet to add id of current user</a></li>
                <li><a href="<?= ($BASE) ?>/">My Topics - not working</a></li>
                <li><a href="<?= ($BASE) ?>/">My Events - not working</a></li>
                <li><a href="<?= ($BASE) ?>/">Events I've Said I'm Going To - not working</a></li>

            </ul>
        </div>
    </div>
</div>
