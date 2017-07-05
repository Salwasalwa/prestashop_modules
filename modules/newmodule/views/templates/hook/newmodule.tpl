<!-- Block newmodule -->
<div id="newmodule_block_home" class="block">
    <h4>Welcome!</h4>
    <div class="block_content">
        <p>Hello,
            {if isset($new_module_name) && $new_module_name}
               {$new_module_name}
            {else}
               World
            {/if}
            !
        </p>
        <ul>
            <li><a href="{$new_module_link}" title="Click this link">Click me!</a></li>
        </ul>
    </div>
</div>
<!-- /Block newmodule -->
