
<!-- Block newmodule -->
<div id="newmodule_block_home" class="block">
    <h4>Welcome!</h4>
    <div class="block_content">
        <p>{l s='Hello %s!' sprintf=$new_module_name mod='newmodule'}
            {if isset($new_module_name) && $new_module_name}
                {capture name='new_module_tempvar'}{l s='World' mod='newmodule'}{/capture}
                {assign var='new_module_name' value=$smarty.capture.new_module_tempvar}

            {/if}
            {l s='Hello %s!' sprintf=$new_module_name mod='newmodule'}
        </p>
        <ul>
            <a href="{$new_module_link}" title="{l s='Click this link' mod='newmodule'}">{l s='Click me!' mod='newmodule'}</a>
        </ul>
    </div>
</div>
<!-- /Block newmodule -->
