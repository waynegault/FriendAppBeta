<table id="ListUsers" style="width:100%" class="table table-hover table-bordered">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Age</th>
        <th scope="col">Gender</th>
        <th scope="col">Interests</th>
        <th scope="col">Email</th>
        <th scope="col">Social</th>
        <th scope="col">Image</th>
        <th scope="col">Hidden?</th>
        <th scope="col">Visits</th>
        <th scope="col">Edit</th>
    </tr>
    </thead>
    <tbody>
<!--    see https://fatfreeframework.com/3.7/views-and-templates#RepeatingSegments-->
    <?php foreach (($user?:[]) as $user): ?>
        <tr>
            <td><?= (trim($user['forename'])) ?> <?= (trim($user['surname'])) ?></td>
            <td><?= (trim($user['age'])) ?></td>
            <td><?= (trim($user['gender'])) ?></td>




            <td>
                <?php foreach (($user['interests']?:[]) as $item): ?>
                    <div><?= ($item['topic_name']) ?><div>
                <?php endforeach; ?>
            </td>






            <td><?= (trim($user['email'])) ?></td>
            <td>
<!--                see https://fatfreeframework.com/3.7/views-and-templates#ConditionalSegments -->

                <?php if (trim($user['facebook_username'])): ?>
                    
                        <a href="https://www.facebook.com/<?= (trim($user['facebook_username'])) ?>"  rel="noopener noreferrer" target="_blank"><img src="<?= ($BASE) ?>/app/assets/images/fb.png" alt="Facebook Icon" style="width:30px; height:30px;"></a>
                    
                    <?php else: ?>
                        <span>
                            No Facebook
                        </span>
                    

                <?php endif; ?>
            </td>

            <td><img src="<?= ($BASE) ?>/Pic/<?= ($user['id']) ?>" width="250" alt="<?= (trim($user['forename'])) ?> <?= (trim($user['surname'])) ?>'s image"></td>
            <td><?= (trim($user['hidden'])) ?></td>
            <td><?= (trim($user['visits'])) ?></td>
            <td><a href="<?= ($BASE.'/UpdateUser/'.$user['id']) ?>" class="btn btn-primary"><i class="icon-edit icon-white"></i>Edit</a>
                <a href="<?= ($BASE.'/DeleteUser/'.$user['id']) ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i>Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

try this https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_cards

make this a rolling box
