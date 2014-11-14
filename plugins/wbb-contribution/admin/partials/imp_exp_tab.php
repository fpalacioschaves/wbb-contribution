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
        <li>Value to check if users exist.
            
            <table>
                <tr>
                    <td>Username</td>
                    <td>
                        
                        <div class="slideThree js-exist-user-username">	
                            <input type="checkbox" value="None" id="username_exist_user" name="username_exist_user" />
                            <label for="username_exist_user"></label>
                        </div>
                        
                    </td>
                </tr>
                <tr>
                    <td>E-Mail</td>
                    <td>
                        
                        <div class="slideThree js-exist-user-email">	
                            <input type="checkbox" value="None" id="email_exist_user" name="email_exist_user" />
                            <label for="email_exist_user"></label>
                        </div>
                        
                    </td>
                </tr>
            </table>
            
        </li>
        <li>
            
            <table>
                <tr>
                    <td>Overwrite if user exist?</td>
                    <td>
                        
                        <div class="slideThree js-exist-overwrite">	
                            <input type="checkbox" value="None" id="overwrite_exist_user" name="overwrite_exist_user" />
                            <label for="overwrite_exist_user"></label>
                        </div>
                        
                    </td>
                </tr>
            </table>
            
        </li>

    </ul>

</div>

<div class="user-results-table-container">
    
    <table class="js-user-results-table user-results-table">

        <thead></thead>
        <tbody></tbody>

    </table>
    
</div>
