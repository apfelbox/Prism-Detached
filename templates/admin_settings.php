<?php
/**
 * Admin page template
 *
 * @var $availableThemes string[]
 * @var $theme string the current theme
 * @var $availableExtensions Prism_Detached_Extension_Base[]
 */
?>
<div class="wrap">

    <div class="icon32" id="icon-plugins"></div>
    <h2 style="margin-bottom: 20px;">Prism Detached</h2>



    <h3 style="margin-top: 40px;">Prism Core Supported languages</h3>
    <ul class="ul-disc">
        <li><code>bash</code></li>
        <li><code>c</code></li>
        <li><code>clike</code></li>
        <li><code>coffeescript</code></li>
        <li><code>cpp</code></li>
        <li><code>css</code></li>
        <li><code>groovy</code></li>
        <li><code>java</code></li>
        <li><code>javascript</code></li>
        <li><code>markup</code></li>
        <li><code>php</code></li>
        <li><code>python</code></li>
        <li><code>scss</code></li>
        <li><code>sql</code></li>
    </ul>



    <h3 style="margin-top: 40px;">Theme</h3>
    <form action="options.php" method="post">
        <?php settings_fields('prism_detached_theme'); ?>
        <p>
            <select name="prism_detached_theme" id="settings-theme">
                <?php foreach ($availableThemes as $key => $themeName) : ?>
                <option value="<?php echo esc_attr($key); ?>"<?php if ($key == $theme) : ?> selected="selected"<?php endif; ?>><?php echo esc_html($themeName); ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="Save Theme" class="button-primary" />
        </p>
    </form>



    <?php if (!empty($availableExtensions)) : ?>
    <h3 style="margin-top: 40px;">Extensions</h3>
    <form action="options.php" method="post">
        <?php settings_fields('prism_detached_extensions'); ?>
        <table class="form-table">
            <tbody>

                <?php foreach ($availableExtensions as $extension) : ?>
                <tr>
                    <th scope="row">
                        <label for="extension-<?php echo esc_attr($extension->getId()); ?>"><?php echo esc_html($extension->getName()); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="prism_detached_extensions[<?php echo esc_attr($extension->getId()); ?>]" id="extension-<?php echo esc_attr($extension->getId()); ?>" value="1"<?php if ($extension->isActive()) : ?> checked="checked"<?php endif; ?> />
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <p class="submit">
            <input type="submit" value="Save Extensions" class="button-primary" />
        </p>
    </form>
    <?php endif; ?>
</div>