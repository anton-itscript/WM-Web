<div class="middlenarrow">
    <h1>Existing Users</h1>
    <?php echo CHtml::link('Add new User', array('superadmin/user')); ?><br /><br />
    <?php if (count($users) > 0) :?>
        <table class="tablelist">
            <tr>
                <th>User Name</th>
                <th>Role</th>
                <?php foreach ($actions as $action){ ?>
                    <th>
                        <?php echo $action['action']; ?>
                    </th>
                <?php } ?>
                <th>Tools</th>
            </tr>
            <?php foreach ($users as $user){ ?>
                <?php if($user->role != 'superadmin'):?>
                <tr>
                    <td><?php echo $user->username; ?></td>
                    <td class ="<?php echo $user->role == 'admin'? 'EnableTD':'DisableTD'; ?>"><?php
                        echo ucfirst($user->role);
                        ?></td>
                    <?php foreach ($actions as $action){
                        $check = AccessUser::checkActionAtUser($user->user_id,$action->id); ?>
                        <td class ="<?php echo $check? 'EnableTD':'DisableTD'; ?>">
                            <?php echo CHtml::link(
                                $check?'Enable':'Disable',
                                array('superadmin/useraccesschange', 'user_id' => $user->user_id, 'action_id' => $action->id))
                            ?>
                        </td>

                    <?php } ?>
                    <td>
                        <?php echo CHtml::link('Edit', array('superadmin/user', 'user_id' => $user->user_id)); ?>
                        &nbsp;
                        <?php echo CHtml::link('Del', array('superadmin/userdelete', 'user_id' => $user->user_id), array('title' => 'Delete user', 'onclick' => "return confirm('Do you really want to delete this user?')")); ?>
                    </td>
                </tr>
                    <?php else:?>
                    <tr>
                        <td><?php echo $user->username; ?></td>
                        <td class ="EnableTD"><?php
                            echo ucfirst($user->role);
                            ?></td>
                        <?php foreach ($actions as $action){
                            $check = AccessUser::checkActionAtUser($user->user_id,$action->id); ?>
                            <td class ="EnableTD">Enable

                            </td>

                        <?php } ?>
                        <td>
                            <?php echo CHtml::link('Edit', array('superadmin/user', 'user_id' => $user->user_id)); ?>
                            &nbsp;
                            <?php echo CHtml::link('Del', array('superadmin/userdelete', 'user_id' => $user->user_id), array('title' => 'Delete user', 'onclick' => "return confirm('Do you really want to delete this user?')")); ?>
                        </td>
                    </tr>
                    <?php endif?>
            <?php } ?>
        </table>
    <?php endif; ?>
</div>