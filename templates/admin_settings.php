<?php
/**
 * Admin page template
 */
?>
<div class="icon32" id="icon-plugins"><br></div>
<h2>Prism Detached</h2>

<h2 style="margin-top: 40px;">Supported languages</h2>

<ul class="ul-disc">
    <li><code>css</code></li>
    <li><code>java</code></li>
    <li><code>javascript</code></li>
    <li><code>markup</code></li>
</ul>

<h2 style="margin-top: 40px;">Settings</h2>
<form action="<?php echo $pageUrl; ?>" method="post">
    <table class="form-table">
        <tbody>

            <tr>
                <th scope="row">
                    <label for="settings-invisibles">Show Invisibles</label>
                </th>
                <td>
                    <input type="checkbox" value="1" name="settings[invisibles]" id="settings-invisibles" <?php if ($invisibles) : ?>checked="checked"<?php endif; ?> />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="settings-autolinker">Use Autolinker</label>
                </th>
                <td>
                    <input type="checkbox" value="1" name="settings[autolinker]" id="settings-autolinker" <?php if ($autolinker) : ?>checked="checked"<?php endif; ?> />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="settings-theme">Theme</label>
                </th>
                <td>
                    <select name="settings[theme]" id="settings-theme">
                        <?php foreach ($availableThemes as $key => $themeName) : ?>
                        <option value="<?php echo esc_attr($key); ?>"<?php if ($key == $theme) : ?> selected="selected"<?php endif; ?>><?php echo esc_html($themeName); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>


        </tbody>
    </table>

    <p class="submit">
        <input type="submit" value="Save Settings" class="button-primary" id="submit" name="settings[submit]">
    </p>
</form>