<p>
            Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
            ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
            amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
            odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
        </p>

        <table>
            <tr>
                <td>Default WP system</td>
                <td>
                    <div class="slideThree js-login-checkbox">	
                        <input type="checkbox" value="None" id="login_default" name="login_default" <?php echo ( get_option("login_default") === "true" ) ? 'checked' : ''; ?> />
                        <label for="login_default"></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Facebook</td>
                <td>
                    <div class="slideThree js-login-checkbox">	
                        <input type="checkbox" value="None" id="login_facebook" name="login_facebook" <?php echo ( get_option("login_facebook") === "true" ) ? 'checked' : ''; ?> />
                        <label for="login_facebook"></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Twitter</td>
                <td>
                    <div class="slideThree js-login-checkbox">	
                        <input type="checkbox" value="None" id="login_twitter" name="login_twitter" <?php echo ( get_option("login_twitter") === "true" ) ? 'checked' : ''; ?> />
                        <label for="login_twitter"></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Google+</td>
                <td>
                    <div class="slideThree js-login-checkbox">	
                        <input type="checkbox" value="None" id="login_google" name="login_google" <?php echo ( get_option("login_google") === "true" ) ? 'checked' : ''; ?> />
                        <label for="login_google"></label>
                    </div>
                </td>
            </tr>
        </table>