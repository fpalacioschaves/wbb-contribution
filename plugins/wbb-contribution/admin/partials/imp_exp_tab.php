<p>
    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
</p>

<input type="file" class="js-upload-users-csv" id="js-upload-users-csv" style="display: none;" />
<button class="js-trigger-upload-user-file">Upload CSV file</button>

<div class="import_configuration_block">
    <ul>
        <li>
            <table>
                <tr>
                    <td>Overwrite if user exist?</td>
                    <td>
                        <div class="slideThree js-exist-overwrite">	
                            <input type="checkbox" value="None" id="overwrite_exist_user" class="js-import-option" name="overwrite_exist_user" />
                            <label for="overwrite_exist_user"></label>
                        </div>
                    </td>
                </tr>
            </table>
        </li>
    </ul>
</div>

<div class="user-results-table-container">

    <p>You must order the user,mail and password like: 
        [1] username [2] email [3] password (if pass is empty, will be generated)
    </p>

    <table id="js-user-results-table" class="js-user-results-table user-results-table">
        <thead>
        </thead>
        <tbody>
        </tbody>
    </table>

</div>


<button class="js-run-import">Start the import!</button>