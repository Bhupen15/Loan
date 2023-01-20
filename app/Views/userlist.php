<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?><?php

  $session = \Config\Services::session();

  ?>
<h2>User List</h2>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<form class="d-flex" role="search" class="ms-5">

    <button name="asc" value="asc" class="btn btn-outline-primary" type="submit">Ascending</button>

    <button name="dsc" value="desc" class="btn btn-outline-primary" type="submit">Descending</button>

    <select class="form-select" aria-label="Default select example" name="opt" >
        <option selected>Open this select menu</option>
        <?php foreach ($user as $u) { ?>
            <option value="<?php echo $u['fname'] ?>">
                <?php echo $u['fname'] ?>
            </option>
        <?php } ?>
    </select>


    <input name="s" class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-primary" type="submit">Search</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th scope="col">S No</th>
            <th scope="col">First Name</th>

            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Role</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $counter = 0;
        if (isset($_GET['page'])) {
            $counter = ($_GET['page'] - 1) * 5;
        }
        foreach ($user as $u) {
            $counter++;
            ?>
            <tr>
                <th scope="row"><?= $counter; ?></th>
                <td>
                    <?= $u['fname']; ?>
                </td>
                <td><?= $u['lname']; ?></td>
                <td>
                    <?= $u['email']; ?>
                </td>
                <td><?= $u['mobile']; ?></td>
                <td>
                    <?= $u['role']; ?>
                </td>
                <td><button class="btn btn-outline-info m-auto" onclick="edit(value)" value="<?= $u['sno'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg> </button>
                    <button class="btn btn-outline-danger m-auto" onclick="dlt(value)" value="<?= $u['sno'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></button>


                </td>

            </tr>

            <tr id="<?="show" . $u['sno'] ?>">

            </tr>


        <?php } ?>

    </tbody>
</table>

<script>
$('select').on('change', function() 
{ alert( this.value ); }
); 
</script>


    <!-- <div> <?php
    // if($pager){
//     echo $pager->links('default','pager');
// } 
// ?></div>


    
    
    <?= $this->endSection(); ?>