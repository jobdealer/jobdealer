<div class="hero-unit">
    <h2>{$oNode->nodename} - ({$oNode->ipaddr})</h2>
    <p>{$oNode->description}</p>

    <table class="table table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>{$this->translate('Job')}</th>
            <th>{$this->translate('Schedule')}</th>
            <th>{$this->translate('Description')}</th>
            <th>{$this->translate('Actions')}</th>
        </tr>
        {foreach $aExecution as $oExecution}
            <tr>
                <td>{$this->escapeHtml($oExecution->id)}</td>
                <td>{$this->escapeHtml($oExecution->job->description)}</td>
                <td>{$this->escapeHtml($oExecution->schedule)}</td>
                <td>{$this->escapeHtml($oExecution->description)}</td>
                <td>
                    {icon action='edit' title="{$this->translate('Edit')}"
                    href="{$this->url('node', ['action'=>'edit', 'id' => $node->id])}"}
                    {icon action='delete' title="{$this->translate('Delete')}"
                    href="{$this->url('node', ['action'=>'delete', 'id' => $node->id])}"}
                </td>
            </tr>
        {foreachelse}
            <tr class="info"><td colspan="6" class="text-center">{$this->translate("Cant't find any execution !")}</td></tr>
        {/foreach}
    </table>
</div>
