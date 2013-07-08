<div class="hero-unit">
    <h2>{$oNode->nodename} - ({$oNode->ipaddr})</h2>
    <p>{$oNode->description}</p>

    <ul class="nav nav-tabs" id="jobstab">
        <li><a href="#status" data-toggle="tab">{$this->translate('Status')}</a></li>
        <li><a href="#myjobs" data-toggle="tab">{$this->translate('Jobs')}</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="status">
            <table class="table">
                <tr class="error"><td class="text-center">0</td><td>Error(s)</td></tr>
                <tr class="warning"><td>0</td><td>Warning(s)</td></tr>
                <tr class="success"><td>0</td><td>Success</td></tr>
            </table>
        </div>
        <div class="tab-pane" id="myjobs">
            <button id="add-job" class="btn btn-primary">{$this->translate("Add jobs")}</button>
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
                    <tr class="info">
                        <td colspan="6" class="text-center">{$this->translate("Cant't find any execution !")}</td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </div>
    <div id="add-job-dialog" title="Add Job">
        <table class="table table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>{$this->translate('Description')}</th>
                <th>{$this->translate('Action')}</th>
                <th>{$this->translate('Default Schedule')}</th>
                <th>{$this->translate('Estimated Duration')}</th>
                <th>{$this->translate('Operation')}</th>
            </tr>
            {foreach $aJobs as $job}
                <tr>
                    <td>{$this->escapeHtml($job->id)}</td>
                    <td>{$this->escapeHtml($job->description)}</td>
                    <td>{$this->escapeHtml($job->action)}</td>
                    <td>{$this->escapeHtml($job->defaultschedule)}</td>
                    <td>{$this->escapeHtml($job->estimatedduration)}</td>
                    <td>
                        {icon action='edit' title="{$this->translate('Edit')}"
                        href="{$this->url('job', ['action'=>'edit', 'id' => $job->id])}"}
                        {icon action='delete' title="{$this->translate('Delete')}"
                        href="{$this->url('job', ['action'=>'delete', 'id' => $job->id])}"}
                    </td>
                </tr>
                {foreachelse}
                <tr class="info"><td colspan="6">{$this->translate("Cant't find any job !")}</td></tr>
            {/foreach}
        </table>
    </div>

    {literal}
    <script>
        jQuery(
            function($) {
                $('#jobstab').tab();
                $('#add-job').on("click", function(){
                        $('#add-job-dialog').dialog('open');
                    }
                );
                $('#add-job-dialog').dialog({
                    autoOpen: false, height: 300, width: 700, modal: true, closeOnEscape: true,
                    buttons:{
                        'Cancel': function() {
                            $(this).html('');
                            $(this).dialog('close');
                        }
                    }
                });
            }
        );
    </script>
{/literal}
</div>
