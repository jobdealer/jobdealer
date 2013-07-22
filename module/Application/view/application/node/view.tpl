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
                    <!--<th>#</th>-->
                    <th>{$this->translate('Job')}</th>
                    <th>{$this->translate('Schedule')}</th>
                    <th>{$this->translate('Description')}</th>
                    <th>{$this->translate('Actions')}</th>
                </tr>
                {foreach $aExecution as $oExecution}
                    <tr>
                        <!--<td>{$this->escapeHtml($oExecution->id)}</td>-->
                        <td>{$this->escapeHtml($oExecution->job->description)}</td>
                        <td>{$this->escapeHtml($oExecution->schedule)}</td>
                        <td>{$this->escapeHtml($oExecution->description)}</td>
                        <td>
                            {icon action='edit' title="{$this->translate('Edit')}"
                            href="{$this->url('execution', ['action'=>'edit', 'id' => $oExecution->id])}"}
                            {icon action='delete' title="{$this->translate('Delete')}"
                            href="{$this->url('execution', ['action'=>'delete', 'id' => $oExecution->id])}"}
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
        <table class="table table-bordered table-hover" id="add-job-table">
            <thead>
                <tr>
                    <!--<th>{$this->translate('Id')}</th>-->
                    <th>{$this->translate('Description')}</th>
                    <th>{$this->translate('Action')}</th>
                    <th>{$this->translate('Default Schedule')}</th>
                    <th>{$this->translate('Estimated Duration')}</th>
                    <th>{$this->translate('Action')}</th>
                </tr>
            </thead>
            <tbody>
                {foreach $aJobs as $job}
                    <tr>
                        <!--<td>{$this->escapeHtml($job->id)}</td>-->
                        <td>{$this->escapeHtml($job->description)}</td>
                        <td>{$this->escapeHtml($job->action)}</td>
                        <td>{$this->escapeHtml($job->defaultschedule)}</td>
                        <td>{$this->escapeHtml($job->estimatedduration)}</td>
                        <td>
                            {icon action='add' title="{$this->translate('Add')}"
                                href="{$this->url('node', ['action'=>'link', 'id' => $oNode->id, 'job' => $job->id])}"}
                            {icon action='clone' title="{$this->translate('Clone')}" href="#"}
                        </td>
                    </tr>
                    {foreachelse}
                    <tr class="info"><td colspan="6">{$this->translate("Cant't find any job !")}</td></tr>
                {/foreach}
            </tbody>
        </table>
    </div>

    {literal}
    <script>
        jQuery(
            function($) {
                $('#jobstab').tab();
                $('#add-job-table').dataTable(
                    {
                        "sDom": "<'row'<'span4'l><'floatright'f>r>t<'row'<'span7'i><'floatright'p>>",
                        "sPaginationType": "bootstrap"
                    }
                );
                $('#add-job').on("click", function(){
                        $('#add-job-dialog').dialog('open');
                    }
                );
                $('#add-job-dialog').dialog({
                    autoOpen: false, height: 400, width: 800, modal: true, closeOnEscape: true,
                    buttons:{
                        'Add new job': function() {
                            window.location('#');
                        },
                        'Done': function() {
                            console.log('Done');
                            $(this).dialog('close');
                        }
                    }
                });
            }
        );
    </script>
{/literal}
</div>
