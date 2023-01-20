<!-- <table class="table">

    <tr> -->


        <th scope="col"> <input type="text" name="fname" value="<?= $result['fname'] ?>"></th>
        <th scope="col"><input type="text" name="lname" value="<?= $result['lname'] ?>"></th>
        <th scope="col"><input type="email" name="email" value="<?= $result['email'] ?>"></th>
        <th scope="col"><input type="varchar" name="mobile" value="<?= $result['mobile'] ?>"></th>

        <th>
            <?php
            if ($result['role'] == 1)
                echo "admin";
            else
                echo "user";
            ?>
        </th>

        <th scope="col">
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </th>

        <th scope="col">
            <button class="btn btn-outline-info m-auto" onclick="update(value)" value="<?= $result['sno'] ?>">Update</button>
        </th>
     
<!-- 
    </tr>
</table> -->