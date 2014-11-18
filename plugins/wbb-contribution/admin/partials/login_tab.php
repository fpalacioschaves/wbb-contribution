<h3>User Login & Register</h3>

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
        
        <hr>
        
        <table class="login_options_table">
            <tr>
                <td>Activate account by mail?</td>
                <td>
                    <div class="slideThree js-login-checkbox">	
                        <input type="checkbox" value="None" id="activate_by_mail" name="activate_by_mail" <?php echo ( get_option("activate_by_mail") === "true" ) ? 'checked' : ''; ?> />
                        <label for="activate_by_mail"></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    
                    <div class="js-editor-container editor-container  <?php echo ( get_option("activate_by_mail") === "true" ) ? 'active' : ''; ?> ">
                        
                        <div id="toolbar"></div>
                        <div class="email_content js-email-content" contenteditable="true">
                            <?php echo get_option("confirmation_mail_text", true) ?>
                        </div>
                        
                    </div>
                    
                    
                </td>
            </tr>
        </table>