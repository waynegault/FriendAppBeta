<!--&lt;!&ndash;Framework obtained from https://getbootstrap.com/docs/5.1/examples/dashboard/ and modified&ndash;&gt;-->

    <h1 class="page-header">Dashboard</h1>

<h1>The sections below are for development purposes to check whether new developments break things!.</h1>
<a href="<?= ($BASE) ?>/Test1">This will take you to test 1  - calling a global variable</a>
<br>
<a href="<?= ($BASE) ?>/Test2">This will take you to test 2 - an echo to test routing</a>
<br>
<a href="<?= ($BASE) ?>/Test3">This will take you to test 3 - calling the error handler</a>
<br>
<a href="<?= ($BASE) ?>/Test4">This will take you to test 4 - forcing an error(404)</a>
<br>
<a href="<?= ($BASE) ?>/Test5">This will take you to test 5 - testing JS functionality</a>
<br>
<a href="<?= ($BASE) ?>/Test6">This will take you to test 6 - dump system variables</a>
<br>
<a href="<?= ($BASE) ?>/messages">This will take you to test 7 - testing html template repeat/group/value </a>  <!-- '/' not required in front of messages -->
<br>
<a href="api/messages">This will take you to test 8 - returning messages via a JSON REST API endpoint</a> <!-- create an endpoint -->

    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="app\assets\images\placeholder.png" class="img-responsive" alt="Generic placeholder thumbnail" height="50"><h4>Coming up</h4>
            <span class="text-muted">Events Near You</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="app\assets\images\placeholder.png" class="img-responsive" alt="Generic placeholder thumbnail" height="50"><h4>New</h4>
            <span class="text-muted">New Topics</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="app\assets\images\placeholder.png" class="img-responsive" alt="Generic placeholder thumbnail" height="50"><h4>Most popular</h4>
            <span class="text-muted">Favourites</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="app\assets\images\placeholder.png" class="img-responsive" alt="Generic placeholder thumbnail" height="50"><h4>Blah</h4>
            <span class="text-muted">Something else</span>
        </div>
    </div>

    <h2 class="sub-header">Latest Events</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>dolor</td>
                <td>sit</td>
            </tr>
            <tr>
                <td>1,002</td>
                <td>amet</td>
                <td>consectetur</td>
                <td>adipiscing</td>
                <td>elit</td>
            </tr>
            </tbody>
        </table>
    </div>
